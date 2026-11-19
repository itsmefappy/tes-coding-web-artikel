<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */

if ($model->role) {
    $model->role = strtolower($model->role);
}
?>

<div class="account-form">
    <?php $form = ActiveForm::begin([
        'id' => 'account-form',
        'options' => ['class' => 'account-form'],
    ]); ?>

    <div class="row g-3">
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput([
                'maxlength' => true,
                'disabled' => !$model->isNewRecord,
                'placeholder' => 'Masukkan username'
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput([
                'maxlength' => true,
                'placeholder' => 'Masukkan nama lengkap'
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'role')->dropDownList(
                [
                    'admin' => 'Admin',
                    'author' => 'Author'
                ],
                [
                    'prompt' => 'Pilih Role',
                ]
            ) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'password')->passwordInput([
                'maxlength' => true,
                'placeholder' => 'Kosongkan jika tidak diubah',
                'required' => false,
            ]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
