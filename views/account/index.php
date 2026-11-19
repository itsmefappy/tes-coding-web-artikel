<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Manajemen Akun';

// Sembunyikan seluruh breadcrumb halaman Manajemen Akun
$this->params['hideBreadcrumbs'] = true;

?>

<div class="account-page">
    <!-- PAGE HEADER -->

    <div class="card page-header-card mb-4">
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h4 class="mb-1 text-heading">
                        <?= Html::encode($this->title) ?>
                    </h4>
                    <p class="text-muted mb-0">
                        Mengelola akun pengguna dan hak akses Administrator maupun Author.
                    </p>
                </div>

                <div class="mt-2 md:mt-0">
                    <?= Html::a(
                        '<i class="bx bx-plus me-1"></i> Buat Akun',
                        ['create'],
                        ['class' => 'btn btn-sm btn-sneat-primary']
                    ) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ACCOUNT TABLE -->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,

                    'emptyText' => 'Belum ada akun pengguna.',

                    'tableOptions' => [
                        'class' => 'table table-hover align-middle',
                    ],

                    'summary' => 'Menampilkan <strong>{begin}-{end}</strong> dari <strong>{totalCount}</strong> akun.',

                    'summaryOptions' => [
                        'class' => 'summary',
                    ],

                    'columns' => [

                        // NOMOR

                        [
                            'class' => 'yii\\grid\\SerialColumn',
                            'header' => 'No.',
                        ],

                        // USERNAME

                        [
                            'label' => 'Username',
                            'value' => function ($model) {
                                return $model->username;
                            },
                        ],

                        // NAMA

                        [
                            'label' => 'Nama',
                            'value' => function ($model) {
                                return Html::encode($model->name);
                            },
                        ],

                        // ROLE

                        [
                            'label' => 'Role',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $role = strtolower((string) $model->role);
                                $label = $role === 'admin' ? 'Admin' : 'Author';
                                $class = $role === 'admin' ? 'account-role-admin' : 'account-role-author';

                                return Html::tag(
                                    'span',
                                    $label,
                                    ['class' => 'badge account-role ' . $class]
                                );
                            },
                        ],

                        // ACTION COLUMN

                        [
                            'class' => 'yii\\grid\\ActionColumn',

                            'header' => 'Aksi',

                            'template' => '<div class="account-action-buttons">{view} {update} {delete}</div>',

                            'contentOptions' => [
                                'style' => 'width: 150px; text-align: center; white-space: nowrap;',
                            ],

                            'buttons' => [

                                // VIEW

                                'view' => function ($url, $model) {

                                    return Html::a(
                                        '<i class="bx bx-show"></i>',
                                        $url,
                                        [
                                            'class' => 'btn account-btn-view',
                                            'title' => 'Lihat Akun',
                                            'aria-label' => 'Lihat Akun',
                                            'data-pjax' => '0',
                                        ]
                                    );

                                },

                                // UPDATE

                                'update' => function ($url, $model) {

                                    return Html::a(
                                        '<i class="bx bx-pencil"></i>',
                                        $url,
                                        [
                                            'class' => 'btn account-btn-update',
                                            'title' => 'Edit Akun',
                                            'aria-label' => 'Edit Akun',
                                            'data-pjax' => '0',
                                        ]
                                    );

                                },

                                // DELETE

                                'delete' => function ($url, $model) {

                                    return Html::a(
                                        '<i class="bx bx-trash"></i>',
                                        $url,
                                        [
                                            'class' => 'btn account-btn-delete',
                                            'title' => 'Hapus Akun',
                                            'aria-label' => 'Hapus Akun',
                                            'data-confirm' => 'Apakah Anda yakin ingin menghapus akun ini?',
                                            'data-method' => 'post',
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
