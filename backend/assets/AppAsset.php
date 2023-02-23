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
        'theme/dist/css/style.min.css',
    ];
    public $js = [
        'theme/libs/bootstrap/dist/js/bootstrap.bundle.min.js',
        'theme/dist/js/app-style-switcher.js',
        'theme/dist/js/waves.js',
        'theme/dist/js/sidebarmenu.js',
        'theme/dist/js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
