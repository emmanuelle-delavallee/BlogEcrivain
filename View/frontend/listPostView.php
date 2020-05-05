<?php ob_start(); ?>

<h2 class="center-align">Billet simple pour l'Alaska</h2>

<?php

foreach ($posts as $post) {
?>

    <div class="row">

        <div class="col s12">
            <h4><?= $post->title ?></h4>

            <div class="row">
                <div class="col s12 m12 l8">
                    <p><?= substr($post->content, 0, 900) ?> [...]</p>
                    <a class="right" href="index.php?url=post&id=<?= $post->id ?>" id="excerpt-read">Lire la suite du chapitre</a>
                </div>

                <div class="col s12 m12 l4">
                    <img src="Public/img/posts/<?= $post->image ?>" class="materialboxed responsive-img" alt="<?= $post->title ?>">
                </div>
            </div>
        </div>
    </div>


<?php
}

$content = ob_get_clean();

require('template.php'); ?>