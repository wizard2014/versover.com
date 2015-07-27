'use strict';

var gulp       = require('gulp'),
    concat     = require('gulp-concat'),
    uglify     = require('gulp-uglify'),
    less       = require('gulp-less'),
    minifyCss  = require('gulp-minify-css'),
    sourcemaps = require('gulp-sourcemaps');

var paths = {
    bower:  './bower_components',
    assets: './assets'
};

gulp.task('styles', function() {
    return gulp.src([
        paths.bower   + '/flexslider/flexslider.less',
        paths.bower   + '/owl-carousel/owl-carousel/owl.carousel.css',
        paths.bower   + '/owl-carousel/owl-carousel/owl.theme.css',
        paths.assets + '/styles/**/*.css',
        paths.assets + '/styles/**/*.less'
    ])
        .pipe(less())
        .pipe(concat('app.css'))
        .pipe(sourcemaps.init())
        .pipe(minifyCss())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./public/css'));
});

gulp.task('scripts', function() {
    return gulp.src([
        paths.bower   + '/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js',
        paths.bower   + '/jquery-placeholder/jquery.placeholder.js',
        paths.bower   + '/matchHeight/jquery.matchHeight.js',
        paths.bower   + '/fitvids/jquery.fitvids.js',
        paths.bower   + '/flexslider/jquery.flexslider.js',
        paths.bower   + '/validate/validate.js',
        paths.bower   + '/isMobile/isMobile.js',
        paths.bower   + '/owl-carousel/owl-carousel/owl.carousel.js',
        //paths.bower   + '/blueimp-gallery/js/jquery.blueimp-gallery.js',
        //paths.bower   + '/blueimp-bootstrap-image-gallery/js/bootstrap-image-gallery.js',
        paths.bower   + '/imagesloaded/imagesloaded.pkgd.js',
        paths.bower   + '/isotope/dist/isotope.pkgd.js',
        paths.bower   + '/masonry/dist/masonry.pkgd.js',
        paths.assets  + '/scripts/isotope-custom.js',
        paths.assets  + '/scripts/back-to-top.js',
        paths.assets  + '/scripts/flexslider-custom.js',
        paths.assets  + '/script/form-validation-custom.js',
        paths.assets  + '/scripts/form-mobile-fix.js',
        paths.assets  + '/scripts/owl-custom.js',
        paths.assets  + '/scripts/mail.js',
        paths.assets  + '/scripts/main.js'
    ])
        .pipe(concat('app.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./public/js'));
});

gulp.task('watch', function() {
    gulp.watch(paths.assets + '/styles/**/*.less', ['styles']);
    gulp.watch(paths.assets + '/scripts/**/*.js', ['scripts']);
});
gulp.task('default', ['styles', 'scripts']);