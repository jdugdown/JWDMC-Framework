# JWDMC-Framework

Starter Theme for JWDMC Websites


## Changelog
### 2.9.0
- Updated ACF Pro
- Added theme options page by default
- Updated TGM
- Changed formatting of page templates
- Added Material Design Icons

### 2.8.0
- Added a lightbox that automatically triggers for WordPress galleries
- Added a system font stack Sass variable
- Updated ACF Pro to v5.5.10
- Updated dependencies

### 2.7.0
- Added [ACF Content Analysis for Yoast SEO](https://wordpress.org/plugins/acf-content-analysis-for-yoast-seo/) to recommended plugins
- Added `deploystyles` Gulp task - a deploy task that only uploads Sass and CSS files when Sass changes are made
- Fix auto-scroll when clicking Bootstrap collapse toggles
- Minor Sass fixes

### 2.6.0
- New deployment and watch tasks (again)
- Minor formatting fixes

### 2.5.1
- Fix error in `package.json`

### 2.5.0
- We now include `package.json` and `gulpfile.js` in deployment
- New deployment and watch tasks to avoid publishing FTP info
- Added `.row-centered` styles for centering Bootstrap columns horizontally

### 2.4.2
- Update ACF Pro to v5.4.2

### 2.4.1
- Fix PHP file watching in `gulpfile.js`
- Updated bundled JSON file for interior page flexible content fields

### 2.4.0
- Replaced `gulp.watch()` with [gulp-watch](https://www.npmjs.com/package/gulp-watch) plugin (fixes issue where adding images to `/src` fails to trigger the images task)
- Implemented [gulp-sourcemaps](https://www.npmjs.com/package/gulp-sourcemaps) for our Sass code
- Updated bundled JSON file for interior page flexible content fields

### 2.3.0
- Updated Bootstrap to 3.3.7
- Fixed function prefixes
- Replaced gulp-ruby-sass with gulp-sass
- Introduced gulp-plumber and gulp-notify for easier error handling when compiling Sass code
- Added previously excluded PHP files to our watch and deploy tasks in `gulpfile.js`
- Streamlined `editor.css` and changed default font stack utilize system fonts in preparation for WordPress 4.6
- Improved floated images by centering on mobile
- Fixed no-gutter rows when used within a regular container

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
