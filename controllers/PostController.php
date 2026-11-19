<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'mine',
                            'view',
                            'create',
                            'update',
                            'delete',
                            'submit'
                        ],
                        'allow' => true,
                        'roles' => ['Author', 'Admin'],
                    ],
                    [
                        'actions' => [
                            'pending',
                            'approve',
                            'reject'
                        ],
                        'allow' => true,
                        'roles' => ['Admin'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'submit' => ['POST'],
                    'approve' => ['POST'],
                    'reject' => ['POST'],
                ],
            ],
        ];
    }

    // Memeriksa apakah pengguna adalah Admin.
    private function isAdmin()
    {
        return Yii::$app->user->can('Admin');
    }

    // Memastikan pengguna hanya mengelola artikelnya sendiri.
    private function checkOwnership(Post $model)
    {
        if (
            !$this->isAdmin() &&
            $model->username !== Yii::$app->user->identity->username
        ) {
            throw new ForbiddenHttpException(
                'Anda tidak memiliki akses ke artikel ini.'
            );
        }
    }

    // ==========================================
    // SEMUA ARTIKEL
    // Admin: melihat semua artikel.
    // Author: hanya melihat artikel Published.
    // ==========================================
    public function actionIndex()
    {
        $query = Post::find();

        if (!$this->isAdmin()) {
            $query->where([
                'status' => Post::STATUS_PUBLISHED
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy([
                'date' => SORT_DESC
            ]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    // ==========================================
    // ARTIKEL SAYA
    // Menampilkan artikel milik pengguna login.
    // ==========================================
    public function actionMine()
    {
        $query = Post::find()->where([
            'username' => Yii::$app->user->identity->username
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy([
                'date' => SORT_DESC
            ]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    // ==========================================
    // DETAIL ARTIKEL
    // Author boleh membaca artikel orang lain
    // jika statusnya Published.
    // ==========================================
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if (
            !$this->isAdmin() &&
            $model->username !== Yii::$app->user->identity->username &&
            $model->status !== Post::STATUS_PUBLISHED
        ) {
            throw new ForbiddenHttpException(
                'Anda tidak memiliki akses ke artikel ini.'
            );
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    // ==========================================
    // BUAT ARTIKEL
    // Semua artikel baru berstatus Draft.
    // ==========================================
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post())) {
            $model->date = date('Y-m-d H:i:s');
            $model->username = Yii::$app->user->identity->username;
            $model->status = Post::STATUS_DRAFT;
            $model->rejection_reason = null;
            $model->reviewed_by = null;
            $model->reviewed_at = null;

            if ($model->save()) {
                return $this->redirect([
                    'view',
                    'id' => $model->idpost
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    // ==========================================
    // EDIT ARTIKEL
    // ==========================================
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->checkOwnership($model);

        // Author hanya boleh mengedit Draft dan Rejected.
        // Admin boleh mengedit artikel miliknya sendiri.
        if (
            !$this->isAdmin() &&
            !in_array($model->status, [
                Post::STATUS_DRAFT,
                Post::STATUS_REJECTED
            ])
        ) {
            throw new ForbiddenHttpException(
                'Artikel ini tidak dapat diedit.'
            );
        }

        $oldStatus = $model->status;
        $oldUsername = $model->username;

        if ($model->load(Yii::$app->request->post())) {
            $model->username = $oldUsername;
            $model->status = $oldStatus;
            $model->date = date('Y-m-d H:i:s');

            if ($model->save()) {
                return $this->redirect([
                    'view',
                    'id' => $model->idpost
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    // ==========================================
    // HAPUS ARTIKEL
    // ==========================================
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->checkOwnership($model);

        // Author hanya boleh menghapus Draft dan Rejected.
        if (
            !$this->isAdmin() &&
            !in_array($model->status, [
                Post::STATUS_DRAFT,
                Post::STATUS_REJECTED
            ])
        ) {
            throw new ForbiddenHttpException(
                'Artikel ini tidak dapat dihapus.'
            );
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    // ==========================================
    // AJUKAN ARTIKEL UNTUK REVIEW
    // Author dan Admin dapat mengajukan artikel sendiri.
    // ==========================================
    public function actionSubmit($id)
    {
        $model = $this->findModel($id);
        $this->checkOwnership($model);

        if (!in_array($model->status, [
            Post::STATUS_DRAFT,
            Post::STATUS_REJECTED
        ])) {
            throw new BadRequestHttpException(
                'Artikel tidak dapat diajukan untuk review.'
            );
        }

        $model->status = Post::STATUS_PENDING;
        $model->rejection_reason = null;
        $model->reviewed_by = null;
        $model->reviewed_at = null;

        if ($model->save(false)) {
            Yii::$app->session->setFlash(
                'success',
                'Artikel berhasil dikirim untuk review.'
            );
        }

        return $this->redirect([
            'view',
            'id' => $model->idpost
        ]);
    }

    // ==========================================
    // DAFTAR ARTIKEL PENDING REVIEW
    // Hanya Admin yang dapat mengakses.
    // ==========================================
    public function actionPending()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()
                ->where([
                    'status' => Post::STATUS_PENDING
                ])
                ->orderBy([
                    'date' => SORT_ASC
                ]),
        ]);

        return $this->render('pending', [
            'dataProvider' => $dataProvider,
        ]);
    }

    // ==========================================
    // ADMIN APPROVE ARTIKEL
    // Termasuk artikel milik Admin sendiri.
    // ==========================================
    public function actionApprove($id)
    {
        $model = $this->findModel($id);

        if ($model->status !== Post::STATUS_PENDING) {
            throw new BadRequestHttpException(
                'Artikel ini tidak sedang menunggu review.'
            );
        }

        $model->status = Post::STATUS_PUBLISHED;
        $model->rejection_reason = null;
        $model->reviewed_by = Yii::$app->user->identity->username;
        $model->reviewed_at = date('Y-m-d H:i:s');

        if ($model->save(false)) {
            Yii::$app->session->setFlash(
                'success',
                'Artikel berhasil disetujui dan dipublikasikan.'
            );
        }

        return $this->redirect(['pending']);
    }

    // ==========================================
    // ADMIN REJECT ARTIKEL
    // Termasuk artikel milik Admin sendiri.
    // ==========================================
    public function actionReject($id)
    {
        $model = $this->findModel($id);

        if ($model->status !== Post::STATUS_PENDING) {
            throw new BadRequestHttpException(
                'Artikel ini tidak sedang menunggu review.'
            );
        }

        $reason = trim(
            Yii::$app->request->post('rejection_reason', '')
        );

        if ($reason === '') {
            Yii::$app->session->setFlash(
                'error',
                'Alasan penolakan wajib diisi.'
            );

            return $this->redirect(['pending']);
        }

        $model->status = Post::STATUS_REJECTED;
        $model->rejection_reason = $reason;
        $model->reviewed_by = Yii::$app->user->identity->username;
        $model->reviewed_at = date('Y-m-d H:i:s');

        if ($model->save(false)) {
            Yii::$app->session->setFlash(
                'success',
                'Artikel berhasil ditolak.'
            );
        }

        return $this->redirect(['pending']);
    }

    // ==========================================
    // MENCARI ARTIKEL BERDASARKAN ID
    // ==========================================
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(
            'Artikel yang diminta tidak ditemukan.'
        );
    }
}
