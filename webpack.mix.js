const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/custom.scss', 'public/css')
    .copy("node_modules/jqueryui/jquery-ui.js", "public/js/jquery-ui.js")
    .copy("node_modules/jqueryui/jquery-ui.theme.css", "public/css/jquery-ui.css")
    .copy("node_modules/jqueryui/images/**", "public/css/images/")
    .copy("node_modules/bootstrap/dist/css/bootstrap.css", "public/css/bootstrap.css")
    .copy("node_modules/bootstrap/dist/js/bootstrap.js", "public/js/bootstrap.js")
    .copy("node_modules/bootstrap/dist/fonts/**", "public/fonts/")
    .copy('node_modules/tether/dist/js/tether.js', 'public/js/tether.js')
    .copy('node_modules/tether/dist/css/tether.css', 'public/css/tether.css')
    .copy("node_modules/typeahead.js/dist/bloodhound.js", "public/js/bloodhound.js")
    .copy("node_modules/typeahead.js/dist/typeahead.bundle.js", "public/js/typeahead.bundle.js")
    .copy('node_modules/jquery/dist/jquery.js', 'public/js/jquery.js')
    .copy('node_modules/bootbox/src/bootbox.js', 'public/js/bootbox.js')
    .copy('node_modules/bootstrap-switch/dist/css/bootstrap2/bootstrap-switch.css', 'public/css/bootstrap-switch.css')
    .copy('node_modules/bootstrap-switch/dist/js/bootstrap-switch.js', 'public/js/bootstrap-switch.js')
    .copy('node_modules/datatables.net/js/jquery.dataTables.js', 'public/js/jquery.dataTables.js')
    .copy('node_modules/datatables.net-bs/js/dataTables.bootstrap.js', 'public/js/dataTables.bootstrap.js')
    .copy('node_modules/datatables.net-bs/css/dataTables.bootstrap.css', 'public/css/dataTables.bootstrap.css')
    .copy('node_modules/moment/moment.js', 'public/js/moment.js')
    .copy('node_modules/moment-timezone/moment-timezone.js', 'public/js/moment-timezone.js')
    .copy('node_modules/moment-timezone/builds/moment-timezone-with-data.js', 'public/js/moment-timezone-with-data.js')
    .copy('node_modules/jquery.cookie/jquery.cookie.js', 'public/js/jquery.cookie.js')
    .copy('resources/assets/custom/css/**', 'public/css/')
    .copy('resources/assets/custom/js/**', 'public/js/')
    .scripts([
        'public/js/jquery.js',
        'public/js/jquery-ui.js',
        'public/js/tether.js',
        'public/js/moment.js',
        'public/js/moment-timezone.js',
        'public/js/moment-timezone-with-data.js',
        'public/js/bootstrap.js',
        'public/js/bloodhound.js',
        'public/js/typeahead.bundle.js',
        'public/js/jquery.dataTables.js',
        'public/js/dataTables.bootstrap.js',
        'public/js/jquery.cookie.js',
        'public/js/bootbox.js',
        'public/js/bootstrap-switch.js',
        'public/js/custom.js',
        'public/js/loader.js',
    ], 'public/js/all.js')
    .styles([
        'public/css/tether.css',
        'public/css/bootstrap.css',
        'public/css/jquery-ui.css',
        'public/css/bootstrap-switch.css',
        'public/css/dataTables.bootstrap.css',
        'public/css/custom.css',
        'public/css/loader.css',
    ], 'public/css/all.css')
    .version();
