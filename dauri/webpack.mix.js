const mix = require('laravel-mix');

if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps().webpackConfig({devtool: 'source-map'});
}


mix.setPublicPath('assets/dist')
    .setResourceRoot('/wp-content/themes/dauri/assets/dist');

mix.js('assets/src/js/app.js', 'app.js')
    .less('assets/src/less/styles.less', 'styles.css');