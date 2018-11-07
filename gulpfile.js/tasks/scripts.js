var gulp                    = require('gulp');

var lineec                  = require('gulp-line-ending-corrector'); // Consistent Line Endings for non UNIX systems. Gulp Plugin for Line Ending Corrector (A utility that makes sure your files have consistent line endings)

var concat                  = require('gulp-concat'); // Concatenates JS files
var uglify                  = require('gulp-uglify'); // Minifies JS files

var rename                  = require('gulp-rename');

var pump                    = require('pump');

var babel                   = require('gulp-babel');

var sourcemaps              = require('gulp-sourcemaps');

var projectName             = require('../../gulpconfig').projectName;
var base                    = require('../../gulpconfig').base;
var src                     = require('../../gulpconfig').src;
var paths                   = require('../../gulpconfig').paths;


// Concat js files for build
gulp.task( 'js', ['js:collate:head', 'js:collate:main'], function() {
    gulp.start('js:minify');
});


// Collate all scripts to be loaded initially to kick of the site
gulp.task( 'js:collate:head', function() {
    return gulp.src([
        base + paths.js.head,
    ])
    .pipe( sourcemaps.init() )
    .pipe( babel({
        presets: ['@babel/env']
    }) )
    .pipe( concat( paths.js.headName + '.js' ) )
    .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
    .pipe( sourcemaps.write('.') )
    .pipe( gulp.dest( base + paths.js.dest ) )
});


// Collate all scripts required for the majority of the site
gulp.task( 'js:collate:main', function() {
    return gulp.src([
        base + paths.js.vendor,
        base + paths.js.custom,
    ])
    .pipe( sourcemaps.init() )
    .pipe( babel({
        presets: ['@babel/env']
    }) )
    .pipe( concat( paths.js.mainName + '.js' ) )
    .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
    .pipe( sourcemaps.write('.') )
    .pipe( gulp.dest( base + paths.js.dest ) )
});

// Minify scripts
gulp.task('js:minify', function (cb) {
    pump([
        gulp.src( [
            base + paths.js.folder + '/' + paths.js.headName + '.js',
            base + paths.js.folder + '/' + paths.js.mainName + '.js'
        ] ),
        uglify( { mangle: { keep_fnames:true } , compress: { collapse_vars: false, keep_fnames:true } } ),
        lineec(),
        rename( { suffix: '.min' } ),
        gulp.dest( base + paths.js.dest )
    ],cb );
});
