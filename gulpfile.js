var elixir = require('laravel-elixir');


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */


var paths = {
    'gentelellaSrc': 'node_modules/gentelella/src/',
    'gentelellaBuild': 'node_modules/gentelella/build/',
    'gentelellaVendor': 'node_modules/gentelella/vendors/',
};

elixir(function(mix) {
    mix.copy(paths.gentelellaSrc + 'js/**', 'resources/assets/js')
        .copy(paths.gentelellaSrc + 'scss/**', 'resources/assets/sass')
        .copy(paths.gentelellaBuild + 'css/custom.css', 'resources/assets/css')
        .copy(paths.gentelellaBuild + 'js/custom.js', 'resources/assets/js')
        .copy(paths.gentelellaVendor + 'bootstrap/dist/js/bootstrap.js', 'resources/assets/js')
        .copy(paths.gentelellaVendor + 'bootstrap/dist/css/bootstrap.css', 'resources/assets/css')
        .copy(paths.gentelellaVendor + 'bootstrap/dist/css/bootstrap-theme.css', 'resources/assets/css')
        .copy(paths.gentelellaVendor + 'jquery/dist/jquery.js', 'resources/assets/js')
    .copy(paths.gentelellaVendor + 'jquery/dist/jquery.js', 'resources/assets/js')
    .copy(paths.gentelellaVendor + 'font-awesome/css/font-awesome.css', 'resources/assets/css');
});

elixir(function(mix) {
    mix.sass(['custom.scss', 'daterangepicker.scss', 'app.scss'], 'resources/assets/css')
        .styles(['bootstrap.css',
            'bootstrap-theme.css',
            'font-awesome.css',
            'app.css'
        ], 'public/css/app.css')
        .scripts(['jquery.js', 'bootstrap.min.js', 'custom.js'], 'public/js/all.js')
        .version(['css/app.css', 'js/all.js']);
});