<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Cadastro';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('registerFormSubmitted')): ?>
        <div class="alert alert-success">
            Usuário cadastrado com sucesso!
        </div>
    <?php else: ?>

        <p>
            Faça seu cadastro no Blog!
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password') ?>

                <?= $form->field($model, 'repeatPassword') ?>

                <div class="form-group">
                    <?= Html::submitButton('Cadastrar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

                <div style="color:#999;">
                    Já tem uma conta?
                    <a href="<?= Url::to(['site/login']); ?>">Faça Login</a>
                </div>

            </div>
        </div>

    <?php endif; ?>
</div>