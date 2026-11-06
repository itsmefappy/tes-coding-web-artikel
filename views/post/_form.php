
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

<style>

/* =================================
   POST FORM
================================= */

.post-form-card {
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 7px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.post-form-section-title {
    color: #25364a;
    font-size: 16px;
    font-weight: 600;
    margin: 0 0 6px;
}

.post-form-section-description {
    color: #667085;
    font-size: 13px;
    margin-bottom: 20px;
}

.post-form-divider {
    border-top: 1px solid #edf0f4;
    margin-bottom: 22px;
}

.post-form-card .control-label {
    color: #344054;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 8px;
}

.post-form-card .form-control {
    min-height: 42px;
    border: 1px solid #d0d5dd;
    border-radius: 5px;
    box-shadow: none;
    color: #344054;
    font-size: 13px;
}

.post-form-card .form-control:focus {
    border-color: #337ab7;
    box-shadow: 0 0 0 2px rgba(51,122,183,0.10);
}

.post-form-card textarea.form-control {
    min-height: 110px;
}

.post-form-card .help-block {
    font-size: 12px;
    margin-top: 6px;
}

.post-form-card .has-error .form-control {
    border-color: #d9534f;
}

.post-form-card .btn {
    padding: 10px 17px;
    border-radius: 5px;
    font-size: 13px;
    font-weight: 600;
}

.post-form-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    border-top: 1px solid #edf0f4;
    padding-top: 20px;
    margin-top: 20px;
}

.post-form-note {
    background: #f0f6fc;
    border: 1px solid #d9e9f7;
    border-radius: 5px;
    padding: 13px 15px;
    color: #315b7d;
    font-size: 13px;
    line-height: 1.6;
    margin-bottom: 22px;
}

.post-form-rejection {
    background: #fff5f5;
    border: 1px solid #f5d0cd;
    border-left: 4px solid #d9534f;
    border-radius: 5px;
    padding: 13px 15px;
    margin-bottom: 20px;
    color: #7a271a;
    font-size: 13px;
    line-height: 1.6;
    white-space: pre-line;
    overflow-wrap: anywhere;
}

.post-form-status {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 5px;
    background: #f2f4f7;
    color: #475467;
    font-size: 12px;
    font-weight: 600;
}

.post-form-card .cke {
    max-width: 100%;
}

@media (max-width: 767px) {
    .post-form-card {
        padding: 16px;
    }

    .post-form-actions .btn {
        width: 100%;
    }
}

</style>


<div class="post-form-card">

    <div class="post-form-section-title">
        <?= $isNewRecord ? 'Informasi Artikel' : 'Edit Informasi Artikel' ?>
    </div>

    <div class="post-form-section-description">
        Lengkapi judul dan isi artikel dengan informasi yang jelas.
    </div>

    <div class="post-form-divider"></div>


    <?php if (!$isNewRecord): ?>

        <div class="post-form-note">
            <strong>Status Artikel:</strong>
            <span class="post-form-status">
                <?= Html::encode($statusLabel) ?>
            </span>
        </div>

    <?php endif; ?>


    <?php if (
        $model->status === Post::STATUS_REJECTED &&
        !empty($model->rejection_reason)
    ): ?>

        <div class="post-form-rejection">
            <strong>
                <span class="glyphicon glyphicon-exclamation-sign"></span>
                Alasan Penolakan
            </strong>

            <div>
                <?= Html::encode($model->rejection_reason) ?>
            </div>
        </div>

    <?php endif; ?>


    <div class="post-form-note">
        <span class="glyphicon glyphicon-info-sign"></span>

        <?= $isNewRecord
            ? 'Artikel baru akan disimpan dengan status Draft. Kamu dapat mengajukannya untuk review setelah selesai.'
            : 'Pastikan perubahan artikel sudah sesuai sebelum menyimpannya.'
        ?>
    </div>


    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'post-active-form',
        ],
    ]); ?>


    <?= $form->field($model, 'title')->textInput([
        'maxlength' => true,
        'placeholder' => 'Masukkan judul artikel...',
        'autocomplete' => 'off',
    ])->label('Judul Artikel') ?>


    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'preset' => 'full',
        'options' => [
            'rows' => 12,
        ],
        'clientOptions' => [
            'height' => 400,
        ],
    ])->label('Isi Artikel') ?>


    <div class="post-form-actions">

        <?= Html::submitButton(
            '<span class="glyphicon glyphicon-floppy-disk"></span> ' .
            ($isNewRecord ? 'Simpan Draft' : 'Simpan Perubahan'),
            [
                'class' => 'btn btn-primary',
            ]
        ) ?>


        <?= Html::a(
            '<span class="glyphicon glyphicon-arrow-left"></span> Kembali',
            ['index'],
            [
                'class' => 'btn btn-default',
            ]
        ) ?>

    </div>


    <?php ActiveForm::end(); ?>

</div>
