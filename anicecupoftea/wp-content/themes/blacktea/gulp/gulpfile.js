/**
 * ref: https://gist.github.com/mikedugan/9bff21933aadb08e2aaa
 * 
 * INSTALL:
 * sudo apt-get install nodejs npm
 * sudo npm install -g gulp
 * npm install
 *
 * Livereload: need browser plugin (eg. for Chrome) + set up localhost to surf to your build
 *
 * TODO:
 * install plugin to compile svg sprite to png
 * find something to compile the templates with includes (like twig)
 * 
 * FIXES:
 * If imagemin errors or images don't build: make sure xcode is installed, update the 3 imagemin dependencies, try removing 'cache'
 * If nothing builds but no errors: remove runSequence and use normal calling of tasks, remove livereload
 * 
 */

var gulp = require('gulp'),
    
    // cleanup files
    del = require('del'),

    // sass
    sass = require('gulp-sass'),
    cssmin = require('gulp-minify-css'),
    rename = require('gulp-rename'),
    sourcemaps = require('gulp-sourcemaps'), // normally for js but also works for Sass

    // images
    cache = require('gulp-cache'),
    imgmin = require('gulp-imagemin'),
    optipng = require('imagemin-optipng'),
    jpgtran = require('imagemin-jpegtran'),
    svgo = require('imagemin-svgo'),

    // notifications
    notify = require('gulp-notify'),
    plumber = require('gulp-plumber'), // This will keeps pipes working after error event

    // running tasks
    watch = require('gulp-watch'), // catch updates
    runSequence = require('run-sequence'); // this may break eventually: makes tasks go in sequence instead of asynch

// Sources
var folders = {
        sass: './../sass',
        css: './../css',
        img: './../img'
    };

var files = {
        sass: './../sass/**/*.scss',
        svg: './../img/**/*.svg',
        png: './../img/**/*.png',
        jpg: './../img/**/*.jpg'
    };

/*gulp.task('build', 
    ['sass-compile']
);*/

gulp.task('default', function(callback) {
    runSequence(
        'build', // everything in square brackets runs asynch
        'watch' // everything outside square brackets runs after prev. tasks
    );
});

gulp.task('build', function() {
    runSequence(
        ['sass-compile', 'pngmin', 'jpgmin', 'svgmin'] // everything in square brackets runs asynch
    );
});

// watch assets and build for changes
gulp.task('watch', function() {

    gulp.watch(files.sass, ['sass-compile']);
});

// remove old builds
gulp.task('clean', function (cb) {
    return del(files.html, { force: true }, cb);
});

gulp.task('sass-compile', function(){
    return gulp.src(files.sass)
      .pipe(plumber())
      .pipe(sourcemaps.init())
      .on('error', notify.onError("Error: <%= error.message %>")) // options is the same as the regular notify()
      .pipe(sass())
      .on('error', notify.onError("Error: <%= error.message %>")) // options is the same as the regular notify()
      .pipe(sourcemaps.write('.'))
      .on('error', notify.onError("Error: <%= error.message %>")) // options is the same as the regular notify()
      //.pipe(gulp.dest(folders.css))
      //.on('error', notify.onError("Error: <%= error.message %>")) // options is the same as the regular notify()
      //.pipe(cssmin({keepBreaks: false}))
      //.on('error', notify.onError("Error: <%= error.message %>")) // options is the same as the regular notify()
      //.pipe(rename({suffix: '.min'}))
      //.on('error', notify.onError("Error: <%= error.message %>")) // options is the same as the regular notify()
    .pipe(gulp.dest(folders.css))

});

gulp.task('pngmin', function() {
    gulp.src(files.png)
      .pipe(plumber())
      .pipe(imgmin({
          use: [optipng({optimizationLevel:3})],
          interlaced: true
      }))
      .on('error', notify.onError("Error: <%= error.message %>")) // options is the same as the regular notify()
      .pipe(gulp.dest(folders.img))
});
 
gulp.task('jpgmin', function() {
    gulp.src(files.jpg)
      .pipe(plumber())
      .pipe(imgmin({
          progressive: true,
          use: [jpgtran()]
      }))
      .on('error', notify.onError("Error: <%= error.message %>")) // options is the same as the regular notify()
    .pipe(gulp.dest(folders.img))
});
 
gulp.task('svgmin', function() {
   gulp.src(files.svg)
     .pipe(plumber())
     .pipe(imgmin({
        svgoPlugins: [{removeViewBox: false}]
     }))
      .on('error', notify.onError("Error: <%= error.message %>")) // options is the same as the regular notify()
    .pipe(gulp.dest(folders.img))
});
