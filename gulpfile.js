const gulp      = require('gulp');
const postcss   = require('gulp-postcss');
const sass      = require('gulp-sass')(require('sass'));
const cssnano   = require('cssnano');


function style(){
    let plugins = [
        cssnano()
    ];

    return gulp.src('./assets/style/*/*scss').pipe(sass()).pipe(postcss(plugins)).pipe(gulp.dest('./assets/build/'));
}

function watch() {
    gulp.watch('./assets/style/**/*.scss', style);
}



exports.style = style;
exports.watch = watch;
