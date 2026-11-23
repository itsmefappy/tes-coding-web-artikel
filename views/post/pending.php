<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Menunggu Review';

$this->params['breadcrumbs'][] = [
    'label' => 'Semua Artikel',
    'url' => ['index']
];

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="post-pending">
    <!-- HEADER -->
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title mb-1">
                <?= Html::encode($this->title) ?>
            </h4>
            <p class="text-muted mb-0">
                Periksa artikel yang diajukan oleh Author sebelum menyetujui atau menolaknya.
            </p>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">
                Daftar Artikel Menunggu Review
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'emptyText' => '
                        <div class="text-center py-4">
                            <p class="text-muted mb-0">Belum ada artikel yang menunggu review.</p>
                        </div>
                    ',
                    'emptyTextOptions' => [
                        'class' => 'empty',
                    ],
                    'tableOptions' => [
                        'class' => 'table table-hover align-middle mb-0',
                    ],
                    'summary' => '<div class="p-3 text-muted">Menampilkan <strong>{begin}-{end}</strong> dari <strong>{totalCount}</strong> artikel.</div>',
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'No.',
                        ],
                        [
                            'label' => 'Judul Artikel',
                            'value' => function ($model) {
                                return $model->title;
                            },
                        ],
                        [
                            'label' => 'Penulis',
                            'value' => function ($model) {
                                return $model->username;
                            },
                        ],
                        [
                            'label' => 'Tanggal Dibuat',
                            'value' => function ($model) {
                                return $model->date;
                            },
                        ],
                        [
                            'label' => 'Aksi Review',
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'min-width: 260px;'],
                            'value' => function ($model) {
                                $formId = 'reject-form-' . $model->idpost;

                                $approveButton = Html::a(
                                    '<i class="bx bx-check me-1"></i> Setuju',
                                    ['approve', 'id' => $model->idpost],
                                    [
                                        'class' => 'btn btn-sm btn-outline-success',
                                        'data' => [
                                            'method' => 'post',
                                            'confirm' => 'Apakah Anda yakin ingin menyetujui artikel ini?',
                                        ],
                                    ]
                                );

                                $rejectButton = Html::submitButton(
                                    '<i class="bx bx-x me-1"></i> Tolak',
                                    [
                                        'class' => 'btn btn-sm btn-outline-danger',
                                        'form' => $formId,
                                        'data' => [
                                            'confirm' => 'Apakah Anda yakin ingin menolak artikel ini?',
                                        ],
                                    ]
                                );

                                $rejectForm = Html::beginForm(
                                    ['reject', 'id' => $model->idpost],
                                    'post',
                                    ['class' => 'pending-reject-form mt-2', 'id' => $formId]
                                );

                                $rejectForm .= Html::textarea(
                                    'rejection_reason',
                                    '',
                                    [
                                        'class' => 'form-control',
                                        'rows' => 2,
                                        'placeholder' => 'Tuliskan alasan penolakan...',
                                        'required' => true,
                                        'maxlength' => 5000,
                                    ]
                                );

                                $rejectForm .= Html::endForm();

                                return '<div class="pending-review-actions">'
                                    . '<div class="pending-review-buttons">'
                                    . $approveButton
                                    . $rejectButton
                                    . '</div>'
                                    . $rejectForm
                                    . '</div>';
                            },
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
