# Build Commands

## Build the site

```bash
cd /workspaces/Notes/groen/src && .venv/bin/python build.py
```

This generates the static site in `/dist`, copying images and generating HTML pages for all galleries.

## Project structure

- `src/` - Source files (templates, build script, static assets)
- `src/static/css/style.css` - Main stylesheet
- `src/build.py` - Build script
- `src/data/` - YAML data files (artworks.yaml, site.yaml)
- `assets/` - Source images (Natuur/, Mysterie/, etc.)
- `dist/` - Generated output (do not edit directly)
- `content/` - Content markdown files
- `html/` - Legacy folder (can be deleted once migration verified)
