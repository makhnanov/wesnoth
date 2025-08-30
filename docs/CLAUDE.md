# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is the `/docs` subdirectory of **The Battle for Wesnoth**, an open source turn-based tactical strategy game. The docs directory specifically contains a web-based hex map editor/viewer for Wesnoth terrain.

## Architecture & Key Files

### Main Application (`index.html`)
- **Canvas-based hex map editor** with interactive UI
- **Dual canvas system**: Main rendering canvas and menu overlay canvas
- **Terrain tile painting system** using hexagonal grid
- **Interactive features**: Pan (mouse drag/spacebar), zoom (mouse wheel), tile selection and placement
- **Side menu**: Toggleable tile selector with terrain images from Wesnoth repository

### Configuration Parser (`terrain.cfg.to.json.php`)
- PHP script that parses Wesnoth terrain configuration files
- Uses Laravel Illuminate/Support for string utilities
- Extracts terrain metadata (names, image paths) from `../data/core/terrain.cfg`
- Outputs terrain information for potential JSON conversion

### Dependencies (`composer.json`)
- **Illuminate/Support ^12.26**: Laravel utilities for string manipulation
- **Symfony/var-dumper ^7.3**: Debug utilities
- Run `composer install` to install PHP dependencies

## Development Commands

### PHP Dependencies
```bash
composer install          # Install PHP dependencies
php terrain.cfg.to.json.php  # Parse terrain configuration
```

### Web Server
The `index.html` file is a standalone web application. Serve it with any web server:
```bash
python3 -m http.server 8000  # Simple Python server
php -S localhost:8000        # PHP built-in server
```

## Key Technical Details

### Hex Grid Implementation
- Uses HTML5 Canvas API with 2D rendering context
- Hexagon coordinates: offset coordinate system
- Base hex size: 72px, scalable via zoom
- Clipping paths for hexagonal tile rendering
- Efficient viewport culling for large maps

### Coordinate System
- **Grid spacing**: `dx = size * 0.75`, `dy = size * 0.866`
- **Offset rows**: Alternating column offset for hex packing
- **World-to-screen**: Maintains offset and scale transforms for pan/zoom

### Terrain Integration
- Loads terrain images directly from Wesnoth GitHub repository
- Images sourced from: `https://raw.githubusercontent.com/wesnoth/wesnoth/refs/heads/master/data/core/images/terrain/`
- Supports road, water, and stone terrain types by default

### User Interactions
- **Pan**: Middle mouse button or Spacebar + left mouse drag
- **Paint**: Left mouse click/drag (when tile selected)
- **Zoom**: Mouse wheel with cursor-centered scaling
- **Menu**: Toggle button in top-left corner

## Parent Project Context

This docs directory is part of the larger Wesnoth game repository (`/var/www/wesnoth/`). The parent project:
- Uses **C++17** with modern CMake or SCons build systems
- Requires extensive dependencies (SDL2, Boost, Cairo, etc.)
- Contains game data in `/data/` directory
- Has comprehensive documentation in main `README.md` and `INSTALL.md`

## File Structure Notes
- `/vendor/`: Composer-managed PHP dependencies
- `style.css`: Extracted from index.html (currently unused inline styles)
- `index-v0.html`: Legacy version of the editor