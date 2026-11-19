<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use app\models\Post;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */

$isNewRecord = $model->isNewRecord;

$statusLabels = [
    Post::STATUS_DRAFT => 'Draft',
    Post::STATUS_PENDING => 'Menunggu Review',
    Post::STATUS_PUBLISHED => 'Published',
    Post::STATUS_REJECTED => 'Ditolak',
];

$statusLabel = isset($statusLabels[$model->status])
    ? $statusLabels[$model->status]
    : 'Draft';

?>

<div class="card">
    <div class="card-body">

        <h5 class="card-title mb-1">
            <?= $isNewRecord ? 'Informasi Artikel' : 'Edit Informasi Artikel' ?>
        </h5>

        <p class="text-muted mb-3">
            Lengkapi judul dan isi artikel dengan informasi yang jelas.
        </p>

        <div class="border-bottom mb-4"></div>

        <?php if (!$isNewRecord): ?>
            <div class="alert alert-primary mb-3">
                <strong>Status Artikel:</strong>
                <span class="badge bg-label-primary ms-1">
                    <?= Html::encode($statusLabel) ?>
                </span>
            </div>
        <?php endif; ?>

        <?php if (
            $model->status === Post::STATUS_REJECTED &&
            !empty($model->rejection_reason)
        ): ?>
            <div class="alert alert-danger mb-3">
                <strong>
                    <i class="bx bx-error me-1"></i>
                    Alasan Penolakan
                </strong>
                <div class="mt-1">
                    <?= Html::encode($model->rejection_reason) ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="alert alert-info mb-4">
            <i class="bx bx-info-circle me-1"></i>
            <?= $isNewRecord
                ? 'Artikel baru akan disimpan dengan status Draft. Kamu dapat mengajukannya untuk review setelah selesai.'
                : 'Pastikan perubahan artikel sudah sesuai sebelum menyimpannya.'
            ?>
        </div>

        <?php $form = ActiveForm::begin([
            'options' => [
                'class' => 'post-active-form',
            ],
            'fieldConfig' => [
                'labelOptions' => ['class' => 'form-label fw-semibold'],
                'inputOptions' => ['class' => 'form-control'],
                'errorOptions' => ['class' => 'invalid-feedback d-block'],
            ],
        ]); ?>

        <div class="mb-3">
            <?= $form->field($model, 'title')->textInput([
                'maxlength' => true,
                'placeholder' => 'Masukkan judul artikel...',
                'autocomplete' => 'off',
            ])->label('Judul Artikel') ?>
        </div>

        <div class="mb-3">
            <?= $form->field($model, 'content')->widget(CKEditor::className(), [
                'preset' => 'full',
                'options' => [
                    'rows' => 12,
                ],
                'clientOptions' => [
                    'height' => 400,
                ],
            ])->label('Isi Artikel') ?>
        </div>

        <div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top">
            <?= Html::submitButton(
                '<i class="bx bx-save me-1"></i> ' .
                ($isNewRecord ? 'Simpan Draft' : 'Simpan Perubahan'),
                [
                    'class' => 'btn btn-outline-primary',
                ]
            ) ?>

            <?= Html::a(
                '<i class="bx bx-arrow-back me-1"></i> Kembali',
                ['index'],
                [
                    'class' => 'btn btn-outline-secondary',
                ]
            ) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
