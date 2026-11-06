
<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Manajemen Akun';

// Sembunyikan seluruh breadcrumb halaman Manajemen Akun
$this->params['hideBreadcrumbs'] = true;

?>

<style>

/* =================================
   ACCOUNT PAGE
================================= */

.account-page {
    color: #344054;
}

/* HEADER */

.account-page-header {
    display: flex;
    align-items: center;
    background: #fff;
    border: 1px solid #e8edf3;
    border-left: 4px solid #337ab7;
    border-radius: 7px;
    padding: 22px 25px;
    margin-bottom: 24px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.account-header-icon {
    width: 48px;
    height: 48px;
    min-width: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eaf3fc;
    color: #337ab7;
    border-radius: 8px;
    font-size: 23px;
    margin-right: 16px;
}

.account-page-header h1 {
    color: #25364a;
    font-size: 23px;
    font-weight: 600;
    margin: 0 0 7px;
}

.account-page-header p {
    color: #667085;
    font-size: 13px;
    margin: 0;
}

/* ACTION BUTTON */

.account-page-actions {
    margin-bottom: 17px;
}

.account-page-actions .btn {
    padding: 10px 16px;
    border-radius: 5px;
    font-size: 13px;
    font-weight: 600;
}

/* TABLE CARD */

.account-table-card {
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 7px;
    padding: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

/* GRIDVIEW */

.account-table-card .summary {
    color: #667085;
    font-size: 13px;
    margin-bottom: 12px;
}

.account-table-card .table {
    width: 100%;
    margin-bottom: 0;
    border: 1px solid #e4e7ec;
}

.account-table-card .table thead th {
    background: #f5f8fc;
    color: #344054;
    font-size: 13px;
    font-weight: 600;
    padding: 13px 10px;
    border-bottom: 1px solid #e4e7ec;
    vertical-align: middle;
}

.account-table-card .table tbody td {
    color: #475467;
    font-size: 13px;
    padding: 13px 10px;
    vertical-align: middle;
}

.account-table-card .table tbody tr:hover {
    background: #f8fafc;
}

/* USERNAME */

.account-username {
    color: #337ab7;
    font-weight: 500;
}

/* ROLE BADGES */

.account-role {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 600;
}

.account-role-admin {
    color: #337ab7;
    background: #eaf3fc;
    border: 1px solid #d1e5f8;
}

.account-role-author {
    color: #218838;
    background: #e5f5e9;
    border: 1px solid #c8e6d0;
}

/* ACTION ICONS */

.account-action-buttons {
    display: flex;
    justify-content: center;
    gap: 7px;
}

.account-action-buttons .btn {
    width: 33px;
    height: 33px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    border-radius: 5px;
    font-size: 13px;
}

.account-btn-view {
    color: #337ab7;
    background: #eaf3fc;
    border: 1px solid #cfe3f8;
}

.account-btn-view:hover {
    color: #fff;
    background: #337ab7;
}

.account-btn-update {
    color: #b7791f;
    background: #fff7e8;
    border: 1px solid #f6dfb5;
}

.account-btn-update:hover {
    color: #fff;
    background: #f0ad4e;
}

.account-btn-delete {
    color: #d9534f;
    background: #fff0ef;
    border: 1px solid #f5cecb;
}

.account-btn-delete:hover {
    color: #fff;
    background: #d9534f;
}

/* PAGINATION */

.account-table-card .pagination {
    margin-bottom: 0;
}

/* RESPONSIVE */

@media (max-width: 767px) {

    .account-page-header {
        padding: 17px;
    }

    .account-page-header h1 {
        font-size: 20px;
    }

    .account-header-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        font-size: 20px;
        margin-right: 12px;
    }

    .account-table-card {
        padding: 12px;
        overflow-x: auto;
    }

    .account-table-card .table {
        min-width: 650px;
    }

}

</style>


<div class="account-page">

    <!-- PAGE HEADER -->

    <div class="account-page-header">

        <div class="account-header-icon">
            <span class="glyphicon glyphicon-user"></span>
        </div>

        <div>

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                Mengelola akun pengguna dan hak akses Administrator maupun Author.
            </p>

        </div>

    </div>


    <!-- ACTION BUTTON -->

    <div class="account-page-actions">

        <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> Buat Akun',
            ['create'],
            [
                'class' => 'btn btn-primary',
            ]
        ) ?>

    </div>


    <!-- ACCOUNT TABLE -->

    <div class="account-table-card">

        <?= GridView::widget([

            'dataProvider' => $dataProvider,

            'emptyText' => 'Belum ada akun pengguna.',

            'tableOptions' => [
                'class' => 'table table-bordered table-striped',
            ],

            'summary' => 'Menampilkan <strong>{begin}-{end}</strong> dari <strong>{totalCount}</strong> akun.',

            'summaryOptions' => [
                'class' => 'summary',
            ],

            'columns' => [

                // NOMOR

                [
                    'class' => 'yii\grid\SerialColumn',
                    'header' => 'No.',
                ],

                // USERNAME

                [
                    'attribute' => 'username',
                    'label' => 'Username',
                    'format' => 'raw',

                    'value' => function ($model) {

                        return Html::tag(
                            'span',
                            Html::encode($model->username),
                            ['class' => 'account-username']
                        );

                    },
                ],

                // NAMA LENGKAP

                [
                    'attribute' => 'name',
                    'label' => 'Nama Lengkap',

                    'value' => function ($model) {
                        return $model->name;
                    },
                ],

                // ROLE

                [
                    'attribute' => 'role',
                    'label' => 'Role',
                    'format' => 'raw',

                    'value' => function ($model) {

                        $role = strtolower($model->role);

                        $class = $role === 'admin'
                            ? 'account-role-admin'
                            : 'account-role-author';

                        return Html::tag(
                            'span',
                            Html::encode($model->role),
                            [
                                'class' => 'account-role ' . $class,
                            ]
                        );

                    },
                ],

                // ACTIONS

                [
                    'class' => 'yii\grid\ActionColumn',

                    'header' => 'Aksi',

                    'headerOptions' => [
                        'style' => 'width:150px; text-align:center;',
                    ],

                    'contentOptions' => [
                        'style' => 'text-align:center;',
                    ],

                    'template' => '<div class="account-action-buttons">{view} {update} {delete}</div>',

                    'buttons' => [

                        // VIEW

                        'view' => function ($url, $model) {

                            return Html::a(
                                '<span class="glyphicon glyphicon-eye-open"></span>',
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
                                '<span class="glyphicon glyphicon-pencil"></span>',
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
                                '<span class="glyphicon glyphicon-trash"></span>',
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
