<?php

use yii\helpers\Html;
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

$statusLabel = $model->getStatusLabel();

$statusClass = $model->getStatusBadgeClass();

?>

<div class="post-view">
    <!-- MAIN CARD -->

    <div class="card mb-4 post-action-card">
        <div class="card-header border-bottom">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                <h4 class="card-title mb-0">
                    <?= Html::encode($model->title) ?>
                </h4>
                <span class="<?= $statusClass ?>">
                    <?= Html::encode($statusLabel) ?>
                </span>
            </div>

            <div class="d-flex flex-wrap align-items-center gap-2 text-muted small">
                <span class="avatar avatar-xs">
                    <span class="avatar-initial rounded-circle bg-label-primary">
                        <?= strtoupper(substr($model->username, 0, 1)) ?>
                    </span>
                </span>
                <span class="fw-medium text-heading"><?= Html::encode($model->username) ?></span>
                <span class="text-body-secondary">&middot;</span>
                <span><?= Html::encode($model->date) ?></span>
            </div>
        </div>

        <div class="card-body py-3">
            <!-- ACTION BUTTONS -->
            <div class="d-flex flex-wrap align-items-center gap-2">
                <?php if ($canUpdate): ?>
                    <?= Html::a(
                        '<i class="bx bx-pencil me-1"></i> Edit Artikel',
                        ['update', 'id' => $model->idpost],
                        ['class' => 'btn btn-sm btn-outline-primary']
                    ) ?>
                <?php endif; ?>

                <?php if ($canSubmit): ?>
                    <?= Html::a(
                        '<i class="bx bx-check me-1"></i> Ajukan Review',
                        ['submit', 'id' => $model->idpost],
                        [
                            'class' => 'btn btn-sm btn-outline-warning',
                            'data-method' => 'post',
                            'data-confirm' => 'Yakin ingin mengajukan artikel ini untuk review?'
                        ]
                    ) ?>
                <?php endif; ?>

                <?php if ($canDelete): ?>
                    <?= Html::a(
                        '<i class="bx bx-trash me-1"></i> Hapus Artikel',
                        ['delete', 'id' => $model->idpost],
                        [
                            'class' => 'btn btn-sm btn-outline-danger',
                            'data-method' => 'post',
                            'data-confirm' => 'Yakin ingin menghapus artikel ini?'
                        ]
                    ) ?>
                <?php endif; ?>

                <?= Html::a(
                    '<i class="bx bx-arrow-back me-1"></i> Kembali',
                    ['index'],
                    ['class' => 'btn btn-sm btn-outline-secondary ms-auto']
                ) ?>
            </div>

            <!-- REJECTION INFORMATION -->
            <?php if ($model->status === Post::STATUS_REJECTED): ?>
                <div class="alert alert-danger d-flex align-items-center py-2 px-3 mt-3 mb-0" role="alert">
                    <i class="bx bx-error-circle me-2"></i>
                    <div class="small">
                        <strong>Artikel Ditolak:</strong>
                        <?= Html::encode($model->rejection_reason ?: 'Tidak ada alasan penolakan.') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ARTICLE CONTENT -->

    <div class="card mb-4">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">Isi Artikel</h5>
        </div>
        <div class="card-body">
            <div class="post-content">
                <?= nl2br(Html::encode($model->content)) ?>
            </div>
        </div>
    </div>

    <!-- ARTICLE INFORMATION -->

    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">Informasi Artikel</h5>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-sm-6">
                    <small class="d-block text-muted mb-1">Direview Oleh</small>
                    <span class="fw-medium text-heading">
                        <?= Html::encode($model->reviewed_by ?: '-') ?>
                    </span>
                </div>

                <div class="col-sm-6">
                    <small class="d-block text-muted mb-1">Waktu Review</small>
                    <span class="fw-medium text-heading">
                        <?= Html::encode($model->reviewed_at ?: '-') ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
