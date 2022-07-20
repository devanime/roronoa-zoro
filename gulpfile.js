const {src, dest, series, parallel, watch} = require('gulp');

const concat = require('gulp-concat');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
const prettify = require('gulp-jsbeautifier');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const del = require('del');

function clean() {
    return del(['assets/dist']);
}

function css() {
    var plugins = [
        autoprefixer(),
        cssnano()
    ];
    return src(['assets/scss/admin.scss'])
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss(plugins))
        .pipe(dest('assets/dist'));
}

function js() {
    return src(['assets/js/**/*.js'])
        .pipe(concat('main.js'))
        .pipe(uglify({
            compress: false,
            mangle: false,
        }))
        .pipe(prettify())
        .pipe(dest('assets/dist'))
        .pipe(uglify())
        .pipe(rename('main.min.js'))
        .pipe(dest('assets/dist'));
}

function watcher() {
    return watch(['assets/js/**/*.js', 'assets/scss/admin.scss'], parallel(css, js));
}

exports.watch = watcher;
exports.build = series(clean, parallel(css, js));
exports.default = exports.build;
