
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';

$this->params['breadcrumbs'][] = $this->title;

?>

<style>

/* =================================
   LOGIN PAGE
================================= */

.login-page {
    max-width: 520px;
    margin: 35px auto 50px;
}

/* LOGIN CARD */

.login-card {
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 12px rgba(0,0,0,0.05);
}

/* HEADER */

.login-card-header {
    background: #337ab7;
    padding: 25px 30px;
    color: #fff;
}

.login-card-header h1 {
    font-size: 23px;
    font-weight: 600;
    margin: 0 0 7px;
}

.login-card-header p {
    font-size: 13px;
    color: rgba(255,255,255,0.85);
    margin: 0;
}

/* ICON */

.login-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,0.16);
    border-radius: 8px;
    font-size: 23px;
    margin-bottom: 15px;
}

/* FORM */

.login-card-body {
    padding: 30px;
}

.login-description {
    color: #667085;
    font-size: 13px;
    margin-bottom: 25px;
}

.login-card .form-group {
    margin-bottom: 20px;
}

.login-card label {
    color: #344054;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 8px;
}

.login-card .form-control {
    height: 42px;
    border: 1px solid #d0d5dd;
    border-radius: 5px;
    box-shadow: none;
    font-size: 13px;
    padding: 10px 12px;
}

.login-card .form-control:focus {
    border-color: #337ab7;
    box-shadow: 0 0 0 3px rgba(51,122,183,0.10);
}

/* REMEMBER ME */

.login-card .checkbox {
    margin-top: 5px;
    margin-bottom: 20px;
}

.login-card .checkbox label {
    font-weight: 400;
    color: #475467;
    font-size: 13px;
}

.login-card .checkbox input {
    margin-top: 2px;
}

/* LOGIN BUTTON */

.login-submit {
    width: 100%;
    height: 43px;
    background: #337ab7;
    border: 1px solid #337ab7;
    border-radius: 5px;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.login-submit:hover,
.login-submit:focus {
    background: #286090;
    border-color: #204d74;
    color: #fff;
}

/* FOOTER */

.login-card-footer {
    background: #f8fafc;
    border-top: 1px solid #e8edf3;
    padding: 15px 30px;
    text-align: center;
    color: #667085;
    font-size: 12px;
}

/* VALIDATION */

.login-card .help-block {
    font-size: 12px;
    margin-bottom: 0;
}

.login-card .has-error .form-control {
    border-color: #d9534f;
}

/* RESPONSIVE */

@media (max-width: 767px) {

    .login-page {
        margin: 20px 10px 35px;
    }

    .login-card-header {
        padding: 22px;
    }

    .login-card-body {
        padding: 22px;
    }

    .login-card-footer {
        padding: 14px 20px;
    }

}

</style>


<div class="login-page">

    <div class="login-card">

        <!-- HEADER -->

        <div class="login-card-header">

            <div class="login-icon">
                <span class="glyphicon glyphicon-lock"></span>
            </div>

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                Masuk untuk mengakses sistem manajemen artikel.
            </p>

        </div>


        <!-- FORM -->

        <div class="login-card-body">

            <div class="login-description">
                Silakan masukkan username dan password akun Anda.
            </div>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'default',
            ]); ?>


                <?= $form->field($model, 'username')->textInput([
                    'autofocus' => true,
                    'placeholder' => 'Masukkan username',
                    'autocomplete' => 'username',
                ])->label('Username') ?>


                <?= $form->field($model, 'password')->passwordInput([
                    'placeholder' => 'Masukkan password',
                    'autocomplete' => 'current-password',
                ])->label('Password') ?>


                <?= $form->field($model, 'rememberMe')->checkbox([
                    'label' => 'Ingat Saya',
                ]) ?>


                <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-log-in"></span> Login',
                    [
                        'class' => 'btn login-submit',
                        'name' => 'login-button',
                    ]
                ) ?>


            <?php ActiveForm::end(); ?>

        </div>


        <!-- FOOTER -->

        <div class="login-card-footer">

            <span class="glyphicon glyphicon-shield"></span>
            Sistem Manajemen Artikel

        </div>

    </div>

</div>
