
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Post;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;

$this->params['breadcrumbs'][] = [
    'label' => 'Semua Artikel',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

$isAdmin = Yii::$app->user->can('Admin');
$isAuthor = Yii::$app->user->can('Author');

$isOwner = !Yii::$app->user->isGuest &&
    $model->username === Yii::$app->user->identity->username;

// Admin dapat mengelola seluruh artikel.
// Author hanya dapat mengelola Draft dan Rejected miliknya.
$canUpdate = $isAdmin || (
    $isAuthor &&
    $isOwner &&
    in_array($model->status, [
        Post::STATUS_DRAFT,
        Post::STATUS_REJECTED
    ])
);

$canDelete = $isAdmin || (
    $isAuthor &&
    $isOwner &&
    in_array($model->status, [
        Post::STATUS_DRAFT,
        Post::STATUS_REJECTED
    ])
);

$canSubmit = (
    $isAdmin || $isAuthor
) && (
    $isAdmin || $isOwner
) && in_array($model->status, [
    Post::STATUS_DRAFT,
    Post::STATUS_REJECTED
]);

$statusLabels = [
    Post::STATUS_DRAFT => 'Draft',
    Post::STATUS_PENDING => 'Menunggu Review',
    Post::STATUS_PUBLISHED => 'Published',
    Post::STATUS_REJECTED => 'Ditolak',
];

$statusClasses = [
    Post::STATUS_DRAFT => 'post-status-draft',
    Post::STATUS_PENDING => 'post-status-pending',
    Post::STATUS_PUBLISHED => 'post-status-published',
    Post::STATUS_REJECTED => 'post-status-rejected',
];

$statusLabel = isset($statusLabels[$model->status])
    ? $statusLabels[$model->status]
    : $model->status;

$statusClass = isset($statusClasses[$model->status])
    ? $statusClasses[$model->status]
    : 'post-status-draft';

?>

<style>

/* =================================
   POST VIEW
================================= */

.post-view {
    color: #344054;
}

/* =================================
   PAGE HEADER
================================= */

.post-view-header {
    background: #fff;
    border: 1px solid #e8edf3;
    border-left: 4px solid #337ab7;
    border-radius: 7px;
    padding: 22px 25px;
    margin-bottom: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.post-view-header h1 {
    color: #25364a;
    font-size: 24px;
    font-weight: 600;
    line-height: 1.45;
    margin: 0 0 10px;
    overflow-wrap: anywhere;
}

.post-view-meta {
    color: #667085;
    font-size: 13px;
}

.post-view-meta span {
    margin-right: 18px;
}

/* =================================
   ACTION BUTTONS
================================= */

.post-view-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 9px;
    margin-bottom: 20px;
}

.post-view-actions .btn {
    padding: 9px 15px;
    border-radius: 5px;
    font-size: 13px;
    font-weight: 600;
}

/* =================================
   STATUS
================================= */

.post-status {
    display: inline-block;
    padding: 6px 11px;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 600;
}

.post-status-draft {
    color: #667085;
    background: #f2f4f7;
}

.post-status-pending {
    color: #9a6700;
    background: #fff3cd;
}

.post-status-published {
    color: #217a3c;
    background: #e5f5e9;
}

.post-status-rejected {
    color: #b42318;
    background: #feeceb;
}

/* =================================
   REJECTION ALERT
================================= */

.post-rejection-box {
    background: #fff5f5;
    border: 1px solid #f5d0cd;
    border-left: 4px solid #d9534f;
    border-radius: 6px;
    padding: 16px 18px;
    margin-bottom: 20px;
}

.post-rejection-box strong {
    display: block;
    color: #b42318;
    margin-bottom: 7px;
}

.post-rejection-box p {
    color: #7a271a;
    margin: 0;
    line-height: 1.6;
    white-space: pre-line;
    overflow-wrap: anywhere;
}

/* =================================
   CONTENT CARD
================================= */

.post-content-wrapper,
.post-information-wrapper {
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 7px;
    padding: 22px;
    margin-bottom: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.post-section-title {
    color: #25364a;
    font-size: 16px;
    font-weight: 600;
    margin: 0 0 5px;
}

.post-section-description {
    color: #667085;
    font-size: 13px;
    margin-bottom: 18px;
}

.post-section-divider {
    border-top: 1px solid #edf0f4;
    margin-bottom: 20px;
}

/* =================================
   ARTICLE CONTENT
================================= */

.post-content {
    color: #344054;
    font-size: 14px;
    line-height: 1.85;
    overflow-wrap: anywhere;
    word-break: break-word;
}

.post-content img {
    max-width: 100%;
    height: auto;
}

.post-content table {
    max-width: 100%;
}

.post-content pre {
    max-width: 100%;
    overflow-x: auto;
}

.post-content blockquote {
    border-left: 4px solid #337ab7;
    padding-left: 15px;
    color: #667085;
}

/* =================================
   INFORMATION TABLE
================================= */

.post-information-wrapper .table {
    margin-bottom: 0;
    border: 1px solid #e4e7ec;
}

.post-information-wrapper .table th {
    width: 25%;
    background: #f5f8fc;
    color: #344054;
    font-size: 13px;
    font-weight: 600;
    padding: 13px;
    vertical-align: middle;
}

.post-information-wrapper .table td {
    color: #475467;
    font-size: 13px;
    padding: 13px;
    vertical-align: middle;
    overflow-wrap: anywhere;
}

/* =================================
   RESPONSIVE
================================= */

@media (max-width: 767px) {

    .post-view-header {
        padding: 17px;
    }

    .post-view-header h1 {
        font-size: 20px;
    }

    .post-view-meta span {
        display: block;
        margin: 5px 0;
    }

    .post-view-actions {
        gap: 7px;
    }

    .post-view-actions .btn {
        padding: 8px 11px;
        font-size: 12px;
    }

    .post-content-wrapper,
    .post-information-wrapper {
        padding: 14px;
    }

    .post-information-wrapper .table th {
        width: 35%;
    }

    .post-information-wrapper .table th,
    .post-information-wrapper .table td {
        padding: 10px;
        font-size: 12px;
    }

}

</style>


<div class="post-view">

    <!-- PAGE HEADER -->

    <div class="post-view-header">

        <h1><?= Html::encode($model->title) ?></h1>

        <div class="post-view-meta">

            <span>
                <span class="glyphicon glyphicon-user"></span>
                <?= Html::encode($model->username) ?>
            </span>

            <span>
                <span class="glyphicon glyphicon-calendar"></span>
                <?= Html::encode($model->date) ?>
            </span>

            <span class="post-status <?= $statusClass ?>">
                <?= Html::encode($statusLabel) ?>
            </span>

        </div>

    </div>


    <!-- ACTION BUTTONS -->

    <div class="post-view-actions">

        <?php if ($canUpdate): ?>

            <?= Html::a(
                '<span class="glyphicon glyphicon-pencil"></span> Edit Artikel',
                ['update', 'id' => $model->idpost],
                ['class' => 'btn btn-primary']
            ) ?>

        <?php endif; ?>


        <?php if ($canDelete): ?>

            <?= Html::a(
                '<span class="glyphicon glyphicon-trash"></span> Hapus Artikel',
                ['delete', 'id' => $model->idpost],
                [
                    'class' => 'btn btn-danger',
                    'data-method' => 'post',
                    'data-confirm' => 'Yakin ingin menghapus artikel ini?'
                ]
            ) ?>

        <?php endif; ?>


        <?php if ($canSubmit): ?>

            <?= Html::a(
                '<span class="glyphicon glyphicon-send"></span> Ajukan Review',
                ['submit', 'id' => $model->idpost],
                [
                    'class' => 'btn btn-success',
                    'data-method' => 'post',
                    'data-confirm' => 'Yakin ingin mengajukan artikel ini untuk review?'
                ]
            ) ?>

        <?php endif; ?>


        <?= Html::a(
            '<span class="glyphicon glyphicon-arrow-left"></span> Kembali',
            ['index'],
            ['class' => 'btn btn-default']
        ) ?>

    </div>


    <!-- REJECTION INFORMATION -->

    <?php if ($model->status === Post::STATUS_REJECTED): ?>

        <div class="post-rejection-box">

            <strong>
                <span class="glyphicon glyphicon-exclamation-sign"></span>
                Artikel Ditolak
            </strong>

            <p><?= Html::encode($model->rejection_reason ?: 'Tidak ada alasan penolakan.') ?></p>

        </div>

    <?php endif; ?>


    <!-- ARTICLE CONTENT -->

    <div class="post-content-wrapper">

        <div class="post-section-title">
            Isi Artikel
        </div>

        <div class="post-section-description">
            Konten lengkap artikel.
        </div>

        <div class="post-section-divider"></div>

        <div class="post-content">
            <?= $model->content ?>
        </div>

    </div>


    <!-- ARTICLE INFORMATION -->

    <div class="post-information-wrapper">

        <div class="post-section-title">
            Informasi Artikel
        </div>

        <div class="post-section-description">
            Informasi penulis dan riwayat review artikel.
        </div>

        <div class="post-section-divider"></div>

        <?= DetailView::widget([

            'model' => $model,

            'options' => [
                'class' => 'table table-bordered table-striped detail-view',
            ],

            'attributes' => [

                [
                    'attribute' => 'title',
                    'label' => 'Judul Artikel',
                ],

                [
                    'attribute' => 'username',
                    'label' => 'Penulis',
                ],

                [
                    'attribute' => 'date',
                    'label' => 'Tanggal Dibuat',
                ],

                [
                    'label' => 'Status Artikel',
                    'format' => 'raw',
                    'value' => Html::tag(
                        'span',
                        Html::encode($statusLabel),
                        ['class' => 'post-status ' . $statusClass]
                    ),
                ],

                [
                    'label' => 'Direview Oleh',
                    'value' => $model->reviewed_by ?: '-',
                ],

                [
                    'label' => 'Waktu Review',
                    'value' => $model->reviewed_at ?: '-',
                ],

            ],

        ]) ?>

    </div>

</div>
