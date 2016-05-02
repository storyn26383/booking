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

elixir(function(mix) {
    mix
        .sass('stylesheet.scss',
            'resources/assets/css/stylesheet.css', './')
        .styles([
            'bower_components/animate.css/animate.css',
            'resources/assets/css/stylesheet.css'
        ], 'public/css/stylesheet.css', './')

        .coffee('script.coffee',
            'resources/assets/js/script.js', './')
        .scripts([
            'bower_components/jquery/dist/jquery.js',
            'bower_components/bootstrap-sass/assets/javascripts/bootstrap.js',
            'bower_components/noty/js/noty/packaged/jquery.noty.packaged.js',
            'resources/assets/js/script.js'
        ], 'public/js/script.js', './')

        .copy('bower_components/font-awesome/fonts',
            'public/fonts/font-awesome')
        .copy('bower_components/bootstrap-sass/assets/fonts',
            'public/fonts');
});
