# De Schilderijen van Marjo Groen

A static website showcasing the paintings of Marjo Groen. Built with Python, Jinja2 templates, and deployed on Netlify.

## Project Structure

```
groen/
├── src/
│   ├── build.py              # Build script
│   ├── data/
│   │   ├── site.yaml         # Site configuration and categories
│   │   └── artworks.yaml     # Artwork entries per category
│   ├── templates/            # Jinja2 HTML templates
│   └── static/
│       ├── css/style.css     # Main stylesheet
│       └── js/               # JavaScript files
├── assets/                   # Source images (organized by folder)
│   ├── images/               # Header images and misc
│   ├── Natuur/               # Nature paintings
│   ├── Diversedieren/        # Animals (includes former Kikkers, Paarden)
│   ├── Vormen/               # Abstract forms
│   ├── Mysterie/             # Mystery paintings
│   └── ...
└── dist/                     # Generated site (do not edit)
```

## Building the Site

```bash
cd src
.venv/bin/python build.py
```

This generates the static site in `dist/`, copying images and generating HTML pages for all galleries.

## How to Add a New Painting

1. **Add the image files** to the appropriate folder in `assets/`:
   - Full-size image: `assets/{Folder}/Groot/{filename}.jpg`
   - Thumbnail: `assets/{Folder}/{filename}.jpg`
   
   The thumbnail should have the same base filename as the full image (without the `Groot/` path).

2. **Add an entry** to `src/data/artworks.yaml` under the appropriate category:

   ```yaml
   natuur:  # category id
   - name: Painting Title
     full: Natuur/Groot/painting-filename.jpg
     dimensions: 80x120
     materials: Acryl op doek
     price: 500           # optional, omit if not for sale
     sold: true           # optional, only if sold
     not_for_sale: true   # optional, only if not for sale
   ```

3. **Rebuild the site**:
   ```bash
   cd src && .venv/bin/python build.py
   ```

### Thumbnail Matching

The build script automatically finds thumbnails by looking for a file with the same base name in the category's folder. For example:
- Full: `Natuur/Groot/Boom.jpg`
- Thumbnail found: `Natuur/Boom.jpg`

If automatic matching fails, you can specify an explicit thumbnail:
```yaml
- name: Painting Title
  full: Folder/Groot/image.jpg
  thumb: Folder/thumbnail.jpg  # explicit thumb path
```

## How to Create a New Category

1. **Create the folder** in `assets/`:
   ```bash
   mkdir -p assets/NewCategory/Groot
   ```

2. **Add a header image** for the category to `assets/images/`.

3. **Add the category** to `src/data/site.yaml`:
   ```yaml
   categories:
     # ... existing categories ...
     - id: newcategory        # used in URLs (e.g., /newcategory/)
       name: New Category     # display name
       folder: NewCategory    # folder name in assets/
       header: images/header-image.jpg
   ```

4. **Add the folder** to the build script's copy list in `src/build.py`:
   ```python
   for folder in ['images', 'Natuur', ..., 'NewCategory']:
   ```

5. **Add artworks** to `src/data/artworks.yaml`:
   ```yaml
   newcategory:
   - name: First Painting
     full: NewCategory/Groot/painting.jpg
     dimensions: 50x70
     materials: Acryl op doek
   ```

6. **Rebuild the site**.

## Deployment

The site is configured for Netlify deployment. Push changes to the main branch to trigger a deploy. The `dist/` folder contains the complete static site.

## Configuration Files

- `netlify.toml` - Netlify deployment configuration
- `src/data/site.yaml` - Site metadata, about text, featured items, categories
- `src/data/artworks.yaml` - All artwork entries organized by category

## Artwork Entry Fields

| Field | Required | Description |
|-------|----------|-------------|
| `name` | Yes | Display title of the artwork |
| `full` | Yes | Path to full-size image (relative to assets/) |
| `thumb` | No | Explicit thumbnail path (auto-detected if omitted) |
| `dimensions` | No | Size in cm (e.g., "80x120") |
| `materials` | No | Materials used (e.g., "Acryl op doek") |
| `price` | No | Price in euros (omit if not for sale) |
| `sold` | No | Set to `true` if sold |
| `not_for_sale` | No | Set to `true` if not for sale |
