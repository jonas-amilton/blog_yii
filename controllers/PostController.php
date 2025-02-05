<?php

namespace app\controllers;

use app\models\PostForm;
use Yii;
use yii\web\Controller;

class PostController extends Controller
{
    private $modelPostForm;

    public function __construct($id, $module, $config = [])
    {
        $this->modelPostForm = new PostForm();
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        if (!Yii::$app->user->identity) {
            Yii::$app->session->setFlash('warning', 'Você precisa estar logado para acessar essa página.');
            return $this->redirect(['site/login']);
        }

        return $this->render('index', [
            'modelPostForm' => $this->modelPostForm
        ]);
    }

    public function actionCreate()
    {
        if (!Yii::$app->user->identity) {
            Yii::$app->session->setFlash('warning', 'Você precisa estar logado para acessar essa página.');
            return $this->redirect(['site/login']);
        }

        if (
            Yii::$app->request->isPost
            && $this->modelPostForm->load(Yii::$app->request->post())
            & $this->modelPostForm->savePost()
        ) {
            Yii::$app->session->setFlash('success', 'Post criado com sucesso!');

            return $this->redirect(['/post/index']);
        }
    }
}
