<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title mb-1">
                <i class="bx bx-envelope me-2 text-primary"></i>
                <?= Html::encode($this->title) ?>
            </h4>
            <p class="text-muted mb-3">
                If you have business inquiries or other questions, please fill out the following form to contact us.
                Thank you.
            </p>

            <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
                <div class="alert alert-success" role="alert">
                    Thank you for contacting us. We will respond to you as soon as possible.
                </div>
                <p>
                    Note that if you turn on the Yii debugger, you should be able to view the mail message on the mail panel of the debugger.
                    To enable email sending, configure the <code>useFileTransport</code> property of the <code>mail</code> application component to be false.
                </p>
            <?php else: ?>
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'email') ?>
                    </div>
                </div>
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="form-group text-center mt-4">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-outline-primary btn-lg px-5']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
