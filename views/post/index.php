
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Post;

$isAdmin = Yii::$app->user->can('Admin');
$isMine = Yii::$app->controller->action->id === 'mine';

$this->title = $isMine ? 'Artikel Saya' : 'Semua Artikel';

?>

<style>

/* =================================
   PAGE HEADER
================================= */

.post-page-header {
    background: #fff;
    border: 1px solid #e8edf3;
    border-left: 4px solid #337ab7;
    border-radius: 6px;
    padding: 22px 25px;
    margin-bottom: 25px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.post-page-header h1 {
    color: #25364a;
    font-size: 26px;
    font-weight: 600;
    margin: 0 0 8px;
}

.post-page-header p {
    color: #667085;
    margin: 0;
}

/* =================================
   PAGE ACTIONS
================================= */

.post-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
}

.post-actions .btn {
    margin: 0;
    padding: 9px 15px;
    font-weight: 500;
}

.post-actions .btn-active {
    background: #286090;
    border-color: #204d74;
    color: #fff;
}

/* =================================
   TABLE CONTAINER
================================= */

.post-table-wrapper {
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 6px;
    padding: 18px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.post-table-wrapper .summary {
    color: #667085;
    margin-bottom: 15px;
}

.post-table-wrapper .table {
    margin-bottom: 10px;
    background: #fff;
}

.post-table-wrapper .table > thead > tr > th {
    background: #f5f8fc;
    color: #344054;
    font-weight: 600;
    border-bottom: 1px solid #e4e7ec;
    white-space: nowrap;
}

.post-table-wrapper .table > tbody > tr > td {
    vertical-align: middle;
}

.post-table-wrapper .table > tbody > tr:hover {
    background: #f5f9ff;
}

/* =================================
   STATUS BADGES
================================= */

.post-status {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
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
   REJECTION REASON
   WARNA SAMA DENGAN STATUS DITOLAK
================================= */

.post-rejection-reason {
    display: inline-block;
    color: #b42318;
    background: #feeceb;
    border-radius: 4px;
    padding: 6px 10px;
    max-width: 250px;
    white-space: normal;
    word-break: break-word;
    line-height: 1.5;
    font-size: 11px;
    font-weight: 600;
}

.post-no-reason {
    color: #98a2b3;
    font-size: 12px;
}

/* =================================
   ACTION BUTTONS
================================= */

.post-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 30px;
    margin: 2px;
    border-radius: 4px;
    text-decoration: none !important;
    border: 1px solid transparent;
    transition: all 0.2s ease;
}

.post-action-view {
    color: #337ab7;
    background: #eaf3fb;
    border-color: #d7e8f7;
}

.post-action-view:hover {
    color: #fff;
    background: #337ab7;
}

.post-action-update {
    color: #9a6700;
    background: #fff5e6;
    border-color: #f5dfb8;
}

.post-action-update:hover {
    color: #fff;
    background: #d99025;
}

.post-action-delete {
    color: #b42318;
    background: #feeceb;
    border-color: #f5d0cd;
}

.post-action-delete:hover {
    color: #fff;
    background: #d9534f;
}

/* =================================
   PAGINATION
================================= */

.post-table-wrapper .pagination {
    margin-bottom: 5px;
}

.post-table-wrapper .pagination > li > a {
    color: #337ab7;
}

.post-table-wrapper .pagination > .active > a {
    background: #337ab7;
    border-color: #337ab7;
    color: #fff;
}

/* =================================
   RESPONSIVE
================================= */

@media (max-width: 767px) {

    .post-page-header {
        padding: 18px;
    }

    .post-page-header h1 {
        font-size: 22px;
    }

    .post-actions {
        gap: 7px;
    }

    .post-actions .btn {
        padding: 8px 11px;
        font-size: 12px;
    }

    .post-table-wrapper {
        padding: 10px;
    }

    .post-table-wrapper .table-responsive {
        border: none;
    }

    .post-rejection-reason {
        max-width: 200px;
    }

}

</style>


<div class="post-index">

    <!-- PAGE HEADER -->

    <div class="post-page-header">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php if (!$isAdmin && !$isMine): ?>

            <p>
                Menampilkan seluruh artikel yang sudah diterbitkan.
            </p>

        <?php elseif ($isMine): ?>

            <p>
                Menampilkan artikel yang dibuat oleh akun Anda.
            </p>

        <?php else: ?>

            <p>
                Menampilkan seluruh artikel dari semua penulis.
            </p>

        <?php endif; ?>

    </div>


    <!-- NAVIGATION ACTIONS -->

    <div class="post-actions">

        <?= Html::a(
            'Semua Artikel',
            ['index'],
            [
                'class' => 'btn ' .
                    (!$isMine ? 'btn-active' : 'btn-default')
            ]
        ) ?>

        <?= Html::a(
            'Artikel Saya',
            ['mine'],
            [
                'class' => 'btn ' .
                    ($isMine ? 'btn-active' : 'btn-default')
            ]
        ) ?>

        <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> Buat Artikel',
            ['create'],
            [
                'class' => 'btn btn-primary'
            ]
        ) ?>

        <?php if ($isAdmin): ?>

            <?= Html::a(
                '<span class="glyphicon glyphicon-time"></span> Pending Review',
                ['pending'],
                [
                    'class' => 'btn btn-warning'
                ]
            ) ?>

        <?php endif; ?>

    </div>


    <!-- ARTICLE TABLE -->

    <div class="post-table-wrapper">

        <div class="table-responsive">

            <?= GridView::widget([

                'dataProvider' => $dataProvider,

                'summary' => 'Menampilkan {begin}-{end} dari {totalCount} artikel.',

                'emptyText' => 'Belum ada artikel yang tersedia.',

                'emptyTextOptions' => [
                    'class' => 'text-center text-muted',
                ],

                'tableOptions' => [
                    'class' => 'table table-striped table-bordered'
                ],

                'columns' => [

                    // NOMOR

                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => 'No.',
                    ],

                    // JUDUL ARTIKEL

                    [
                        'attribute' => 'title',
                        'label' => 'Judul Artikel',
                        'format' => 'raw',

                        'value' => function ($model) {

                            return Html::a(
                                Html::encode($model->title),
                                ['view', 'id' => $model->idpost],
                                [
                                    'style' => 'font-weight:500;'
                                ]
                            );

                        },
                    ],

                    // PENULIS

                    [
                        'attribute' => 'username',
                        'label' => 'Penulis',
                    ],

                    // TANGGAL DIBUAT

                    [
                        'attribute' => 'date',
                        'label' => 'Tanggal Dibuat',
                    ],

                    // STATUS ARTIKEL

                    [
                        'label' => 'Status',
                        'format' => 'raw',

                        'value' => function ($model) {

                            $labels = [
                                Post::STATUS_DRAFT => 'Draft',
                                Post::STATUS_PENDING => 'Menunggu Review',
                                Post::STATUS_PUBLISHED => 'Published',
                                Post::STATUS_REJECTED => 'Ditolak',
                            ];

                            $classes = [
                                Post::STATUS_DRAFT => 'post-status-draft',
                                Post::STATUS_PENDING => 'post-status-pending',
                                Post::STATUS_PUBLISHED => 'post-status-published',
                                Post::STATUS_REJECTED => 'post-status-rejected',
                            ];

                            $status = $model->status;

                            return Html::tag(
                                'span',
                                isset($labels[$status])
                                    ? $labels[$status]
                                    : Html::encode($status),
                                [
                                    'class' => 'post-status ' .
                                        (isset($classes[$status])
                                            ? $classes[$status]
                                            : 'post-status-draft')
                                ]
                            );

                        },
                    ],

                    // ALASAN PENOLAKAN

                    [
                        'label' => 'Alasan Penolakan',
                        'format' => 'raw',

                        'value' => function ($model) {

                            if (
                                $model->status === Post::STATUS_REJECTED
                            ) {

                                if (!empty($model->rejection_reason)) {

                                    return Html::tag(
                                        'div',
                                        Html::encode($model->rejection_reason),
                                        [
                                            'class' => 'post-rejection-reason'
                                        ]
                                    );

                                }

                                return Html::tag(
                                    'span',
                                    'Alasan belum tersedia',
                                    [
                                        'class' => 'post-no-reason'
                                    ]
                                );
                            }

                            return Html::tag(
                                'span',
                                '-',
                                [
                                    'class' => 'post-no-reason'
                                ]
                            );

                        },
                    ],

                    // ACTION COLUMN

                    [
                        'class' => 'yii\grid\ActionColumn',

                        'header' => 'Aksi',

                        'template' => '{view} {update} {delete}',

                        'contentOptions' => [
                            'style' => 'white-space:nowrap; text-align:center;'
                        ],

                        'buttons' => [

                            // DETAIL

                            'view' => function ($url, $model) {

                                return Html::a(
                                    '<span class="glyphicon glyphicon-eye-open"></span>',
                                    $url,
                                    [
                                        'class' => 'post-action-btn post-action-view',
                                        'title' => 'Lihat Artikel',
                                        'aria-label' => 'Lihat Artikel',
                                        'data-pjax' => '0',
                                    ]
                                );

                            },

                            // UPDATE

                            'update' => function ($url, $model) use ($isAdmin) {

                                $isOwner =
                                    $model->username ===
                                    Yii::$app->user->identity->username;

                                $canUpdate = $isAdmin ||
                                    ($isOwner && in_array($model->status, [
                                        Post::STATUS_DRAFT,
                                        Post::STATUS_REJECTED
                                    ]));

                                if (!$canUpdate) {
                                    return '';
                                }

                                return Html::a(
                                    '<span class="glyphicon glyphicon-pencil"></span>',
                                    $url,
                                    [
                                        'class' => 'post-action-btn post-action-update',
                                        'title' => 'Edit Artikel',
                                        'aria-label' => 'Edit Artikel',
                                        'data-pjax' => '0',
                                    ]
                                );

                            },

                            // DELETE

                            'delete' => function ($url, $model) use ($isAdmin) {

                                $isOwner =
                                    $model->username ===
                                    Yii::$app->user->identity->username;

                                $canDelete = $isAdmin ||
                                    ($isOwner && in_array($model->status, [
                                        Post::STATUS_DRAFT,
                                        Post::STATUS_REJECTED
                                    ]));

                                if (!$canDelete) {
                                    return '';
                                }

                                return Html::a(
                                    '<span class="glyphicon glyphicon-trash"></span>',
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
