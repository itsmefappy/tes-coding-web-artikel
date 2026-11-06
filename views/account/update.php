
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

<style>

/* =================================
   ACCOUNT UPDATE HEADER
================================= */

.account-update-header {
    display: flex;
    align-items: center;
    gap: 15px;
    background: #fff;
    border: 1px solid #e8edf3;
    border-left: 4px solid #337ab7;
    border-radius: 7px;
    padding: 22px 25px;
    margin-bottom: 22px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.account-update-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    flex-shrink: 0;
    border-radius: 8px;
    background: #eaf3fb;
    color: #337ab7;
    font-size: 22px;
}

.account-update-header h1 {
    color: #25364a;
    font-size: 25px;
    font-weight: 600;
    margin: 0 0 6px;
}

.account-update-header p {
    color: #667085;
    font-size: 13px;
    margin: 0;
}

/* =================================
   RESPONSIVE
================================= */

@media (max-width: 767px) {

    .account-update-header {
        padding: 17px;
        gap: 12px;
    }

    .account-update-icon {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }

    .account-update-header h1 {
        font-size: 21px;
    }

    .account-update-header p {
        font-size: 12px;
    }

}

</style>


<div class="account-update">

    <!-- PAGE HEADER -->

    <div class="account-update-header">

        <div class="account-update-icon">
            <span class="glyphicon glyphicon-pencil"></span>
        </div>

        <div>
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                Perbarui informasi dan hak akses akun pengguna.
            </p>
        </div>

    </div>


    <!-- ACCOUNT FORM -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
