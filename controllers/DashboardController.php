<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

class DashboardController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['Author', 'Admin'],
                    ],
                ],
            ],
        ];
    }

    private function isAdmin()
    {
        return Yii::$app->user->can('Admin');
    }

    public function actionIndex()
    {
        $isAdmin = $this->isAdmin();

        $username = Yii::$app->user->identity->username;

        // Query statistik berdasarkan role.
        $query = Post::find();

        if (!$isAdmin) {
            $query->where(['username' => $username]);
        }

        // Menghitung artikel berdasarkan status.
        $totalArticles = (clone $query)->count();

        $totalDraft = (clone $query)
            ->andWhere(['status' => Post::STATUS_DRAFT])
            ->count();

        $totalPending = (clone $query)
            ->andWhere(['status' => Post::STATUS_PENDING])
            ->count();

        $totalPublished = (clone $query)
            ->andWhere(['status' => Post::STATUS_PUBLISHED])
            ->count();

        $totalRejected = (clone $query)
            ->andWhere(['status' => Post::STATUS_REJECTED])
            ->count();

        // Artikel terbaru.
        $recentQuery = clone $query;

        $recentArticles = new ActiveDataProvider([
            'query' => $recentQuery->orderBy([
                'date' => SORT_DESC
            ]),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        // Admin menghitung seluruh artikel Pending Review.
        $pendingReview = Post::find()
            ->where(['status' => Post::STATUS_PENDING])
            ->count();

        return $this->render('index', [
            'isAdmin' => $isAdmin,
            'username' => $username,
            'totalArticles' => $totalArticles,
            'totalDraft' => $totalDraft,
            'totalPending' => $totalPending,
            'totalPublished' => $totalPublished,
            'totalRejected' => $totalRejected,
            'pendingReview' => $pendingReview,
            'recentArticles' => $recentArticles,
        ]);
    }
}
