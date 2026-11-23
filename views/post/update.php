
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = 'Edit Artikel';

$this->params['breadcrumbs'][] = [
    'label' => 'Semua Artikel',
    'url' => ['index']
];

$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url' => ['view', 'id' => $model->idpost]
];

$this->params['breadcrumbs'][] = $this->title;

?>




<div class="post-update">

    <div class="post-update-header">

        <h1>
            <i class="bx bx-pencil me-2"></i>
            <?= Html::encode($this->title) ?>
        </h1>

        <p>
            Perbarui judul atau isi artikel. Pastikan perubahan sudah sesuai sebelum menyimpan.
        </p>

    </div>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
