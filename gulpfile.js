var gulp = require('gulp');
var sass = require(('gulp-sass'))
var watch = require('gulp-watch')

gulp.task('sass', function() {
    return gulp.src('app/scss/styles.scss')
        .pipe(sass())
        .pipe(gulp.dest('app/dest'))
});

