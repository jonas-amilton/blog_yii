<div class="card card-border-none mb-3" style="max-width: 100%;">
    <div class="row g-0">
        <div class="col-md-4">
            <?php foreach ($lastPost->images as $image): ?>
                <img
                src="<?= Yii::getAlias('@showImage/') . "{$image->name}.{$image->extension}"; ?>"
                class="img-fluid rounded-start"
                alt="<?= 'Imagem de ' . $lastPost->title; ?>">
            <?php endforeach; ?>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h3 class="display-1"><?= $lastPost->title; ?></h3>
                <p class="card-text"><?= $lastPost->content; ?></p>
                <p class="text-body-secondary">
                    <!--TODO: colocar link do perfil do usuário que publicou-->
                    Publicado por <a href="#" class="text-reset">nome do usuário <?= $lastPost->user_id; ?></a>.
                </p>
                <p class="card-text">
                    <small class="text-body-secondary">
                        Publicado em: <?= date('d/m/Y h:m', strtotime($lastPost->created_at)); ?>
                    </small>
                </p>
            </div>
        </div>
    </div>
</div>