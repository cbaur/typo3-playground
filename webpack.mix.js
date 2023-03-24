let mix = require('laravel-mix');
require('dotenv');
const Path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */
mix.setPublicPath(process.env.DEPLOY_PATH);
mix.setResourceRoot('../');
if(process.env.ENABLE_FONTAWESOME) {
  mix.copyDirectory(`node_modules/@fortawesome/fontawesome${process.env.ENABLE_FONTAWESOME_FREE === 1 ? '' : '-pro'}/svgs`, 'public/assets/icons');
}
mix.js('frontend/scripts/index.js', 'js')
  .sass('frontend/styles/index.scss', 'css')
  .extract();

mix.autoload({
  jquery: ['$', 'window.jQuery']
});
mix.webpackConfig(webpack => {
  return {};
});
// Full API
// mix.js(frontend, output);
// mix.react(frontend, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.preact(frontend, output); <-- Identical to mix.js(), but registers Preact compilation.
// mix.coffee(frontend, output); <-- Identical to mix.js(), but registers CoffeeScript compilation.
// mix.ts(frontend, output); <-- TypeScript support. Requires tsconfig.json to exist in the same folder as webpack.mix.js
// mix.extract(vendorLibs);
// mix.sass(frontend, output);
// mix.less(frontend, output);
// mix.stylus(frontend, output);
// mix.postCss(frontend, output, [require('postcss-some-plugin')()]);
// mix.browserSync('my-site.test');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.babelConfig({}); <-- Merge extra Babel configuration (plugins, etc.) with Mix's default.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.override(function (webpackConfig) {}) <-- Will be triggered once the webpack config object has been fully generated by Mix.
// mix.dump(); <-- Dump the generated webpack config object to the console.
// mix.extend(name, handler) <-- Extend Mix's API with your own components.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   globalVueStyles: file, // Variables file to be imported in every component.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   terser: {}, // Terser-specific options. https://github.com/webpack-contrib/terser-webpack-plugin#options
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });
