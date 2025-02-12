<?php

namespace app\controllers;

use app\models\ProfileForm;
use app\services\UserService;
use yii\web\Controller;
use Yii;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        $modelProfileForm = new ProfileForm();
        $userService = new UserService(Yii::$app->user->identity->id);

        $posts = $userService->getPostByUser();
        $profile = $userService->getProfile();
        $profilePhoto = $userService->getProfilePhoto();

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

    public function actionUser($id)
    {
        if (Yii::$app->user->identity->id == $id) {
            return $this->redirect(['profile/index']);
        }

        $userService = new UserService($id);

        $user = $userService->getUser();
        $posts = $userService->getPostByUser();
        $profile = $userService->getProfile();
        $profilePhoto = $userService->getProfilePhoto();

        return $this->render(
            'user',
            compact(
                'profile',
                'profilePhoto',
                'posts',
                'user'
            )
        );
    }
}
