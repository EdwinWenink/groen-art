#!/usr/bin/env python3
"""Build static site from YAML data and Jinja2 templates."""

import shutil
from pathlib import Path
import yaml
from jinja2 import Environment, FileSystemLoader

ROOT = Path(__file__).parent
DIST = ROOT.parent / "dist"
HTML_DIR = ROOT.parent / "html"  # Source images


def load_yaml(path):
    with open(path) as f:
        return yaml.safe_load(f)


def find_thumb(full_path, folder):
    """Find thumbnail for a full-size image."""
    full = Path(full_path)
    base = full.stem  # e.g., "Oranje strand" from "Mysterie/Groot/Oranje strand.jpg"

    folder_path = HTML_DIR / folder

    # Check for _thumb version (exact match)
    for ext in ['.jpg', '.JPG', '.jpeg', '.png']:
        thumb = folder_path / f"{base}_thumb{ext}"
        if thumb.exists():
            return f"{folder}/{thumb.name}"

    # Check for same name without Groot folder
    for ext in ['.jpg', '.JPG', '.jpeg', '.png']:
        thumb = folder_path / f"{base}{ext}"
        if thumb.exists():
            return f"{folder}/{thumb.name}"

    # Search for files containing the base name (handles dimension-prefixed files)
    # e.g., "Kosmos" might be "100x150Acryl-op-doekKosmos.JPG"
    for f in folder_path.glob('*'):
        if f.is_file() and base.lower() in f.stem.lower() and f.suffix.lower() in ['.jpg', '.jpeg', '.png']:
            if 'Groot' not in str(f):
                return f"{folder}/{f.name}"

    # Return full path as fallback (will show large image)
    return full_path


def process_artworks(artworks, site_config):
    """Process artworks to ensure thumbs are set correctly."""
    categories = {c['id']: c['folder'] for c in site_config['categories']}

    for cat_id, items in artworks.items():
        folder = categories.get(cat_id, cat_id.capitalize())
        for art in items:
            # Always find thumb dynamically
            art['thumb'] = find_thumb(art['full'], folder)

    return artworks


def build():
    # Load data
    site = load_yaml(ROOT / "data/site.yaml")
    artworks = load_yaml(ROOT / "data/artworks.yaml")

    # Process artworks to fix thumbs
    artworks = process_artworks(artworks, site)

    # Setup Jinja2
    env = Environment(loader=FileSystemLoader(ROOT / "templates"), autoescape=True)

    # Clean and create dist
    if DIST.exists():
        shutil.rmtree(DIST)
    DIST.mkdir()

    # Copy static files
    shutil.copytree(ROOT / "static/css", DIST / "css")
    shutil.copytree(ROOT / "static/js", DIST / "js")

    # Copy images from html folder
    print("Copying images...")
    for folder in ['images', 'Natuur', 'Diversedieren', 'Kikkers', 'Vormen', 'Mysterie',
                   'Skylines', 'Collages', 'Beweging', 'Portretten', 'Paarden', 'Diversen']:
        src = HTML_DIR / folder
        if src.exists():
            shutil.copytree(src, DIST / folder)
            print(f"  {folder}: {sum(1 for _ in (DIST / folder).rglob('*') if _.is_file())} files")

    # Generate index page
    template = env.get_template("index.html")
    (DIST / "index.html").write_text(template.render(
        site=site['site'],
        about=site['about'],
        featured=site['featured'],
        categories=site['categories'],
        current='index'
    ))
    print("Generated: index.html")

    # Generate gallery pages
    template = env.get_template("gallery.html")
    for cat in site['categories']:
        cat_dir = DIST / cat['id']
        cat_dir.mkdir(exist_ok=True)

        cat_artworks = artworks.get(cat['id'], [])
        (cat_dir / "index.html").write_text(template.render(
            site=site['site'],
            category=cat,
            artworks=cat_artworks,
            categories=site['categories'],
            current=cat['id']
        ))
        print(f"Generated: {cat['id']}/index.html ({len(cat_artworks)} artworks)")

    # Generate contact page
    template = env.get_template("contact.html")
    contact_dir = DIST / "contact"
    contact_dir.mkdir(exist_ok=True)
    (contact_dir / "index.html").write_text(template.render(
        site=site['site'],
        contact=site['contact'],
        categories=site['categories'],
        current='contact'
    ))
    print("Generated: contact/index.html")

    print(f"\nBuild complete: {DIST}")
    print(f"Total size: {sum(f.stat().st_size for f in DIST.rglob('*') if f.is_file()) / 1024 / 1024:.1f} MB")


if __name__ == "__main__":
    build()
