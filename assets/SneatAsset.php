<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SneatAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'sneat/vendor/fonts/iconify-icons.css',
        'sneat/vendor/css/core.css',
        'css/site.css',
        'css/dark-mode.css'
    ];
    public $js = [
        'sneat/vendor/js/bootstrap.js',
        'sneat/vendor/js/helpers.js',
        'sneat/vendor/js/menu.js',
        'sneat/js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];

}