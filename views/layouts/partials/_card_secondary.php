<?php

use yii\helpers\Url;
?>

<?php foreach ($posts as $post): ?>
    <?php if (isset($post)): ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
            <div class="card card-border-none" style="width: 100%;">
                <?php foreach ($post->images as $image): ?>
                    <img
                        src="<?= Yii::getAlias('@showImage') . "{$image->name}.{$image->extension}"; ?>"
                        class="card-img-top"
                        alt="<?= 'Imagem de ' . $post->title; ?>">
                <?php endforeach; ?>
                <div class="card-body">
                    <p class="text-body-secondary">
                        Publicado por <a href="<?= Url::to([
                                                    'profile/user',
                                                    'id' => $post->user->id
                                                ]); ?>" class="text-reset"><?= $post->user->username; ?></a>.
                    </p>
                    <p class="card-text">
                        <small class="text-body-secondary">
                            Publicado em: <?= date('d/m/Y h:m', strtotime($post->created_at)); ?>
                        </small>
                    </p>
                    <h5 class="card-title"><?= $post->title; ?></h5>
                    <p class="card-text"><?= $post->content; ?></p>
                </div>
                <?= $this->render('./_btn_delete', ['id' => $post->id, 'userId' => $post->user->id]); ?>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>