var gulp                    = require('gulp');

var fs                      = require('fs');

var sass                    = require('gulp-sass'); // Gulp plugin for Sass compilation.

var concat                  = require('gulp-concat');

var stripCssComments        = require('gulp-strip-css-comments');

var minifycss               = require('gulp-uglifycss'); // Minifies CSS files.
var autoprefixer            = require('gulp-autoprefixer'); // Autoprefixing magic.
var mmq                     = require('gulp-merge-media-queries'); // Combine matching media queries

var sourcemaps              = require('gulp-sourcemaps'); // Maps code in a compressed file (E.g. style.css) back to it’s original position in a source file (E.g. structure.scss, which was later combined with other css files to generate style.css)

var rename                  = require('gulp-rename'); // Renames files E.g. style.css -> style.min.css
var lineec                  = require('gulp-line-ending-corrector'); // Consistent Line Endings for non UNIX systems. Gulp Plugin for Line Ending Corrector (A utility that makes sure your files have consistent line endings)

var projectName             = require('../../gulpconfig').projectName;
var base                    = require('../../gulpconfig').base;
var paths                   = require('../../gulpconfig').paths;

var autoprefixer_browser    = require('../../gulpconfig').autoprefixer_browser;

var fileExists              = require('file-exists');

// Parse values from package.json
var getPackageJSON = function() {
    return JSON.parse(fs.readFileSync('./package.json', 'utf8'));
};


// Turn Sass to CSS
// Save in source folder


gulp.task('css:sass', function() {
    return processSASS(  gulp.src( base + paths.css.base ) )
        .pipe( concat( paths.css.name + '.css' ) )
        .pipe( sourcemaps.write('.') )
        .pipe( gulp.dest( base + paths.css.dest ) );
});


// This is required on both critical and non critical
function processSASS( stream ){
    return stream
        .pipe( sourcemaps.init() )
        .pipe( sass( {
            errLogToConsole: true,
            //outputStyle: 'compact',
            //outputStyle: 'compressed',
            // outputStyle: 'nested',
            //outputStyle: 'expanded',
            precision: 10
        } ) )
        .on('error', console.error.bind(console))
        .pipe( autoprefixer( autoprefixer_browser ) )
        .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
}


gulp.task('css:minify', function() {
    return gulp.src( [
        base + paths.css.dest + '*.css',
        '!' + base + paths.css.dest + '*.min.css'
    ])
        .pipe( stripCssComments({
            preserve: false //strip all comments
        }) )
        .pipe( rename( { suffix: '.min' } ) )
        .pipe( minifycss( {
          maxLineLen: 10
        }))
        .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
        .pipe( gulp.dest( base + paths.css.dest ) )
});


gulp.task('css',['css:sass'], function() {
    gulp.start('css:minify');
});
