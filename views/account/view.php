<<<<<<< HEAD

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
=======
<?php

use yii\helpers\Html;
>>>>>>> main

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title = $model->name;
$this->params['breadcrumbs'][] = [
    'label' => 'Manajemen Akun',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

<<<<<<< HEAD
?>

<style>

/* =================================
   ACCOUNT VIEW
================================= */

.account-view {
    color: #344054;
}

/* =================================
   PAGE HEADER
================================= */

.account-view-header {
    display: flex;
    align-items: center;
    gap: 15px;
    background: #fff;
    border: 1px solid #e8edf3;
    border-left: 4px solid #337ab7;
    border-radius: 7px;
    padding: 22px 25px;
    margin-bottom: 22px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.account-view-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    flex-shrink: 0;
    border-radius: 8px;
    background: #eaf3fb;
    color: #337ab7;
    font-size: 22px;
}

.account-view-header h1 {
    color: #25364a;
    font-size: 25px;
    font-weight: 600;
    margin: 0 0 6px;
}

.account-view-header p {
    color: #667085;
    font-size: 13px;
    margin: 0;
}

/* =================================
   ACTION BUTTONS
================================= */

.account-view-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 9px;
    margin-bottom: 20px;
}

.account-view-actions .btn {
    padding: 9px 15px;
    border-radius: 5px;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.account-view-actions .btn:hover {
    transform: translateY(-1px);
}

.account-view-actions .btn-primary {
    background: #337ab7;
    border-color: #337ab7;
}

.account-view-actions .btn-primary:hover {
    background: #286090;
    border-color: #204d74;
}

.account-view-actions .btn-danger {
    background: #fff;
    color: #b42318;
    border-color: #f0c9c6;
}

.account-view-actions .btn-danger:hover {
    background: #d9534f;
    border-color: #d9534f;
    color: #fff;
}

.account-view-actions .btn-default {
    background: #fff;
    color: #475467;
    border-color: #d0d5dd;
}

.account-view-actions .btn-default:hover {
    background: #f5f7fa;
}

/* =================================
   DETAIL CONTAINER
================================= */

.account-detail-wrapper {
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 7px;
    padding: 22px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.account-detail-title {
    color: #25364a;
    font-size: 16px;
    font-weight: 600;
    margin: 0 0 5px;
}

.account-detail-description {
    color: #667085;
    font-size: 13px;
    margin-bottom: 20px;
}

.account-detail-divider {
    border-top: 1px solid #edf0f4;
    margin-bottom: 20px;
}

/* =================================
   DETAIL VIEW TABLE
================================= */

.account-detail-wrapper .table {
    margin-bottom: 0;
    border: 1px solid #e4e7ec;
}

.account-detail-wrapper .table th {
    width: 25%;
    background: #f5f8fc;
    color: #344054;
    font-size: 13px;
    font-weight: 600;
    padding: 14px;
    vertical-align: middle;
}

.account-detail-wrapper .table td {
    color: #475467;
    font-size: 13px;
    padding: 14px;
    vertical-align: middle;
}

/* =================================
   ROLE BADGES
================================= */

.account-role {
    display: inline-block;
    padding: 6px 11px;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 600;
}

.account-role-admin {
    color: #337ab7;
    background: #eaf3fb;
    border: 1px solid #d7e8f7;
}

.account-role-author {
    color: #217a3c;
    background: #e5f5e9;
    border: 1px solid #ccebd4;
}

/* =================================
   RESPONSIVE
================================= */

@media (max-width: 767px) {

    .account-view-header {
        padding: 17px;
        gap: 12px;
    }

    .account-view-icon {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }

    .account-view-header h1 {
        font-size: 21px;
    }

    .account-view-header p {
        font-size: 12px;
    }

    .account-detail-wrapper {
        padding: 13px;
    }

    .account-detail-wrapper .table th {
        width: 35%;
    }

    .account-detail-wrapper .table th,
    .account-detail-wrapper .table td {
        padding: 10px;
        font-size: 12px;
    }

}

</style>


<div class="account-view">

    <!-- PAGE HEADER -->

    <div class="account-view-header">

        <div class="account-view-icon">
            <span class="glyphicon glyphicon-user"></span>
        </div>

        <div>
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                Informasi detail akun dan hak akses pengguna.
            </p>
        </div>

    </div>


    <!-- ACTION BUTTONS -->

    <div class="account-view-actions">

        <?= Html::a(
            '<span class="glyphicon glyphicon-pencil"></span> Edit Akun',
            ['update', 'id' => $model->username],
            [
                'class' => 'btn btn-primary'
            ]
        ) ?>

        <?= Html::a(
            '<span class="glyphicon glyphicon-trash"></span> Hapus Akun',
            ['delete', 'id' => $model->username],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Yakin ingin menghapus akun ini?',
                    'method' => 'post',
                ],
            ]
        ) ?>

        <?= Html::a(
            '<span class="glyphicon glyphicon-arrow-left"></span> Kembali',
            ['index'],
            [
                'class' => 'btn btn-default'
            ]
        ) ?>

    </div>


    <!-- ACCOUNT DETAILS -->

    <div class="account-detail-wrapper">

        <div class="account-detail-title">
            Informasi Akun
        </div>

        <div class="account-detail-description">
            Berikut adalah informasi pengguna yang tersimpan dalam sistem.
        </div>

        <div class="account-detail-divider"></div>


        <?= DetailView::widget([

            'model' => $model,

            'options' => [
                'class' => 'table table-bordered table-striped detail-view',
            ],

            'attributes' => [

                [
                    'attribute' => 'username',
                    'label' => 'Username',
                ],

                [
                    'attribute' => 'name',
                    'label' => 'Nama Lengkap',
                ],

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
                                'class' => 'account-role ' . $class
                            ]
                        );

                    },
                ],

            ],

        ]) ?>

    </div>

=======
$roleLower = strtolower($model->role);
$isAdmin = ($roleLower === 'admin');
$postCount = $model->getPosts()->count();
$initials = strtoupper(mb_substr($model->name ?: $model->username, 0, 1));
?>



<div class="user-profile-wrapper">
    <div class="user-profile-card">
        <div class="user-profile-body">
            <!-- AVATAR -->
            <div class="user-avatar-box <?= $isAdmin ? '' : 'user-avatar-author' ?>">
                <?= Html::encode($initials) ?>
            </div>

            <!-- NAME & ROLE -->
            <div class="user-profile-name">
                <?= Html::encode($model->name) ?>
            </div>

            <div class="mb-3">
                <span class="user-badge-role <?= $isAdmin ? 'badge-role-admin' : 'badge-role-author' ?>">
                    <?= Html::encode(ucfirst($model->role)) ?>
                </span>
            </div>

            <!-- STAT COUNTER (Task Done & Post Published) -->
            <div class="user-stat-grid">
                <div class="user-stat-item">
                    <div class="user-stat-icon stat-icon-task">
                        <i class="bx bx-check"></i>
                    </div>
                    <div>
                        <div class="user-stat-value"><?= (int)$postCount ?></div>
                        <div class="user-stat-label">Total Post</div>
                    </div>
                </div>

                <div class="user-stat-item">
                    <div class="user-stat-icon stat-icon-project">
                        <i class="bx bx-user"></i>
                    </div>
                    <div>
                        <div class="user-stat-value">Aktif</div>
                        <div class="user-stat-label">Status</div>
                    </div>
                </div>
            </div>

            <!-- DETAILS TITLE -->
            <div class="user-details-title">Details</div>
            <div class="user-details-divider"></div>

            <!-- DETAILS LIST -->
            <div class="user-detail-row">
                <div class="user-detail-label">Username:</div>
                <div class="user-detail-value">@<?= Html::encode($model->username) ?></div>
            </div>

            <div class="user-detail-row">
                <div class="user-detail-label">Nama:</div>
                <div class="user-detail-value"><?= Html::encode($model->name) ?></div>
            </div>

            <div class="user-detail-row">
                <div class="user-detail-label">Status:</div>
                <div class="user-detail-value text-success font-weight-bold">Aktif</div>
            </div>

            <div class="user-detail-row">
                <div class="user-detail-label">Role:</div>
                <div class="user-detail-value"><?= Html::encode(ucfirst($model->role)) ?></div>
            </div>

            <div class="user-detail-row">
                <div class="user-detail-label">Artikel Terbit:</div>
                <div class="user-detail-value"><?= (int)$postCount ?> Postingan</div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="user-action-footer">
                <?= Html::a('Edit', ['update', 'id' => $model->username], [
                    'class' => 'btn btn-sneat-primary',
                ]) ?>

                <?= Html::a('Hapus', ['delete', 'id' => $model->username], [
                    'class' => 'btn btn-sneat-suspend',
                    'data' => [
                        'confirm' => 'Yakin ingin menghapus akun ini?',
                        'method' => 'post',
                    ],
                ]) ?>

                <?= Html::a('Kembali', ['index'], [
                    'class' => 'btn btn-sneat-back',
                ]) ?>
            </div>
        </div>
    </div>
>>>>>>> main
</div>
