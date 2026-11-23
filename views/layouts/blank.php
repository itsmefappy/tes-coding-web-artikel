<?php
use app\assets\SneatAsset;
use yii\helpers\Html;

SneatAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="light-style customizer-hide" data-theme="theme-default">
<head>
    <script>
    (function () {
        var theme = localStorage.getItem('theme') || 'light';
        document.documentElement.classList.toggle('dark-style', theme === 'dark');
        document.documentElement.classList.toggle('light-style', theme !== 'dark');
    })();
    </script>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <?= $content ?>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>