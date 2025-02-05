<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Criar Post';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container">
    <div class="card card-shadow">
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'id' => 'post-form',
                'action' => ['post/create'],
                'method' => 'post',
                'options' => ['enctype' => 'multipart/form-data']
            ]); ?>

            <?= $form->field($modelPostForm, 'title')->textInput(['autofocus' => true]) ?>

            <?= $form->field($modelPostForm, 'content')->textarea(['rows' => 6]) ?>

            <?= $form->field($modelPostForm, 'image_file')->fileInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Criar', ['class' => 'btn btn-primary', 'name' => 'post-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>