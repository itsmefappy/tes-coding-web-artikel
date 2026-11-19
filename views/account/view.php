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

<style>
/* User Detail Sneat Card Profile */
.user-profile-wrapper {
    max-width: 500px;
    margin: 2rem auto;
}

.user-profile-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 14px 0 rgba(38, 60, 85, 0.1);
    border: 1px solid #e8edf3;
    overflow: hidden;
}

.user-profile-body {
    padding: 2.25rem 2rem 2rem;
    text-align: center;
}

.user-avatar-box {
    width: 110px;
    height: 110px;
    border-radius: 12px;
    margin: 0 auto 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 42px;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(135deg, #696cff 0%, #3f42db 100%);
    box-shadow: 0 4px 12px rgba(105, 108, 255, 0.35);
}

.user-avatar-author {
    background: linear-gradient(135deg, var(--app-success) 0%, #44b60c 100%);
    box-shadow: 0 4px 12px rgba(113, 221, 55, 0.35);
}

.user-profile-name {
    font-size: 1.35rem;
    font-weight: 600;
    color: #384551;
    margin-bottom: 0.35rem;
}

.user-badge-role {
    display: inline-block;
    padding: 0.3rem 0.85rem;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-role-admin {
    background: #eae8fd;
    color: #696cff;
}

.badge-role-author {
    background: #e8fadf;
    color: var(--app-success);
}

/* Mini stat counter */
.user-stat-grid {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    margin: 1.75rem 0 1.75rem;
}

.user-stat-item {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    text-align: left;
}

.user-stat-icon {
    width: 44px;
    height: 44px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
}

.stat-icon-task {
    background: #eae8fd;
    color: #696cff;
}

.stat-icon-project {
    background: #e8fadf;
    color: var(--app-success);
}

.user-stat-value {
    font-size: 1.15rem;
    font-weight: 600;
    color: #384551;
    line-height: 1.2;
}

.user-stat-label {
    font-size: 0.8rem;
    color: #677788;
}

/* Detail list section */
.user-details-title {
    font-size: 1.05rem;
    font-weight: 600;
    color: #384551;
    text-align: left;
    margin-bottom: 1rem;
}

.user-details-divider {
    border-top: 1px solid #e8edf3;
    margin-bottom: 1.25rem;
}

.user-detail-row {
    display: flex;
    align-items: flex-start;
    padding: 0.45rem 0;
    font-size: 0.875rem;
    text-align: left;
}

.user-detail-label {
    width: 38%;
    font-weight: 600;
    color: #384551;
}

.user-detail-value {
    width: 62%;
    color: #677788;
    word-break: break-word;
}

/* Action button area */
.user-action-footer {
    display: flex;
    justify-content: center;
    gap: 0.85rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e8edf3;
}

.user-action-footer .btn {
    padding: 0.55rem 1.4rem;
    font-weight: 600;
    border-radius: 6px;
    font-size: 0.875rem;
}
</style>

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
