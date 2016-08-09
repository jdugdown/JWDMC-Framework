var gulp = require('gulp');

// require plugins - npm install --save-dev gulp-uglify gulp-rename gulp-plumber gulp-util gulp-notify gulp-sass gulp-sourcemaps gulp-autoprefixer gulp-clean-css gulp-imagemin gulp-watch vinyl-ftp
var uglify = require('gulp-uglify'),
	rename = require('gulp-rename'),
	plumber = require('gulp-plumber'),
	gutil = require('gulp-util'),
	notify = require('gulp-notify'),
	sass = require('gulp-sass'),
	sourcemaps = require('gulp-sourcemaps'),
	prefix = require('gulp-autoprefixer'),
	cleancss = require('gulp-clean-css'),
	imagemin = require('gulp-imagemin'),
	watch = require('gulp-watch'),
	ftp = require('vinyl-ftp');

// Scripts Task
// Minifies JavaScript with UglifyJS
gulp.task('scripts', function() {
	gulp.src('js/main.js')
		.pipe(uglify())
		.pipe(rename('main.min.js'))
		.pipe(gulp.dest('js/'));
});

// Styles Task
// Compiles Sass, then prefixes, and minifies the output before writing source maps
gulp.task('styles', function() {
	gulp.src('scss/**/*.scss')
		.pipe(plumber(function(error) {
			gutil.log(gutil.colors.red(error.message));
			notify.onError({
		        title: "Compile Error",
		        message: "Sass encountered an error. Check log for details.",
				sound: false,
		    }).apply(this, arguments);
			this.emit('end');
		}))
		.pipe(sourcemaps.init())
		.pipe(sass({outputStyle: 'expanded'}))
		.pipe(prefix({
			browsers: ['last 3 versions'],
		}))
		.pipe(cleancss())
		.pipe(rename('main.min.css'))
		.pipe(sourcemaps.write('../css/maps/'))
		.pipe(gulp.dest('css/'));
});

// Images Task
// Optimizes images
gulp.task('images', function() {
	gulp.src('src/*')
		.pipe(imagemin())
		.pipe(gulp.dest('img/'));
});

// Deploy Task
// Uploads newer files to remote server
gulp.task( 'deploy', function () {
	var conn = ftp.create( {
		host:     'hostname',
		user:     'username',
		password: 'password',
		parallel: 20,
		log:      gutil.log
	});

	var globs = [
	'css/**',
	'img/**',
	'js/**',
	'lib/**',
	'scss/**',
	'*.php',
	'page-templates/*.php',
	'lib/bones.php'
	];

	gulp.src(globs, { base: '.', buffer: false })
		.pipe(conn.newer('/path/to/remote/folder')) // only upload newer files!
		.pipe(conn.dest('/path/to/remote/folder'));
});

// Watch Task
// Watches files and runs other tasks when changes are detected
gulp.task('watch', function() {
	// Watch main.js and run the Scripts Task if a change is detected
	watch('js/main.js', function() {
		gulp.start('scripts');
	});
	// Run the Deploy Task if new JavaScript is minified into main.min.js
	watch('js/main.min.js', function() {
		gulp.start('deploy');
	});

	// Watch the src directory and run the Images Task if a change is detected
	watch('src/*', function() {
		gulp.start('images');
	});
	// Run the Deploy Task if new images are optimized and copied to the img directory
	watch('img/*', function() {
		gulp.start('deploy');
	});

	// Watch Sass files and run the Styles Task if a change is detected
	watch('scss/**/*.scss', function() {
		gulp.start('styles');
	});
	// Run the Deploy Task if new CSS is written to main.min.css
	watch('css/main.min.css', function() {
		gulp.start('deploy');
	});
});

gulp.task('default', ['scripts', 'styles', 'watch']);
