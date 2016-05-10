var gulp = require('gulp');

// require plugins - npm install --save-dev gulp-uglify gulp-uglifycss gulp-ruby-sass gulp-autoprefixer gulp-csscomb gulp-rename gulp-imagemin gulp-util vinyl-ftp
var uglify = require('gulp-uglify'),
	uglifycss = require('gulp-uglifycss'),
	sass = require('gulp-ruby-sass'),
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
	gulp.src('src/img/*')
		.pipe(imagemin())
		.pipe(gulp.dest('img'));
});

// Styles Task
// Compiles Sass, then combs and minifies the output
gulp.task('styles', function() {
	sass('scss/**/*.scss', {
		style: 'expanded',
		stopOnError: true,
	})
		.on('error', sass.logError)
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
		parallel: 8,
		log:      gutil.log
	} );

	var globs = [
	'css/**',
	'img/**',
	'js/**',
	'lib/**',
	'scss/**',
	'*.php'
	];

	gulp.src( globs, { base: '.', buffer: false } )
		.pipe( conn.newer( '/httpdocs' ) ) // only upload newer files!
		.pipe( conn.dest( '/httpdocs' ) );
});

// Watch Task
// Watches files and runs other tasks when changes are detected
gulp.task('watch', function() {
	gulp.watch('js/main.js', ['scripts', 'deploy']);
	gulp.watch('src/img/*', ['images', 'deploy']);
	gulp.watch('scss/**/*.scss', ['styles', 'deploy']);
	gulp.watch('*.php', ['deploy']);
});

gulp.task('default', ['scripts', 'styles', 'watch']);
