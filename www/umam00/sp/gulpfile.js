'use strict';
 
var gulp = require('gulp');
var sass = require('gulp-sass');
 
sass.compiler = require('node-sass');
 
gulp.task('sass', function () {
  return gulp.src('assets/src/scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('assets/src/css'));
});
 
gulp.task('default', function () {
  gulp.watch('assets/src/scss/**/*.scss', gulp.series('sass'));
});