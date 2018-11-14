var gulp         = require('gulp'); // Gulp of-course
var fs           = require('fs');


// Parse values from package.json
var getPackageJSON = function() {
    return JSON.parse(fs.readFileSync('./package.json', 'utf8'));
};


module.exports = {

    projectName: getPackageJSON().name,

    packageJson: getPackageJSON(),

    base: './',

    // Any required paths
    paths: {
        css: {
            name:       'app',
            base:       'assets/sass/style.scss',
            folder:     'assets/css',
            watch:      'assets/sass/**/*.scss',
            dest:       'assets/css/',
        },
        js: {
            headName:   'head',
            mainName:   'app',
            folder:     'assets/js/',
            vendor:     'assets/js/front/vendor/*.js',
            custom:     'assets/js/front/custom/*.js',
            head:       'assets/js/front/head/*js',
            dest:       'assets/js/',
        },
        php: {
            watch:      '**/*.php'
        },
    },


    // Browsers you care about for autoprefixing.
    // Browserlist https        ://github.com/ai/browserslist
    autoprefixer_browser: [
        'last 2 version',
        '> 1%',
        'ie >= 9',
        'ie_mob >= 10',
        'ff >= 30',
        'chrome >= 34',
        'safari >= 7',
        'opera >= 23',
        'ios >= 7',
        'android >= 4',
    ],


    browsersync: {
        proxy: 'blanktheme.test', // Project URL.
        open: "external", // Allow external connections
        browser: "chrome", // Open the site in Chrome
        injectChanges: true, // Inject CSS changes on change
    },

};
