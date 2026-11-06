
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */

?>

<style>

/* =================================
   ACCOUNT FORM CONTAINER
================================= */

.account-form-wrapper {
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 7px;
    padding: 25px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.account-form-title {
    color: #25364a;
    font-size: 16px;
    font-weight: 600;
    margin: 0 0 5px;
}

.account-form-description {
    color: #667085;
    font-size: 13px;
    margin-bottom: 22px;
}

.account-form-divider {
    border-top: 1px solid #edf0f4;
    margin: 0 0 22px;
}

/* =================================
   FORM GROUP
================================= */

.account-form .form-group {
    margin-bottom: 20px;
}

.account-form label {
    color: #344054;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 8px;
}

/* =================================
   INPUT
================================= */

.account-form .form-control {
    height: 42px;
    border: 1px solid #d0d5dd;
    border-radius: 5px;
    padding: 9px 12px;
    color: #344054;
    font-size: 13px;
    background: #fff;
    box-shadow: none;
    transition: all 0.2s ease;
}

.account-form .form-control:focus {
    border-color: #337ab7;
    box-shadow: 0 0 0 3px rgba(51,122,183,0.10);
}

.account-form .form-control:disabled {
    background: #f2f4f7;
    color: #667085;
    cursor: not-allowed;
}

/* =================================
   VALIDATION
================================= */

.account-form .help-block {
    font-size: 12px;
    margin-top: 5px;
}

.account-form .has-error .form-control {
    border-color: #d9534f;
}

.account-form .has-success .form-control {
    border-color: #d0d5dd;
}

/* =================================
   FORM ACTIONS
================================= */

.account-form-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    border-top: 1px solid #edf0f4;
    padding-top: 20px;
    margin-top: 25px;
}

.account-form-actions .btn {
    padding: 10px 17px;
    border-radius: 5px;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.account-form-actions .btn-primary {
    background: #337ab7;
    border-color: #337ab7;
}

.account-form-actions .btn-primary:hover {
    background: #286090;
    border-color: #204d74;
    transform: translateY(-1px);
}

.account-form-actions .btn-default {
    background: #fff;
    border-color: #d0d5dd;
    color: #475467;
}

.account-form-actions .btn-default:hover {
    background: #f5f7fa;
}

/* =================================
   RESPONSIVE
================================= */

@media (max-width: 767px) {

    .account-form-wrapper {
        padding: 17px;
    }

    .account-form-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .account-form-actions .btn {
        width: 100%;
    }

}

</style>


<div class="account-form-wrapper">

    <div class="account-form-title">
        Informasi Akun
    </div>

    <div class="account-form-description">
        Lengkapi informasi pengguna dan tentukan role akun.
    </div>

    <div class="account-form-divider"></div>


    <?php $form = ActiveForm::begin(); ?>


    <!-- USERNAME -->

    <?= $form->field($model, 'username')->textInput([
        'maxlength' => true,
        'disabled' => !$model->isNewRecord,
        'placeholder' => 'Masukkan username'
    ]) ?>


    <!-- PASSWORD -->

    <?= $form->field($model, 'password')->passwordInput([
        'maxlength' => true,
        'placeholder' => 'Masukkan password'
    ]) ?>


    <!-- NAME -->

    <?= $form->field($model, 'name')->textInput([
        'maxlength' => true,
        'placeholder' => 'Masukkan nama lengkap'
    ]) ?>


    <!-- ROLE -->

    <?= $form->field($model, 'role')->dropDownList(
        [
            'admin' => 'Admin',
            'author' => 'Author'
        ],
        [
            'prompt' => 'Pilih Role',
        ]
    ) ?>


    <!-- FORM ACTIONS -->

    <div class="account-form-actions">

        <?= Html::submitButton(
            '<span class="glyphicon glyphicon-floppy-disk"></span> Simpan Akun',
            [
                'class' => 'btn btn-primary'
            ]
        ) ?>

        <?= Html::a(
            'Kembali',
            ['index'],
            [
                'class' => 'btn btn-default'
            ]
        ) ?>

    </div>


    <?php ActiveForm::end(); ?>

</div>
