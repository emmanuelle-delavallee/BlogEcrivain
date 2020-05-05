<?php

ob_start();

// Page accessible aux administrateurs (1) uniquement, les modérateurs (0) sont redirigés vers le tableau de bord
if ($sessionAdmin == 0) {
    header("Location:index.php?url=dashboard");
} ?>

<div class="fixed-action-btn">
    <a class="btn-floating btn-large" href="index.php?url=write">
        <i class="large material-icons">mode_edit</i>
    </a>
</div>


<h2 id="dashboard-title">Chapitres publiés</h2>


<div class="col s12 m12 l12">
    <a class="btn waves-effect waves-light right" href="index.php?url=listallposts">Afficher les brouillons</a>
</div>


<?php

foreach ($allPosts as $post) {
?>

    <div class="row">

        <div class="col s12">
            <h4 id="dashboard-subtitle"><?= $post->title ?><?php echo ($post->posted == "0") ? "<i class='material-icons'>lock</i>" : "" ?></h4>

            <div class="row">
                <div class="col s12 m12 l8">
                    <p><?= substr($post->content, 0, 900) ?> [...]</p>
                    <a class="btn waves-effect waves-light" href="index.php?url=rewritepost&id=<?= $post->id ?>">Modifier</a>

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