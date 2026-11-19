<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title = 'Edit Akun';
$this->params['breadcrumbs'][] = [
    'label' => 'Manajemen Akun',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = [
    'label' => $model->username,
    'url' => ['view', 'id' => $model->username]
];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="account-centered">
    <div class="account-card">
        <div class="account-card-header">
            <div class="account-card-title">Ubah Informasi Akun</div>
            <p class="account-card-subtitle">
                Updating user details will receive a privacy audit.
            </p>
        </div>

        <div class="account-card-body">
            <?= $this->render('_form', ['model' => $model, 'isModal' => true]) ?>
        </div>

        <div class="account-card-footer">
            <?= Html::a('Batal', ['index'], ['class' => 'btn btn-sneat-back']) ?>
            <button type="submit" form="account-form" class="btn btn-sneat-primary">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>
