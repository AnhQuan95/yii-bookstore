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
        // 'css/site.css',
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/AdminLTE.css',
        'css/_all-skins.min.css',
        'css/jquery-ui.css',
        'css/style.css',
   
    ];
    public $js = [
        'js/angular.min.js',
        'js/app.js',
        // 'js/jquery.min.js',
        //'js/jquery-ui.js',
        'js/bootstrap.min.js',
        'js/adminlte.min.js',
        //'js/dashboard.js',
        'js/function.js',
        'js/main.js',
        'tinymce/tinymce.min.js',
       

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
