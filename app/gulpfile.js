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
    mix.sass('app.scss')

    mix.copy('node_modules/clipboard/dist/clipboard.min.js', 'public/js');

    mix.copy('node_modules/codemirror/lib/codemirror.css', 'public/css');
    mix.copy('node_modules/codemirror/theme/solarized.css', 'public/css');

    mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js');

    mix.copy('node_modules/codemirror/lib/codemirror.js', 'public/js');
    mix.copy('node_modules/codemirror/mode', 'public/js/modes');
    mix.copy('node_modules/codemirror/addon', 'public/js/addons');

    mix.version([
        'css/app.css',
        'js/jquery.min.js',
        'js/codemirror.js',
        'js/clipboard.min.js'
    ]);
});
