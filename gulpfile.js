var gulp = require('gulp'),
	uglify = require('gulp-uglify'),
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

var gulpftp = require('./gulpconfig.js');


/**
 * Scripts Task
 * Minifies JavaScript with UglifyJS
 *
 * Usage: `gulp scripts`
 */
gulp.task('scripts', function() {
	gulp.src('js/main.js')
		.pipe(uglify())
		.pipe(rename('main.min.js'))
		.pipe(gulp.dest('js/'));
});


/**
 * Styles Task
 * Compiles Sass, then prefixes, and minifies the output before writing source maps
 *
 * Usage: `gulp styles`
 */
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


/**
 * Images Task
 * Optimizes images
 *
 * Usage: `gulp images`
 */
gulp.task('images', function() {
	gulp.src('src/*')
		.pipe(imagemin())
		.pipe(gulp.dest('img/'));
});


/**
 * Deploy Task
 * Upload changed files to remote server
 *
 * Usage: `gulp deploy`
 */
gulp.task( 'deploy', function () {
	var conn = ftp.create({
		host:     gulpftp.config.host,
		user:     gulpftp.config.user,
		password: gulpftp.config.pass,
		parallel: 20,
		log:      gutil.log,
	});

	var globs = [
		'**/*',
		'*',
		'!node_modules',
		'!node_modules/**',
		'!src',
		'!src/**',
		'!gulpconfig.js',
		'!.git',
		'!.git/**',
		'!.gitignore',
		'!.sass-cache',
		'!.sass-cache/**',
		'!.ftpconfig',
		'!sftp-config.json',
		'!ftpsync.settings',
	];

	gulp.src(globs, { base: '.', buffer: false })
		.pipe(conn.newer( gulpftp.config.path )) // only upload newer files!
		.pipe(conn.dest( gulpftp.config.path ));
});


/**
 * Deploy Styles Task
 * Upload Sass and CSS files to remote server
 *
 * Usage: `gulp deploystyles`
 */
gulp.task( 'deploystyles', function () {
	var conn = ftp.create({
		host:     gulpftp.config.host,
		user:     gulpftp.config.user,
		password: gulpftp.config.pass,
		parallel: 20,
		log:      gutil.log,
		secure:   true,
		secureOptions: {
			rejectUnauthorized: false
		}
	});

	var globs = [
		'scss/**/*',
		'css/**/*',
	];

	gulp.src(globs, { base: '.', buffer: false })
		.pipe(conn.newer( gulpftp.config.path )) // only upload newer files!
		.pipe(conn.dest( gulpftp.config.path ));
});


/**
 * Watch Task
 * Watches files and runs other tasks when changes are detected
 *
 * Usage: `gulp watch`
 */
gulp.task('watch', function() {
	// Watch main.js and run the Scripts Task if a change is detected
	watch('js/main.js', function() {
		gulp.start('scripts');
	});
	// Run the Deploy Task if new JavaScript is minified into main.min.js
	watch('js/main.min.js', function() {
		gulp.start('deploy');
	});

	// Watch Sass files and run the Styles Task if a change is detected
	watch('scss/**/*.scss', function() {
		gulp.start('styles');
	});
	// Run the Deploy Styles Task if new CSS is written to main.min.css
	watch('css/main.min.css', function() {
		gulp.start('deploystyles');
	});

	// Watch the src directory and run the Images Task if a change is detected
	watch('src/*', function() {
		gulp.start('images');
	});
	// Run the Deploy Task if new images are optimized and copied to the img directory
	watch('img/*', function() {
		gulp.start('deploy');
	});

	// Watch PHP files and run the Deploy Task if changes are detected
	watch(['*.php', 'page-templates/*.php', 'lib/bones.php'], function() {
		gulp.start('deploy');
	});
});
