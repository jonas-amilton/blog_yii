<?php

/** @var yii\web\View $this */

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="container">

        <div class="row mb-3">
            <h1 class="display-1"><?= Yii::$app->name; ?></h1>
        </div>

        <?= $this->render('../layouts/partials/_card_principal', compact('lastPost')) ?>

        <div class="row">
            <?= $this->render('../layouts/partials/_card_secondary', compact('posts')) ?>
        </div>
    </div>

</div>