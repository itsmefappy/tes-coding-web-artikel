<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title = $model->name;
$this->params['breadcrumbs'][] = [
    'label' => 'Manajemen Akun',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

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
</div>
