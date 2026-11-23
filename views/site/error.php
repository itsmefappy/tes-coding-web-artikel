<<<<<<< HEAD

=======
>>>>>>> main
<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = isset($name) ? $name : 'Terjadi Kesalahan';

$statusCode = isset($exception)
    ? $exception->statusCode
    : 500;

$isForbidden = ($statusCode == 403);

?>

<<<<<<< HEAD
<style>
.error-page {
    max-width: 650px;
    margin: 70px auto;
    padding: 40px 25px;
    text-align: center;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 6px;
}

.error-code {
    font-size: 85px;
    font-weight: bold;
    color: <?= $isForbidden ? '#d9534f' : '#337ab7' ?>;
    margin: 0;
}

.error-icon {
    font-size: 55px;
    margin-bottom: 15px;
}

.error-page h2 {
    margin-top: 10px;
    margin-bottom: 15px;
}

.error-message {
    color: #777;
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 25px;
}

.error-actions {
    margin-top: 25px;
}

.error-actions .btn {
    margin: 5px;
}
</style>

<div class="error-page">

    <div class="error-icon">
        <?= $isForbidden ? '🔒' : '⚠️' ?>
    </div>

    <h1 class="error-code">
        <?= Html::encode($statusCode) ?>
    </h1>

    <?php if ($isForbidden): ?>

        <h2>Akses Ditolak!</h2>

        <p class="error-message">
            Maaf, Anda tidak memiliki izin untuk mengakses
            halaman atau melakukan tindakan ini.
            <br>
            Silakan kembali ke Dashboard atau hubungi Administrator
            jika Anda merasa seharusnya memiliki akses.
        </p>

    <?php else: ?>

        <h2>
            <?= Html::encode($this->title) ?>
        </h2>

        <p class="error-message">
            <?= Html::encode($message) ?>
        </p>

    <?php endif; ?>


    <div class="error-actions">

        <?php if (!Yii::$app->user->isGuest): ?>

            <?= Html::a(
                'Kembali ke Dashboard',
                ['/dashboard/index'],
                ['class' => 'btn btn-primary']
            ) ?>

        <?php else: ?>

            <?= Html::a(
                'Kembali ke Home',
                ['/site/index'],
                ['class' => 'btn btn-primary']
            ) ?>

        <?php endif; ?>

        <?= Html::a(
            'Kembali Sebelumnya',
            'javascript:history.back()',
            ['class' => 'btn btn-default']
        ) ?>

    </div>

=======
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
>>>>>>> main
</div>
