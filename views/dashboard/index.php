<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Dashboard';

?>

<div class="dashboard-index">
    <!-- GREETING / HEADER CARD -->
    <div class="card page-header-card mb-4">
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h4 class="mb-1 text-heading">
                        Dashboard
                    </h4>
                    <p class="text-muted mb-0">
                        Selamat datang, <strong><?= Html::encode($username) ?></strong>.
                        Anda login sebagai <?= $isAdmin ? 'Administrator' : 'Author' ?>.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION TITLE -->
    <h5 class="py-2 mb-3 text-muted">
        <i class="bx bx-bar-chart-alt-2 me-1"></i> Ringkasan Artikel
    </h5>

    <!-- STATISTICS CARDS -->
    <div class="row g-4">
        <!-- TOTAL ARTIKEL -->
        <div class="col-sm-6 col-lg-4 col-xl">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bx bx-file"></i>
                            </span>
                        </div>
                        <span class="badge bg-label-secondary rounded-pill">Total</span>
                    </div>
                    <span class="d-block fw-medium mb-1">Total Artikel</span>
                    <h3 class="card-title mb-1 text-heading"><?= (int)$totalArticles ?></h3>
                    <small class="text-muted">Semua artikel terdaftar</small>
                </div>
            </div>
        </div>

        <!-- DRAFT -->
        <div class="col-sm-6 col-lg-4 col-xl">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-secondary">
                                <i class="bx bx-edit-alt"></i>
                            </span>
                        </div>
                        <span class="badge bg-label-secondary rounded-pill">Draft</span>
                    </div>
                    <span class="d-block fw-medium mb-1">Draft</span>
                    <h3 class="card-title mb-1 text-heading"><?= (int)$totalDraft ?></h3>
                    <small class="text-muted">Belum diajukan</small>
                </div>
            </div>
        </div>

        <!-- MENUNGGU REVIEW -->
        <div class="col-sm-6 col-lg-4 col-xl">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-warning">
                                <i class="bx bx-time-five"></i>
                            </span>
                        </div>
                        <span class="badge bg-label-warning rounded-pill">Review</span>
                    </div>
                    <span class="d-block fw-medium mb-1">Menunggu Review</span>
                    <h3 class="card-title mb-1 text-heading">
                        <?= (int)($isAdmin ? $pendingReview : $totalPending) ?>
                    </h3>
                    <small class="text-muted">
                        <?= $isAdmin ? 'Artikel perlu diperiksa' : 'Sedang diperiksa' ?>
                    </small>
                </div>
            </div>
        </div>

        <!-- PUBLISHED -->
        <div class="col-sm-6 col-lg-6 col-xl">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="bx bx-check-circle"></i>
                            </span>
                        </div>
                        <span class="badge bg-label-success rounded-pill">Published</span>
                    </div>
                    <span class="d-block fw-medium mb-1">Published</span>
                    <h3 class="card-title mb-1 text-heading"><?= (int)$totalPublished ?></h3>
                    <small class="text-muted">Artikel aktif terbit</small>
                </div>
            </div>
        </div>

        <!-- REJECTED -->
        <div class="col-sm-6 col-lg-6 col-xl">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-danger">
                                <i class="bx bx-x-circle"></i>
                            </span>
                        </div>
                        <span class="badge bg-label-danger rounded-pill">Perlu Revisi</span>
                    </div>
                    <span class="d-block fw-medium mb-1">Ditolak</span>
                    <h3 class="card-title mb-1 text-heading"><?= (int)$totalRejected ?></h3>
                    <small class="text-muted">Perlu perbaikan</small>
                </div>
            </div>
        </div>
    </div>
</div>
