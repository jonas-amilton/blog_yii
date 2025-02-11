<?php

namespace app\controllers;

use app\models\ProfileForm;
use app\models\User;
use yii\web\Controller;
use Yii;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        $modelProfileForm = new ProfileForm();

        $user = User::findOne(['id' => Yii::$app->user->identity->id]);
        $profile = null;
        $posts = [];

        if ($user) {
            $posts = $user->posts;

            if ($user->profiles) {
                $profile = array_reverse($user->profiles)[0];

                $profilePhoto = "{$profile->avatars[0]->name}.{$profile->avatars[0]->extension}";
            }
        }

        if (!$profile) {
            $profilePhoto = 'avatar-default.png';
        }

        return $this->render(
            'index',
            compact(
                'modelProfileForm',
                'profile',
                'profilePhoto',
                'posts'
            )
        );
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
