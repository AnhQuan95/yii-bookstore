<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LoginAppAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    // 'css/site.css'
    'css/bootstrap.min.css',

    'css/owl.carousel.css',

    'css/new-slider.css',

    'css/prettyPhoto.css',

    'css/jquery.bxslider.css', 

    'css/font-awesome.min.css',
    'css/svg.css',

    'css/widget.css',

    'css/typography.css',

    'css/shortcodes.css',

    'style.css',

    'css/range-slider.css',

    'css/color.css',

    'css/selectric.css',

    'css/jquery.sidr.dark.css',

    'js/dl-menu/component.css',

    'css/responsive.css',
    'css/customize.css'

  ];
  public $js = [
    //'js/jquery.js',

  ];
  public $depends = [
   'yii\web\YiiAsset',
    //'yii\bootstrap\BootstrapAsset',
 ];
}
