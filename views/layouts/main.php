<?php

/** @var \yii\web\View $this */
/** @var string $content */

use app\assets\SneatAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

SneatAsset::register($this);

$isGuest = Yii::$app->user->isGuest;

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0, user-scalable=no']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="light-style layout-menu-fixed" data-theme="theme-default">
<head>
    <script>
    (function () {
        var theme = localStorage.getItem('theme') || 'light';
        document.documentElement.classList.toggle('dark-style', theme === 'dark');
        document.documentElement.classList.toggle('light-style', theme !== 'dark');
    })();
    </script>

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="layout-wrapper layout-content-navbar <?= $isGuest ? 'layout-without-menu' : '' ?>">
    <div class="layout-container">

        <!-- SIDEBAR -->
        <?php if (!$isGuest): ?>
            <?= $this->render('_sidebar') ?>
        <?php endif; ?>

        <!-- AREA HALAMAN KANAN -->
        <div class="layout-page">

            <!-- NAVBAR -->
            <?= $this->render('_navbar') ?>

            <!-- KONTEN UTAMA -->
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">

                    <!-- BREADCRUMBS (Disesuaikan untuk Bootstrap 5) -->
                    <?php if (empty($this->params['hideBreadcrumbs']) && !empty($this->params['breadcrumbs'])): ?>
                        <nav aria-label="breadcrumb">
                            <?= Breadcrumbs::widget([
                                'links' => $this->params['breadcrumbs'],
                                'options' => ['class' => 'breadcrumb'],
                                'itemTemplate' => "<li class=\"breadcrumb-item\">{link}</li>\n",
                                'activeItemTemplate' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>\n",
                            ]) ?>
                        </nav>
                    <?php endif; ?>

                    <!-- FLASH ALERT -->
                    <?= Alert::widget() ?>

                    <!-- ISI HALAMAN DINAMIS -->
                    <?= $content ?>

                </div>

                <!-- 3. FOOTER -->
                <?= $this->render('_footer') ?>

                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>

    <!-- Overlay untuk layar mobile -->
    
    <div class="layout-overlay layout-menu-toggle"></div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

