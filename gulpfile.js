
// Author: halvard@mekom.no

var gulp        = require('gulp');
var sass        = require('gulp-sass');
var concat      = require('gulp-concat');
var cssmin      = require('gulp-minify-css');
var rename      = require("gulp-rename");
var uglify      = require('gulp-uglify');
var changed     = require('gulp-changed');
var browserSync = require('browser-sync').create();
var plumber     = require('gulp-plumber');
var jshint      = require('gulp-jshint');
var stylish     = require('jshint-stylish');
var imagemin    = require('gulp-imagemin');
var pngquant    = require('imagemin-pngquant');
var notify      = require('gulp-notify');

var paths = {
    //source paths
    scss: [
        'src/scss/base/normalize.scss',
        'src/scss/utilities/helper-classes.scss',
        'src/scss/**/*.scss'
    ],
    js: 'src/js/**/*.js',
    img: 'src/img/*',
    //distribution paths
    cssDst: 'dist/css/',
    jsDst: 'dist/js/',
    imgDst: 'dist/img/'
};

gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: '127.0.0.1'
    });
});

gulp.task('styles', function() {
    return gulp.src(paths.scss)
        .pipe(sass({
            includePaths: require('node-bourbon').includePaths
        }))
        .pipe(plumber({
            errorHandler: notify.onError("Error: <%= error.message %>")
        }))
        .pipe(gulp.dest(paths.cssDst))
        .pipe(cssmin())
        .pipe(concat('main.css'))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest(paths.cssDst + 'min/'))
        .pipe(notify('Generated CSS file: <%= file.relative %>'))
        .pipe(browserSync.stream());
});

gulp.task('js', function() {
    return gulp.src(paths.js)
        .pipe(plumber({
            errorHandler: notify.onError("Error: <%= error.message %>")
        }))
        .pipe(concat('main.js'))
        .pipe(gulp.dest(paths.jsDst))
        .pipe(uglify())
        .pipe(rename({
          suffix: '.min'
        }))
        .pipe(gulp.dest(paths.jsDst + 'min/'))
        .pipe(notify('Generated JS file: <%= file.relative %>'))
        .pipe(browserSync.stream());
});

gulp.task('images', function() {
    return gulp.src(paths.img)
        .pipe(plumber({
            errorHandler: notify.onError("Error: <%= error.message %>")
        }))
        .pipe(imagemin({
            progressive: true,
            interlaced: true,
            use: [pngquant()]
        }))
        .pipe(gulp.dest(paths.imgDst))
        .pipe(notify('Images compressed.'))
        .pipe(browserSync.stream());
});

gulp.task('jslint', function() {
    gulp.src(paths.js)
        .pipe(jshint())
        .pipe(jshint.reporter(stylish))
        .pipe(jshint.reporter('fail'))
        .on('error', notify.onError({ message: 'JS hint fail'}));
});

gulp.task('watch', function() {
    gulp.watch(paths.js, ['js', 'jslint']);
    gulp.watch(paths.scss, ['styles']);
    gulp.watch(paths.img, ['images']);
});

gulp.task('watch-autorefresh', function() {
    gulp.watch(paths.js, ['js', 'jslint', 'browser-sync']);
    gulp.watch(paths.scss, ['styles', 'browser-sync']);
    gulp.watch(paths.img, ['images', 'browser-sync']);
});

gulp.task('default', ['watch']);
gulp.task('autorefresh', ['watch-autorefresh']);
