<?php

namespace app\controllers;

use app\models\Image;
use app\models\Post;
use app\models\PostForm;
use app\models\UploadForm;
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

    public function actionDelete($id, $userId)
    {
        if (Yii::$app->user->id != $userId) {
            Yii::$app->session->setFlash(
                "danger",
                "Exclusão não permitida, você não é o criador da publicação!"
            );
            return $this->redirect(['site/index']);
        }

        $imageToDelete = Image::findOne(['post_id' => $id]);

        if ($imageToDelete) {
            $filenameToDelete = "{$imageToDelete->name}.{$imageToDelete->extension}";
            $imageToDelete->delete();
            UploadForm::delete($filenameToDelete);
        }

        $postToDelete = Post::findOne($id);

        if (!$postToDelete) {
            Yii::$app->session->setFlash(
                "warning",
                "Falha na exclusão! Não foi possível encontrar a publicação."
            );
            return $this->redirect(['site/index']);
        }

        if ($postToDelete->delete()) {
            Yii::$app->session->setFlash(
                "success",
                "Sua publicação foi deletada com sucesso!"
            );
            return $this->redirect(['site/index']);
        }

        Yii::$app->session->setFlash(
            "danger",
            "Erro na solicitação, tente novamente."
        );
        return $this->redirect(['site/index']);
    }
}
