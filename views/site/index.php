<?php

/** @var yii\web\View $this */

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="container">

        <div class="row mb-3">
            <h1 class="display-1"><?= Yii::$app->name; ?></h1>
        </div>

        <?php if ($lastPost): ?>
            <?= $this->render('../layouts/partials/_card_principal', compact('lastPost')) ?>
        <?php else: ?>
            <h3>Não há publicações no blog!</h3>
        <?php endif; ?>

        <?php if ($posts): ?>
            <div class="row">
                <?= $this->render('../layouts/partials/_card_secondary', compact('posts')) ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->render(
    '../layouts/partials/_create_post_modal',
    compact('modelPostForm')
); ?>