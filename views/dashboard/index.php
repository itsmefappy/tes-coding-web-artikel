
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Post;

$this->title = 'Dashboard';

?>

<style>

/* =================================
   DASHBOARD HEADER
================================= */

.dashboard-header {
    background: #fff;
    padding: 22px 25px;
    border: 1px solid #e8edf3;
    border-left: 4px solid #337ab7;
    border-radius: 6px;
    margin-bottom: 25px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.dashboard-header h1 {
    color: #25364a;
    font-size: 26px;
    font-weight: 600;
    margin: 0 0 8px;
}

.dashboard-header p {
    color: #667085;
    margin-bottom: 4px;
}

.dashboard-header strong {
    color: #337ab7;
}

/* =================================
   SECTION TITLE
================================= */

.dashboard-section-title {
    color: #25364a;
    font-size: 19px;
    font-weight: 600;
    margin-bottom: 20px;
}

/* =================================
   STATISTICS CARDS
================================= */

.dashboard-stats-row {
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
}

.dashboard-stats-row > [class*="col-"] {
    display: flex;
    margin-bottom: 20px;
}

.dashboard-card {
    width: 100%;
    min-height: 155px;
    background: #fff;
    border: 1px solid #e8edf3;
    border-top: 3px solid #337ab7;
    border-radius: 6px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
    transition: transform 0.2s ease,
                box-shadow 0.2s ease;
    overflow: hidden;
}

.dashboard-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 14px rgba(0,0,0,0.08);
}

.dashboard-card-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 23px 20px;
    min-height: 152px;
}

.dashboard-card-info {
    min-width: 0;
}

.dashboard-card-info h4 {
    color: #667085;
    font-size: 14px;
    font-weight: 600;
    margin: 0 0 12px;
}

.dashboard-card-info h2 {
    color: #25364a;
    font-size: 32px;
    font-weight: 700;
    margin: 0 0 7px;
}

.dashboard-card-info small {
    color: #98a2b3;
    font-size: 12px;
}

.dashboard-card-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 23px;
    background: #eaf3fb;
    color: #337ab7;
}

/* Warna masing-masing kartu */

.card-primary {
    border-top-color: #337ab7;
}

.card-primary .dashboard-card-icon {
    background: #eaf3fb;
    color: #337ab7;
}

.card-default {
    border-top-color: #98a2b3;
}

.card-default .dashboard-card-icon {
    background: #f2f4f7;
    color: #667085;
}

.card-warning {
    border-top-color: #f0ad4e;
}

.card-warning .dashboard-card-icon {
    background: #fff5e6;
    color: #d99025;
}

.card-success {
    border-top-color: #5cb85c;
}

.card-success .dashboard-card-icon {
    background: #eaf7ea;
    color: #449d44;
}

.card-danger {
    border-top-color: #d9534f;
}

.card-danger .dashboard-card-icon {
    background: #fcebea;
    color: #d9534f;
}

/* Kartu yang bisa diklik */

.dashboard-card-link {
    display: block;
    width: 100%;
    color: inherit;
    text-decoration: none !important;
}

.dashboard-card-link:focus {
    outline: 2px solid #337ab7;
    outline-offset: 3px;
}

/* =================================
   ARTICLE TABLE
================================= */

.dashboard-table-wrapper {
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 6px;
    padding: 15px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.dashboard-table-wrapper .table {
    margin-bottom: 0;
}

.dashboard-table-wrapper .summary {
    color: #667085;
    margin-bottom: 12px;
}

.dashboard-table-wrapper .pagination {
    margin-bottom: 5px;
}

.dashboard-table-wrapper .table > thead > tr > th {
    background: #f5f8fc;
    color: #344054;
    font-weight: 600;
    border-bottom: 1px solid #e4e7ec;
}

.dashboard-table-wrapper .table > tbody > tr > td {
    vertical-align: middle;
}

.dashboard-table-wrapper .table > tbody > tr:hover {
    background: #f5f9ff;
}

/* =================================
   STATUS LABEL
================================= */

.dashboard-table-wrapper .label {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 4px;
    font-size: 11px;
}

/* =================================
   RESPONSIVE
================================= */

@media (max-width: 767px) {

    .dashboard-header {
        padding: 18px;
    }

    .dashboard-header h1 {
        font-size: 22px;
    }

    .dashboard-card-inner {
        padding: 18px 15px;
    }

    .dashboard-card-info h2 {
        font-size: 27px;
    }

    .dashboard-card-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        font-size: 20px;
    }

    .dashboard-table-wrapper {
        padding: 10px;
    }

}

</style>


<div class="dashboard-index">

    <!-- HEADER DASHBOARD -->

    <div class="dashboard-header">

        <h1>Dashboard</h1>

        <p>
            Selamat datang,
            <strong><?= Html::encode($username) ?>!</strong>
        </p>

        <p>
            <?= $isAdmin
                ? 'Anda login sebagai Administrator.'
                : 'Anda login sebagai Author.' ?>
        </p>

    </div>


    <!-- RINGKASAN ARTIKEL -->

    <h3 class="dashboard-section-title">
        Ringkasan Artikel
    </h3>

    <div class="row dashboard-stats-row">


        <!-- TOTAL ARTIKEL -->

        <div class="col-md-3 col-sm-6">

            <div class="dashboard-card card-primary">

                <div class="dashboard-card-inner">

                    <div class="dashboard-card-info">

                        <h4>Total Artikel</h4>

                        <h2><?= $totalArticles ?></h2>

                        <small>Seluruh artikel</small>

                    </div>

                    <div class="dashboard-card-icon">
                        <span class="glyphicon glyphicon-file"></span>
                    </div>

                </div>

            </div>

        </div>


        <!-- DRAFT -->

        <div class="col-md-3 col-sm-6">

            <div class="dashboard-card card-default">

                <div class="dashboard-card-inner">

                    <div class="dashboard-card-info">

                        <h4>Draft</h4>

                        <h2><?= $totalDraft ?></h2>

                        <small>Artikel belum diajukan</small>

                    </div>

                    <div class="dashboard-card-icon">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </div>

                </div>

            </div>

        </div>


        <!-- MENUNGGU REVIEW -->

        <div class="col-md-3 col-sm-6">

            <a
                href="<?= Url::to(
                    $isAdmin ? ['/post/pending'] : ['/post/mine']
                ) ?>"
                class="dashboard-card-link"
                title="Lihat artikel menunggu review"
            >

                <div class="dashboard-card card-warning">

                    <div class="dashboard-card-inner">

                        <div class="dashboard-card-info">

                            <h4>Menunggu Review</h4>

                            <h2>
                                <?= $isAdmin
                                    ? $pendingReview
                                    : $totalPending ?>
                            </h2>

                            <small>
                                <?= $isAdmin
                                    ? 'Klik untuk memeriksa artikel'
                                    : 'Artikel sedang diperiksa' ?>
                            </small>

                        </div>

                        <div class="dashboard-card-icon">
                            <span class="glyphicon glyphicon-time"></span>
                        </div>

                    </div>

                </div>

            </a>

        </div>


        <!-- PUBLISHED -->

        <div class="col-md-3 col-sm-6">

            <div class="dashboard-card card-success">

                <div class="dashboard-card-inner">

                    <div class="dashboard-card-info">

                        <h4>Published</h4>

                        <h2><?= $totalPublished ?></h2>

                        <small>Artikel diterbitkan</small>

                    </div>

                    <div class="dashboard-card-icon">
                        <span class="glyphicon glyphicon-ok-circle"></span>
                    </div>

                </div>

            </div>

        </div>


        <!-- REJECTED -->

        <div class="col-md-3 col-sm-6">

            <div class="dashboard-card card-danger">

                <div class="dashboard-card-inner">

                    <div class="dashboard-card-info">

                        <h4>Ditolak</h4>

                        <h2><?= $totalRejected ?></h2>

                        <small>Artikel perlu diperbaiki</small>

                    </div>

                    <div class="dashboard-card-icon">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <hr>


    <!-- ARTIKEL TERBARU -->

    <h3 class="dashboard-section-title">
        Artikel Terbaru
    </h3>

    <div class="dashboard-table-wrapper">

        <?= GridView::widget([

            'dataProvider' => $recentArticles,

            'summary' => 'Menampilkan {begin}-{end} dari {totalCount} artikel.',

            'emptyText' => 'Belum ada artikel.',

            'tableOptions' => [
                'class' => 'table table-striped table-bordered'
            ],

            'columns' => [

                [
                    'class' => 'yii\grid\SerialColumn',
                ],

                [
                    'attribute' => 'title',
                    'label' => 'Judul Artikel',
                    'format' => 'raw',

                    'value' => function ($model) {
                        return Html::a(
                            Html::encode($model->title),
                            ['/post/view', 'id' => $model->idpost]
                        );
                    },
                ],

                [
                    'attribute' => 'username',
                    'label' => 'Penulis',
                ],

                [
                    'attribute' => 'date',
                    'label' => 'Tanggal',
                ],

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

                        $colors = [
                            Post::STATUS_DRAFT => 'default',
                            Post::STATUS_PENDING => 'warning',
                            Post::STATUS_PUBLISHED => 'success',
                            Post::STATUS_REJECTED => 'danger',
                        ];

                        $status = $model->status;

                        return Html::tag(
                            'span',
                            isset($labels[$status])
                                ? $labels[$status]
                                : $status,
                            [
                                'class' => 'label label-' .
                                    (isset($colors[$status])
                                        ? $colors[$status]
                                        : 'default')
                            ]
                        );
                    },
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'controller' => 'post',
                ],

            ],

        ]); ?>

    </div>

</div>
