<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
?>


<div class="container">
    <div class="card card-shadow">
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'id' => 'post-form',
                'action' => ['post/create-post'],
                'method' => 'post',
            ]); ?>

            <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'post-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>