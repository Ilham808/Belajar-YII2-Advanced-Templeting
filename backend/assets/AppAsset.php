<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'theme/libs/chartist/dist/chartist.min.css',
        'theme/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css',
        'theme/dist/css/style.min.css'
    ];
    public $js = [
        'theme/libs/bootstrap/dist/js/bootstrap.bundle.min.js',
        'theme/dist/js/app-style-switcher.js',
        'theme/dist/js/waves.js',
        'theme/dist/js/sidebarmenu.js',
        'theme/dist/js/custom.js',
        'theme/dist/js/pages/dashboards/dashboard1.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
