const elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss');

    mix.copy('node_modules/codemirror/lib/codemirror.css', 'public/css');
    mix.copy('node_modules/codemirror/theme/solarized.css', 'public/css');

    mix.scripts([
        './node_modules/codemirror/lib/codemirror.js',
        './node_modules/codemirror/mode/javascript/javascript.js'
    ], 'public/js/codemirror.js');

    mix.version([
        'css/app.css'
    ]);
});
