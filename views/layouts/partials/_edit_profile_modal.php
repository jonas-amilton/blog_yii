<?php

use yii\bootstrap5\{
    ActiveForm,
    Html
};
?>

<button type="button" class="btn-fixed btn-edit-profile" data-bs-toggle="modal" data-bs-target="#createPostModal">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
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

                <?= $form->field($modelProfileForm, 'age')->input(
                    'number',
                    [
                        'min' => 16,
                        'max' => 99,
                        'autofocus' => true,
                        'value' => $profile->age ?? null
                    ]
                ) ?>

                <?= $form->field($modelProfileForm, 'gender')->dropDownList([
                    'M' => 'Masculino',
                    'F' => 'Feminino',
                ], [
                    'prompt' => 'Selecione seu sexo',
                    'value' => $profile->gender ?? null
                ]) ?>

                <?= $form->field($modelProfileForm, 'bio')->textarea([
                    'rows' => 6,
                    'value' => $profile->bio
                ]) ?>

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