<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Post;

$isAdmin = Yii::$app->user->can('Admin');
$isMine = Yii::$app->controller->action->id === 'mine';

$this->title = $isMine ? 'Artikel Saya' : 'Semua Artikel';
$this->params['hideBreadcrumbs'] = true;

?>



<div class="post-index">
    <!-- PAGE HEADER -->
    <div class="card page-header-card mb-4">
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h4 class="mb-1 text-heading">
                        <?= Html::encode($this->title) ?>
                    </h4>
                    <p class="text-muted mb-0">
                        <?php if (!$isAdmin && !$isMine): ?>
                            Menampilkan seluruh artikel yang sudah diterbitkan.
                        <?php elseif ($isMine): ?>
                            Menampilkan artikel yang dibuat oleh akun Anda.
                        <?php else: ?>
                            Menampilkan seluruh artikel dari semua penulis.
                        <?php endif; ?>
                    </p>
                </div>

                <div class="d-flex flex-wrap align-items-center gap-2 mt-2 md:mt-0">
                    <?= Html::a(
                        'Semua Artikel',
                        ['index'],
                        [
                            'class' => 'btn btn-sm ' . ($isMine ? 'btn-outline-primary' : 'btn-primary')
                        ]
                    ) ?>

                    <?= Html::a(
                        'Artikel Saya',
                        ['mine'],
                        [
                            'class' => 'btn btn-sm ' . (!$isMine ? 'btn-outline-primary' : 'btn-primary')
                        ]
                    ) ?>

                    <?= Html::a(
                        '<i class="bx bx-plus me-1"></i> Buat Artikel',
                        ['create'],
                        [
                            'class' => 'btn btn-sm btn-outline-primary'
                        ]
                    ) ?>

                    <?php if ($isAdmin): ?>
                        <?= Html::a(
                            '<i class="bx bx-time-five me-1"></i> Menunggu Review',
                            ['pending'],
                            [
                                'class' => 'btn btn-sm btn-outline-warning'
                            ]
                        ) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ARTICLE TABLE -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => 'Menampilkan <strong>{begin}-{end}</strong> dari <strong>{totalCount}</strong> artikel.',
                    'emptyText' => 'Belum ada artikel yang tersedia.',
                    'emptyTextOptions' => [
                        'class' => 'text-center text-muted',
                    ],
                    'tableOptions' => [
                        'class' => 'table table-hover align-middle mb-0'
                    ],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'No.',
                        ],
                        [
                            'label' => 'Judul Artikel',
                            'value' => function ($model) {
                                return $model->title;
                            },
                        ],
                        [
                            'label' => 'Penulis',
                            'value' => function ($model) {
                                return Html::encode($model->username);
                            },
                        ],
                        [
                            'label' => 'Tanggal Dibuat',
                            'value' => function ($model) {
                                return Html::encode($model->date);
                            },
                        ],
                        [
                            'label' => 'Status',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::tag(
                                    'span',
                                    Html::encode($model->getStatusLabel()),
                                    ['class' => $model->getStatusBadgeClass()]
                                );
                            },
                        ],
                        [
                            'label' => 'Alasan Penolakan',
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'width: 25%;'],
                            'contentOptions' => ['class' => 'post-rejection-cell'],
                            'value' => function ($model) {
                                if ($model->status !== Post::STATUS_REJECTED) {
                                    return '<span class="text-muted">-</span>';
                                }

                                if (!empty($model->rejection_reason)) {
                                    return Html::tag(
                                        'span',
                                        '<i class="bx bx-info-circle"></i> ' . Html::encode($model->rejection_reason),
                                        [
                                            'class' => 'post-rejection-reason text-danger',
                                            'title' => Html::encode($model->rejection_reason),
                                        ]
                                    );
                                }

                                return Html::tag(
                                    'span',
                                    '<i class="bx bx-help-circle"></i> Alasan belum tersedia',
                                    [
                                        'class' => 'post-rejection-reason post-no-reason',
                                    ]
                                );
                            },
                        ],
                        [
                            'class' => 'yii\\grid\\ActionColumn',
                            'header' => 'Aksi',
                            'template' => '<div class="account-action-buttons">{view} {update} {delete}</div>',
                            'contentOptions' => [
                                'style' => 'white-space:nowrap; text-align:center;'
                            ],
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a(
                                        '<i class="bx bx-show"></i>',
                                        $url,
                                        [
                                            'class' => 'post-action-btn post-action-view',
                                            'title' => 'Lihat Artikel',
                                            'aria-label' => 'Lihat Artikel',
                                            'data-pjax' => '0',
                                        ]
                                    );
                                },
                                'update' => function ($url, $model) use ($isAdmin) {
                                    $isOwner = $model->username === Yii::$app->user->identity->username;
                                    $canUpdate = $isAdmin || ($isOwner && in_array($model->status, [
                                        Post::STATUS_DRAFT,
                                        Post::STATUS_REJECTED
                                    ]));

                                    if (!$canUpdate) {
                                        return '';
                                    }

                                    return Html::a(
                                        '<i class="bx bx-pencil"></i>',
                                        $url,
                                        [
                                            'class' => 'post-action-btn post-action-update',
                                            'title' => 'Edit Artikel',
                                            'aria-label' => 'Edit Artikel',
                                            'data-pjax' => '0',
                                        ]
                                    );
                                },
                                'delete' => function ($url, $model) use ($isAdmin) {
                                    $isOwner = $model->username === Yii::$app->user->identity->username;
                                    $canDelete = $isAdmin || ($isOwner && in_array($model->status, [
                                        Post::STATUS_DRAFT,
                                        Post::STATUS_REJECTED
                                    ]));

                                    if (!$canDelete) {
                                        return '';
                                    }

                                    return Html::a(
                                        '<i class="bx bx-trash"></i>',
                                        $url,
                                        [
                                            'class' => 'post-action-btn post-action-delete',
                                            'title' => 'Hapus Artikel',
                                            'aria-label' => 'Hapus Artikel',
                                            'data-method' => 'post',
                                            'data-confirm' => 'Yakin ingin menghapus artikel ini?',
                                            'data-pjax' => '0',
                                        ]
                                    );
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
