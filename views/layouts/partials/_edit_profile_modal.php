<?php

use yii\bootstrap5\{
    ActiveForm,
    Html
};
?>

<button type="button" class="btn-create-post" data-bs-toggle="modal" data-bs-target="#createPostModal">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
    </svg>
</button>

<div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createPostModalLabel">Editar perfil</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php $form = ActiveForm::begin([
                'id' => 'post-form',
                'action' => ['profile/edit'],
                'method' => 'post',
                'options' => ['enctype' => 'multipart/form-data']
            ]); ?>
            <div class="modal-body">

                <?= $form->field($modelProfileForm, 'age')->textInput(['autofocus' => true]) ?>

                <?= $form->field($modelProfileForm, 'gender')->textInput() ?>

                <?= $form->field($modelProfileForm, 'bio')->textarea(['rows' => 6]) ?>

                <?= $form->field($modelProfileForm, 'image_file')->fileInput() ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary', 'name' => 'post-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>