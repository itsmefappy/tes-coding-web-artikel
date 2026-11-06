<?php

namespace app\controllers;

use Yii;
use app\models\Account;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class AccountController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index', 'create', 'update', 'delete', 'view'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->authManager->getAssignment(
                                'Admin',
                                Yii::$app->user->id
                            ) !== null;
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Account::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Account();

        if ($model->load(Yii::$app->request->post())) {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole($model->role);

            if (!$role) {
                $model->addError('role', 'Role tidak valid.');
            } else {
                $model->password = Yii::$app->security
                    ->generatePasswordHash($model->password);

                if ($model->save()) {
                    $auth->revokeAll($model->username);
                    $auth->assign($role, $model->username);

                    return $this->redirect([
                        'view',
                        'id' => $model->username
                    ]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldPassword = $model->password;

        if ($model->load(Yii::$app->request->post())) {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole($model->role);

            if (!$role) {
                $model->addError('role', 'Role tidak valid.');
            } else {
                if (empty($model->password)) {
                    $model->password = $oldPassword;
                } else {
                    $model->password = Yii::$app->security
                        ->generatePasswordHash($model->password);
                }

                if ($model->save()) {
                    $auth->revokeAll($model->username);
                    $auth->assign($role, $model->username);

                    return $this->redirect([
                        'view',
                        'id' => $model->username
                    ]);
                }
            }
        } else {
            $model->password = '';
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        Yii::$app->authManager->revokeAll($model->username);
        $model->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(
            'Akun yang diminta tidak ditemukan.'
        );
    }
}
