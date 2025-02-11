<div class="card" style="width: 100%;">
    <div class="card-shadow">
        <img src="https://images.pexels.com/photos/268941/pexels-photo-268941.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
            class="card-img-top profile-cover"
            alt="...">
        <img src="<?= Yii::getAlias('@showAvatar/') . "{$profilePhoto}"; ?>"
            class="card-img-top profile-img"
            alt="...">
    </div>
</div>

<div class="container mt-5">
    <div class="card-body">
        <figure class="text-start">
            <blockquote class="blockquote">
                <p><?= $user->username; ?>#<?= $user->id; ?></p>
            </blockquote>
            <?php if ($profile): ?>
                <figcaption class="blockquote-footer">
                    <?= "{$profile->age} anos | {$profile->bio}"; ?> <cite title="Source Title">Bio</cite>
                </figcaption>
            <?php endif; ?>
        </figure>
    </div>
</div>

<?php foreach ($posts as $post): ?>
    <div class="card mb-3" style="width: 100%;">
        <div class="row g-0">
            <div class="col-md-4">
                <?php foreach ($post->images as $image): ?>
                    <img src="<?= Yii::getAlias('@showImage/') . "{$image->name}.{$image->extension}"; ?>"
                        class="img-fluid rounded-start"
                        alt="...">
                <?php endforeach; ?>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $post->title; ?></h5>
                    <p class="card-text"><?= $post->content; ?></p>
                    <p class="card-text">
                        <small class="text-body-secondary">
                            Publicado em: <?= date('d/m/Y h:m', strtotime($post->created_at)); ?>
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>