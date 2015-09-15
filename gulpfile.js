
// Author: halvard@mekom.no

var gulp        = require('gulp');
var babel       = require('gulp-babel');
var sass        = require('gulp-sass');
var concat      = require('gulp-concat');
var cssmin      = require('gulp-minify-css');
var rename      = require("gulp-rename");
var uglify      = require('gulp-uglify');
var changed     = require('gulp-changed');
var browserSync = require('browser-sync').create();
var plumber     = require('gulp-plumber');
var eslint      = require('gulp-eslint');
var stylish     = require('jshint-stylish');
var imagemin    = require('gulp-imagemin');
var pngquant    = require('imagemin-pngquant');
var notify      = require('gulp-notify');
var notifier    = require('node-notifier');

var readyNotifier = {
    title: 'Gulp',
    message: 'Ready to rumble!',
    time: 2000
};

var paths = {
    //source paths
    scss: [
        'src/scss/**/normalize.scss',
        'src/scss/**/helper-classes.scss',
        'src/scss/**/*.scss'
    ],
    js: 'src/js/**/*.js',
    img: 'src/img/*',
    //distribution paths
    cssDst: 'dist/css/',
    jsDst: 'dist/js/',
    imgDst: 'dist/img/'
};

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
        .pipe(notify('Generated CSS: <%= file.relative %>'))
        .pipe(browserSync.stream());
});

gulp.task('js', function() {
    return gulp.src(paths.js)
        .pipe(plumber({
            errorHandler: notify.onError("Error: <%= error.message %>")
        }))
        .pipe(babel())
        .pipe(concat('main.js'))
        .pipe(gulp.dest(paths.jsDst))
        .pipe(notify('Generated JS: <%= file.relative %>'))
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
        .pipe(eslint())
        .pipe(eslint.format())
        .on('error', notify.onError({ message: 'eslint failed.' }));
});

// Default
gulp.task('watch', function() {
    notifier.notify(readyNotifier);
    //source paths
    gulp.watch(paths.js, ['js']);
    gulp.watch(paths.scss, ['styles']);
    gulp.watch(paths.img, ['images']);
    //distribution paths
    gulp.watch(paths.jsDst, ['jslint']);
});
gulp.task('default', ['js', 'styles', 'images'], function(){
    notifier.notify(readyNotifier);
    //distribution paths
    gulp.watch(paths.jsDst, ['jslint']);
});

// Autorefresh
gulp.task('autorefresh', function(){
    gulp.task('browser-sync', function() {
        browserSync.init({
            proxy: '127.0.0.1'
        });
    });

    //source paths
    gulp.watch(paths.js, ['js', 'jslint', 'browser-sync']);
    gulp.watch(paths.scss, ['styles', 'browser-sync']);
    gulp.watch(paths.img, ['images', 'browser-sync']);
    //distribution paths
    gulp.watch(paths.jsDst, ['jslint']);

    gulp.watch("./").on('change', browserSync.reload);

    notifier.notify(readyNotifier);
});
