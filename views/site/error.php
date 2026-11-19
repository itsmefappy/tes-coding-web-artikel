<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = isset($name) ? $name : 'Terjadi Kesalahan';

$statusCode = isset($exception)
    ? $exception->statusCode
    : 500;

$isForbidden = ($statusCode == 403);

?>

<div class="error-page">
    <div class="card text-center">
        <div class="card-body">
            <div class="mb-3">
                <i class="bx <?= $isForbidden ? 'bx-lock' : 'bx-error-circle' ?> bx-lg text-<?= $isForbidden ? 'danger' : 'primary' ?>"></i>
            </div>
            <h1 class="display-1 fw-bold text-<?= $isForbidden ? 'danger' : 'primary' ?>">
                <?= Html::encode($statusCode) ?>
            </h1>
            <h2 class="mb-3">
                <?= $isForbidden
                    ? 'Akses Ditolak!'
                    : Html::encode($this->title) ?>
            </h2>
            <p class="mb-4 text-muted">
                <?= $isForbidden
                    ? 'Maaf, Anda tidak memiliki izin untuk mengakses halaman atau melakukan tindakan ini.\nSilakan kembali ke Dashboard atau hubungi Administrator jika Anda merasa seharusnya memiliki akses.'
                    : Html::encode($message) ?>
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <?= Html::a(
                        'Kembali ke Dashboard',
                        ['/dashboard/index'],
                        ['class' => 'btn btn-sneat-primary']
                    ) ?>
                <?php else: ?>
                    <?= Html::a(
                        'Kembali ke Home',
                        ['/site/index'],
                        ['class' => 'btn btn-sneat-primary']
                    ) ?>
                <?php endif; ?>
                <?= Html::a(
                    'Kembali Sebelumnya',
                    'javascript:history.back()',
                    ['class' => 'btn btn-sneat-back']
                ) ?>
            </div>
        </div>
    </div>
</div>
