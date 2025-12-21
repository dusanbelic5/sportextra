const gulp      = require('gulp');
const postcss   = require('gulp-postcss');
const sass      = require('gulp-sass')(require('sass'));
const cssnano   = require('cssnano');
const zip       = require('gulp-zip');

const themeName = 'sport-extra';

function style() {
    let plugins = [
        cssnano()
    ];

    return gulp
        .src('./assets/style/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss(plugins))
        .pipe(gulp.dest('./assets/build/'));
}

function watch() {
    gulp.watch('./assets/style/**/*.scss', style);
}

function buildZip() {
    return gulp
        .src([
            './**/*',
            '!node_modules/**',
            '!assets/style/**',
            '!node_modules',
            '!assets/style'
        ])
        .pipe(zip(`${themeName}.zip`))
        .pipe(gulp.dest('./'));
}

exports.style = style;
exports.watch = watch;
exports.build = gulp.series(style, buildZip);
