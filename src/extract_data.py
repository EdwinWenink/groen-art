#!/usr/bin/env python3
"""Extract artwork data from existing HTML files into YAML."""

import re
from pathlib import Path
import yaml

HTML_DIR = Path(__file__).parent.parent / "html"

CATEGORIES = [
    ("natuur", "Natuur", "Natuur"),
    ("dieren", "Diversedieren", "Dieren"),
    ("kikkers", "Kikkers", "Kikkers"),
    ("vormen", "Vormen", "Vormen"),
    ("mysterie", "Mysterie", "Mysterie"),
    ("skylines", "Skylines", "Skylines"),
    ("collages", "Collages", "Collages"),
    ("beweging", "Beweging", "Beweging"),
    ("portretten", "Portretten", "Portretten"),
    ("paarden", "Paarden", "Paarden"),
    ("stillevens", "Diversen", "Stillevens"),
]

def extract_artworks(html_content, folder_name):
    """Extract artwork data from HTML content."""
    artworks = []

    # Pattern for lyteshow links with artwork info
    # href="Folder/Groot/file.jpg" ... title="Naam: X ... Afmetingen: 30x30 ... Materialen: Y ... Prijs: Z"
    pattern = r'href="([^"]+/Groot/[^"]+)"[^>]*(?:rel="lyteshow[^"]*")?[^>]*title="([^"]*)"'

    for match in re.finditer(pattern, html_content, re.DOTALL | re.IGNORECASE):
        full_img = match.group(1)
        title_text = match.group(2)

        # Parse title text
        name_match = re.search(r'Naam:\s*([^\n&#]+)', title_text)
        dims_match = re.search(r'Afmetingen:\s*(\d+x\d+)', title_text)
        mats_match = re.search(r'Materialen:\s*([^\n&#]+?)(?:\s*Prijs:|Verkocht|$)', title_text)
        price_match = re.search(r'Prijs:\s*(\d+)', title_text)
        sold = 'Verkocht' in title_text or 'verkocht' in title_text
        not_for_sale = 'Niet te koop' in title_text

        # Try to find corresponding thumbnail
        base_name = Path(full_img).stem
        thumb_patterns = [
            f"{folder_name}/{base_name}_thumb.jpg",
            f"{folder_name}/{base_name}.JPG",
            f"{folder_name}/{base_name}.jpg",
        ]

        # Find actual thumb from src attribute near this href
        thumb_match = re.search(
            rf'src="({folder_name}/[^"]+)"[^>]*(?=.*?href="{re.escape(full_img)}")',
            html_content[:html_content.find(full_img) + len(full_img) + 500],
            re.DOTALL | re.IGNORECASE
        )
        thumb = thumb_match.group(1) if thumb_match else None

        # Also try searching backwards
        if not thumb:
            chunk_start = max(0, html_content.find(full_img) - 1000)
            chunk = html_content[chunk_start:html_content.find(full_img) + 100]
            thumb_match = re.search(rf'src="({folder_name}/[^"]+)"', chunk, re.IGNORECASE)
            thumb = thumb_match.group(1) if thumb_match else None

        artwork = {
            "name": name_match.group(1).strip() if name_match else base_name,
            "full": full_img,
        }

        if thumb:
            artwork["thumb"] = thumb
        if dims_match:
            artwork["dimensions"] = dims_match.group(1)
        if mats_match:
            artwork["materials"] = mats_match.group(1).strip()
        if price_match and not sold and not not_for_sale:
            artwork["price"] = int(price_match.group(1))
        if sold:
            artwork["sold"] = True
        if not_for_sale:
            artwork["not_for_sale"] = True

        artworks.append(artwork)

    return artworks


def main():
    all_artworks = {}

    for cat_id, folder_name, display_name in CATEGORIES:
        # Try different HTML file names
        for html_name in [f"{cat_id}.html", f"{folder_name.lower()}.html", "dieren.html" if cat_id == "dieren" else None]:
            if html_name is None:
                continue
            html_path = HTML_DIR / html_name
            if html_path.exists():
                html_content = html_path.read_text(errors='ignore')
                artworks = extract_artworks(html_content, folder_name)
                if artworks:
                    all_artworks[cat_id] = artworks
                    print(f"{cat_id}: {len(artworks)} artworks from {html_name}")
                break

    # Write to YAML
    output_path = Path(__file__).parent / "data" / "artworks.yaml"
    with open(output_path, 'w') as f:
        yaml.dump(all_artworks, f, allow_unicode=True, default_flow_style=False, sort_keys=False)

    print(f"\nWrote {sum(len(v) for v in all_artworks.values())} artworks to {output_path}")


if __name__ == "__main__":
    main()
