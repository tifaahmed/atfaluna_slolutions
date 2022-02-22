const mix  = require( 'laravel-mix' );
const path = require( 'path'        );


mix
    .js            ( path.resolve( __dirname , 'resources/js/app.js'     ) , 'public/js'  ).vue()
    .sass          ( path.resolve( __dirname , 'resources/sass/app.scss' ) , 'public/css' )
    // .options       ( { processCssUrls: false })
        .webpackConfig ( {

        module: { rules: [ {
            test    : /\.tsx?$/   ,
            loader  : 'ts-loader' ,
            exclude : /node_modules/
        } ] },

        resolve: {
            extensions : [ '*' , '.js' , '.jsx' , '.vue' , '.ts' , '.tsx' ],
            alias: {
                '@'   : path.resolve(__dirname, 'resources/js'),
                MainServices : path.resolve(__dirname, 'resources/js/Services'),


                AdminAsset    : path.resolve(__dirname, 'public/asset_ar'),

                AdminFolders      : path.resolve(__dirname, 'resources/js/Admin'),
                AdminModels       : path.resolve(__dirname, 'resources/js/Admin/Models'),
                AdminPartials     : path.resolve(__dirname, 'resources/js/Admin/Partials'),
                AdminPartialsModal     : path.resolve(__dirname, 'resources/js/Admin/Partials/Components/Modal'),
                AdminValidations  : path.resolve(__dirname, 'resources/js/Admin/Validation'),
                AdminRoutes       : path.resolve(__dirname, 'resources/js/Admin/Routes'),
                AdminViews        : path.resolve(__dirname, 'resources/js/Admin/Views'),

                SiteFolders      : path.resolve(__dirname, 'resources/js/Site'),
                SiteModels       : path.resolve(__dirname, 'resources/js/Site/Models'),
                SitePartials     : path.resolve(__dirname, 'resources/js/Site/Partials'),
                SiteViews        : path.resolve(__dirname, 'resources/js/Site/Views'),
                

            }
        },



    } );    


 

// const mix = require('laravel-mix');
// const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js').vue()
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ])
// ;

