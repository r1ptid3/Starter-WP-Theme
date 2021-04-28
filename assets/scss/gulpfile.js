'use strict';

let gulp = require('gulp'),
    browserSync = require('browser-sync').create(),
    sass = require('gulp-sass');

let siteDir = '../../';

gulp.task("scss", function () {
    return gulp.src('styles/*.scss')
        .pipe(sass.sync({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(gulp.dest('../css/'))
        .pipe(browserSync.reload({ stream: true }))
});

gulp.task("watch", function () {
    gulp.watch( ['styles/*.scss', 'styles/**/*.scss'], gulp.series('scss'));
});

gulp.task('browser-sync', function () {
    browserSync.init({
        proxy: {
            target: "http://tests.my"
        }
    });

    gulp.watch(siteDir + "**/*.php").on('change', browserSync.reload);
    gulp.watch(siteDir + "**/*.scss").on('change', browserSync.reload);
    gulp.watch(siteDir + "**/*.js").on('change', browserSync.reload);
});

gulp.task('default', gulp.parallel('watch', 'browser-sync'));