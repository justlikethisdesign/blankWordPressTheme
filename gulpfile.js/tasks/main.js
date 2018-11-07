var gulp = require('gulp');

// General build
gulp.task('default', ['general']);

// Build without launch
gulp.task('general', ['js', 'css', 'browser-sync']);

gulp.task('stage', ['general'], function(){
    gulp.start('deploy::staging');
});
