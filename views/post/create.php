<<<<<<< HEAD

=======
>>>>>>> main
<?php

use yii\helpers\Html;

<<<<<<< HEAD
/* @var $this yii\web\View */
/* @var $model app\models\Post */
=======
/** @var $this yii\web\View */
/** @var $model app\models\Post */
>>>>>>> main

$this->title = 'Buat Artikel';

$this->params['breadcrumbs'][] = [
    'label' => 'Semua Artikel',
    'url' => ['index']
];

$this->params['breadcrumbs'][] = $this->title;

?>

<<<<<<< HEAD
<style>
.post-create-header {
    background: #fff;
    border: 1px solid #e8edf3;
    border-left: 4px solid #337ab7;
    border-radius: 7px;
    padding: 22px 25px;
    margin-bottom: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.post-create-header h1 {
    color: #25364a;
    font-size: 23px;
    font-weight: 600;
    margin: 0 0 8px;
}

.post-create-header p {
    color: #667085;
    font-size: 13px;
    margin: 0;
}

@media (max-width: 767px) {
    .post-create-header {
        padding: 17px;
    }

    .post-create-header h1 {
        font-size: 20px;
    }
}
</style>

<div class="post-create">

    <div class="post-create-header">
        <h1>
            <span class="glyphicon glyphicon-edit"></span>
            <?= Html::encode($this->title) ?>
        </h1>

        <p>
            Tulis artikel baru dan simpan sebagai Draft sebelum diajukan untuk review.
        </p>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
=======
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
>>>>>>> main
