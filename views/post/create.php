<?php

use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $model app\models\Post */

$this->title = 'Buat Artikel';

$this->params['breadcrumbs'][] = [
    'label' => 'Semua Artikel',
    'url' => ['index']
];

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="card mb-4">
    <div class="card-body">
        <h4 class="card-title mb-1"><?= Html::encode($this->title) ?></h4>
        <p class="text-muted mb-0">
            Tulis artikel baru dan simpan sebagai Draft sebelum diajukan untuk review.
        </p>
    </div>
</div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
