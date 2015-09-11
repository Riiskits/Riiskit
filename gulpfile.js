
// Author: halvard@mekom.no

var gulp       = require('gulp');
var sass       = require('gulp-sass');
var concat     = require('gulp-concat');
var cssmin     = require('gulp-minify-css');
var rename     = require("gulp-rename");
var uglify     = require('gulp-uglify');
var changed    = require('gulp-changed');
var livereload = require('gulp-livereload');
var plumber    = require('gulp-plumber');
var scsslint   = require('gulp-scss-lint');
var sourcemaps = require('gulp-sourcemaps');
var jshint     = require('gulp-jshint');
var stylish    = require('jshint-stylish');
var notify     = require('gulp-notify');

var paths = {
    //source paths
    scss: 'src/scss/**/*.scss',
    js: 'src/js/plugins.js, src/js/**/*.js',
    //distribution paths
    cssDst: 'dist/css/',
    jsDst: 'dist/js/'
};

gulp.task('styles', function () {
    return gulp.src(paths.scss)
        .pipe(sass({includePaths: require('node-bourbon').includePaths}))
        .pipe(plumber())
        .pipe(gulp.dest(paths.cssDst))
        .pipe(cssmin())
        .pipe(concat('main.css'))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest(paths.cssDst + 'min/'));
});

gulp.task('lint', function(){
    //sass lint
    gulp.src(paths.scss)
    .pipe(scsslint());
    //jshint
    gulp.src(paths.js)
    .pipe(jshint())
    .pipe(jshint.reporter(stylish));
});

gulp.task('scripts', function () {
   return gulp.src(paths.js)
    .pipe(plumber())
    .pipe(concat('main.js'))
    .pipe(gulp.dest(paths.jsDst))
    .pipe(uglify())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest(paths.jsDst + 'min/'));
});

gulp.task('watch', function(){
    gulp.watch(paths.js, function(){
        gulp.start('scripts');
    });
    gulp.watch(paths.scss, function(){
        gulp.start('styles');
    });
});

gulp.task('default', function() {
    gulp.start('scripts');
    gulp.start('styles');
});
