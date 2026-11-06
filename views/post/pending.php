
<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Pending Review';

$this->params['breadcrumbs'][] = [
    'label' => 'Semua Artikel',
    'url' => ['index']
];

$this->params['breadcrumbs'][] = $this->title;

?>

<style>

/* =================================
   PENDING REVIEW HEADER
================================= */

.pending-header {
    background: #fff;
    border: 1px solid #e8edf3;
    border-left: 4px solid #337ab7;
    border-radius: 7px;
    padding: 22px 25px;
    margin-bottom: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.pending-header h1 {
    color: #25364a;
    font-size: 23px;
    font-weight: 600;
    margin: 0 0 8px;
}

.pending-header p {
    color: #667085;
    font-size: 13px;
    margin: 0;
}

/* =================================
   PENDING TABLE CARD
================================= */

.pending-table-card {
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 7px;
    padding: 22px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.pending-section-title {
    color: #25364a;
    font-size: 16px;
    font-weight: 600;
    margin: 0 0 6px;
}

.pending-section-description {
    color: #667085;
    font-size: 13px;
    margin-bottom: 20px;
}

.pending-divider {
    border-top: 1px solid #edf0f4;
    margin-bottom: 20px;
}

/* =================================
   GRIDVIEW
================================= */

.pending-table-card .table {
    width: 100%;
    margin-bottom: 0;
    border: 1px solid #e4e7ec;
}

.pending-table-card .table thead th {
    background: #f5f8fc;
    color: #344054;
    font-size: 12px;
    font-weight: 600;
    border-bottom: 1px solid #e4e7ec;
    padding: 13px 12px;
    white-space: nowrap;
    vertical-align: middle;
}

.pending-table-card .table tbody td {
    color: #475467;
    font-size: 13px;
    padding: 14px 12px;
    vertical-align: top;
}

.pending-table-card .table tbody tr:hover {
    background: #f8fafc;
}

.pending-table-card .summary {
    color: #667085;
    font-size: 12px;
    margin-bottom: 12px;
}

.pending-table-card .pagination {
    margin-bottom: 0;
}

/* =================================
   ARTICLE TITLE
================================= */

.pending-article-title {
    color: #337ab7;
    font-weight: 600;
    text-decoration: none;
    overflow-wrap: anywhere;
}

.pending-article-title:hover {
    color: #23527c;
    text-decoration: underline;
}

/* =================================
   REVIEW ACTIONS
================================= */

.pending-review-actions {
    min-width: 220px;
}

.pending-approve-btn {
    display: inline-block;
    margin-bottom: 12px;
    padding: 7px 13px;
    border-radius: 5px;
    font-size: 12px;
    font-weight: 600;
}

.pending-reject-form {
    min-width: 200px;
}

.pending-reject-form textarea {
    min-height: 65px;
    resize: vertical;
    border: 1px solid #d0d5dd;
    border-radius: 5px;
    box-shadow: none;
    font-size: 12px;
    margin-bottom: 8px;
}

.pending-reject-form textarea:focus {
    border-color: #337ab7;
    box-shadow: 0 0 0 2px rgba(51,122,183,0.10);
}

.pending-reject-btn {
    padding: 7px 13px;
    border-radius: 5px;
    font-size: 12px;
    font-weight: 600;
}

/* =================================
   EMPTY STATE
================================= */

.pending-table-card .empty {
    color: #667085;
    padding: 30px 15px;
    text-align: center;
    font-size: 13px;
}

/* =================================
   RESPONSIVE
================================= */

@media (max-width: 767px) {

    .pending-header {
        padding: 17px;
    }

    .pending-header h1 {
        font-size: 20px;
    }

    .pending-table-card {
        padding: 14px;
        overflow-x: auto;
    }

    .pending-table-card .table {
        min-width: 750px;
    }

    .pending-table-card .table thead th,
    .pending-table-card .table tbody td {
        padding: 10px;
    }

}

</style>


<div class="post-pending">

    <!-- HEADER -->

    <div class="pending-header">

        <h1>
            <span class="glyphicon glyphicon-time"></span>
            <?= Html::encode($this->title) ?>
        </h1>

        <p>
            Periksa artikel yang diajukan oleh Author sebelum menyetujui atau menolaknya.
        </p>

    </div>


    <!-- TABLE -->

    <div class="pending-table-card">

        <div class="pending-section-title">
            Daftar Artikel Menunggu Review
        </div>

        <div class="pending-section-description">
            Periksa judul dan penulis artikel sebelum mengambil keputusan.
        </div>

        <div class="pending-divider"></div>


        <?= GridView::widget([

            'dataProvider' => $dataProvider,

            'emptyText' => '
                <span class="glyphicon glyphicon-inbox"></span>
                <br><br>
                Belum ada artikel yang menunggu review.
            ',

            'emptyTextOptions' => [
                'class' => 'empty',
            ],

            'tableOptions' => [
                'class' => 'table table-bordered table-striped',
            ],

            'summary' => 'Menampilkan <strong>{begin}-{end}</strong> dari <strong>{totalCount}</strong> artikel.',

            'summaryOptions' => [
                'class' => 'summary',
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
                                'class' => 'pending-article-title',
                                'title' => 'Lihat detail artikel',
                            ]
                        );

                    },
                ],

                // PENULIS

                [
                    'attribute' => 'username',
                    'label' => 'Penulis',

                    'value' => function ($model) {
                        return $model->username;
                    },
                ],

                // TANGGAL

                [
                    'attribute' => 'date',
                    'label' => 'Tanggal Dibuat',
                ],

                // AKSI REVIEW

                [
                    'label' => 'Aksi Review',
                    'format' => 'raw',

                    'value' => function ($model) {

                        // APPROVE BUTTON

                        $approveButton = Html::a(
                            '<span class="glyphicon glyphicon-ok"></span> Approve',
                            ['approve', 'id' => $model->idpost],
                            [
                                'class' => 'btn btn-success btn-sm pending-approve-btn',

                                'data' => [
                                    'method' => 'post',
                                    'confirm' => 'Apakah Anda yakin ingin menyetujui artikel ini?',
                                ],
                            ]
                        );


                        // REJECT FORM

                        $rejectForm = Html::beginForm(
                            ['reject', 'id' => $model->idpost],
                            'post',
                            [
                                'class' => 'pending-reject-form',
                            ]
                        );

                        $rejectForm .= Html::textarea(
                            'rejection_reason',
                            '',
                            [
                                'class' => 'form-control',
                                'rows' => 3,
                                'placeholder' => 'Tuliskan alasan penolakan...',
                                'required' => true,
                                'maxlength' => 5000,
                            ]
                        );

                        $rejectForm .= Html::submitButton(
                            '<span class="glyphicon glyphicon-remove"></span> Reject',
                            [
                                'class' => 'btn btn-danger btn-sm pending-reject-btn',

                                'data' => [
                                    'confirm' => 'Apakah Anda yakin ingin menolak artikel ini?',
                                ],
                            ]
                        );

                        $rejectForm .= Html::endForm();


                        return '<div class="pending-review-actions">'
                            . $approveButton
                            . $rejectForm
                            . '</div>';

                    },
                ],

            ],

        ]); ?>

    </div>

</div>
