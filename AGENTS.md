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
- `dist/` - Generated output (do not edit directly)
- `content/` - Content data files
