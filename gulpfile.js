var gulp = require('gulp');

// require plugins - npm install --save-dev gulp-uglify gulp-uglifycss gulp-plumber gulp-notify gulp-sass gulp-autoprefixer gulp-csscomb gulp-rename gulp-imagemin gulp-util vinyl-ftp
var uglify = require('gulp-uglify'),
	uglifycss = require('gulp-uglifycss'),
	plumber = require('gulp-plumber'),
	notify = require('gulp-notify'),
	sass = require('gulp-sass'),
	prefix = require('gulp-autoprefixer'),
	csscomb = require('gulp-csscomb'),
	rename = require('gulp-rename'),
	imagemin = require('gulp-imagemin'),
	gutil = require('gulp-util'),
	ftp = require('vinyl-ftp');

// Scripts Task
// Minifies JavaScript with UglifyJS
gulp.task('scripts', function() {
	gulp.src('js/main.js')
		.pipe(uglify())
		.pipe(rename('main.min.js'))
		.pipe(gulp.dest('js/'));
});

// Images Task
// Optimizes images
gulp.task('images', function() {
	gulp.src('src/**/*')
		.pipe(imagemin())
		.pipe(gulp.dest('img'));
});

// Styles Task
// Compiles Sass, then combs and minifies the output
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
		.pipe(sass({outputStyle: 'expanded'}))
		.pipe(prefix({
			browsers: ['last 3 versions'],
		}))
		.pipe(csscomb())
		.pipe(rename('main.css'))
		.pipe(gulp.dest('css/'))
		.pipe(uglifycss({
			'uglyComments': true
		}))
		.pipe(rename('main.min.css'))
		.pipe(gulp.dest('css/'));
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
	gulp.watch('js/main.js', ['scripts']);
	// Run the Deploy Task if new JavaScript is minified into main.min.js
	gulp.watch('js/main.min.js', ['deploy']);

	// Watch the src directory and run the Images Task if a change is detected
	gulp.watch('src/**/*', ['images']);
	// Run the Deploy Task if new images are optimized and copied to the img directory
	gulp.watch('img/*', ['deploy']);

	// Watch Sass files and run the Styles Task if a change is detected
	gulp.watch('scss/**/*.scss', ['styles']);
	// Run the Deploy Task if new CSS is written to main.min.css
	gulp.watch('css/main.min.css', ['deploy']);

	// Run the Deploy Task if changes are detected in any PHP file
	gulp.watch(['*.php', 'page-templates/*.php', 'lib/bones.php'], ['deploy']);
});

gulp.task('default', ['scripts', 'styles', 'watch']);
