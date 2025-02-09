<?php

namespace app\controllers;

use app\models\ProfileForm;
use yii\web\Controller;
use Yii;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        $modelProfileForm = new ProfileForm();

        return $this->render('index', compact('modelProfileForm'));
    }

    public function actionEdit()
    {
        if (!Yii::$app->user->identity) {
            Yii::$app->session->setFlash('warning', 'Você precisa estar logado para acessar essa página.');
            return $this->redirect(['site/login']);
        }
        $modelProfileForm = new ProfileForm();

        if (
            Yii::$app->request->isPost
            && $modelProfileForm->load(Yii::$app->request->post())
            && $modelProfileForm->saveProfile()
        ) {
            Yii::$app->session->setFlash(
                'success',
                'Perfil alterado com sucesso!'
            );

            return $this->redirect(['profile/index']);
        }
    }
}
