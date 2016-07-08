# JWDMC-Framework

Starter Theme for JWDMC Websites


## Changelog
### 2.2.0
- Added a standard interior page template (`/page-templates/interior.php`) and JSON file (`/lib/plugins/interior-page-fields.json`) to import related ACF fields
- Revised gallery CSS to work with options in new interior page template
- Added an error handling function to `gulpfile.js` to prevent Gulp from crashing on Sass errors
- Added [FakerPress](https://wordpress.org/plugins/fakerpress/) to recommended plugins to ease the process of adding placeholder content during development
- Added option to use a string (eg, `'min-width: 1400px'`) in lieu of a fixed value in our media query mixin
- Updated Slick to 1.6.0

### 2.1.0
- Updated bundled plugins to include [ACF Pro](https://www.advancedcustomfields.com/pro/)

### 2.0.0
- Stable release

### 2.0.0-beta
- Overhaul of file structure
- Introduced Sass and Gulp to our workflow
