
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;

// Source - https://stackoverflow.com/a/49214799
// Posted by Muhammad Omer Aslam, modified by community. See post 'Timeline' for change history
// Retrieved 2026-11-17, License - CC BY-SA 3.0


$this->title = 'Login';

$this->registerCssFile('@web/sneat/vendor/css/pages/page-auth.css');

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="card px-sm-6 px-0">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="<?= Url::to(['/site/index']) ?>" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <?= Html::img('@web/images/logo.jpg', [
                        'alt' => 'Logo Blog',
                        'class' => 'login-brand-logo',
                    ]) ?>
                  </span>
                  <span class="app-brand-text demo text-heading fw-bolder fs-4">Blog</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-1">Selamat Datang di Blog 👋</h4>
              <p class="mb-6">Silahkan masuk dan jelajahi lebih luas di Blog ini</p>

            <?php $form = ActiveForm::begin([
                'id' => 'formAuthentication',
                'options' => ['class' => 'mb-3'],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'form-label'],
                    'inputOptions' => ['class' => 'form-control'],
                    'errorOptions' => ['class' => 'invalid-feedback d-block'],
                ],
            ]); ?>

                <div class="mb-3">
                    <?= $form->field($model, 'username')->textInput([
                        'autofocus' => true,
                        'placeholder' => 'Enter your email or username',
                    ])->label('Email atau Username') ?>
                </div>

                <div class="mb-3 form-password-toggle">
                    <?= $form->field($model, 'password', [
                        'template' => "{label}\n<div class=\"input-group input-group-merge\">{input}<span class=\"input-group-text cursor-pointer\"><i class=\"bx bx-hide\"></i></span></div>\n{error}",
                    ])->passwordInput([
                        'placeholder' => '············',
                    ]) ?>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <?= $form->field($model, 'rememberMe', [
                            'options' => ['class' => 'form-check mb-0'],
                            'template' => "{input} {label}\n{error}",
                        ])->checkbox([
                            'class' => 'form-check-input',
                            'labelOptions' => ['class' => 'form-check-label'],
                        ], false) ?>
                    </div>
                </div>

                <div class="mb-3">
                    <?= Html::submitButton('Login', [
                        'class' => 'btn btn-outline-primary d-grid w-100',
                        'name' => 'login-button',
                    ]) ?>
                </div>

            <?php ActiveForm::end(); ?>

              <p class="text-center">
                <span>Baru di platform kami?</span>
                <a href="auth-register-basic.html">
                  <span>Buat Akun</span>
                </a>
              </p>
            </div>
          </div>