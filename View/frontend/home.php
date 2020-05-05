<?php ob_start(); ?>

</div>

<div class="iris">

    <div class="section white z-depth-5 home-cards center-align" id="iris-txt">

        <h2 class="black-text" id="iris-title-1">Billet simple pour l'Alaska</h2>
        <h3 class="black-text" id="iris-title-2">Le nouveau roman de Jean Forteroche</h3>
        <h4 id="iris-subtitle">Découvrez un nouveau chapitre en ligne chaque semaine</h4>

    </div>


    <div class="row" id="essai">

        <div class="section transparent col s12 m12 l12" id="iris-txt-2">

            <?php
            foreach ($firstpost as $post) {
            ?>
                <div class="col s10 m8 l6">

                    <div class="card-panel white z-depth-5 home-cards">

                        <h5 class="grey-text text-darken-4 center-align">Première publication : <?= $post->title ?></h5>

                        <p class="grey-text text-darken-1">Publié le <?= date("d/m/Y", strtotime($post->date)); ?></p>

                        <div class="card-content">
                            <p><?= substr($post->content, 0, 350); ?> [...]</p>
                        </div>

                        <p class="center-align"><a href="index.php?url=post&id=<?= $post->id ?>">Lire le chapitre complet</a></p>

                    </div>
                </div>
        </div>
    <?php
            }
    ?>
    <?php
    foreach ($lastpost as $post) {
    ?>
        <div class="col s10 m8 l6 right">

            <div class="card-panel white z-depth-5 home-cards">

                <h5 class="grey-text text-darken-4 center-align">Publication récente : <?= $post->title ?></h5>

                <p class="grey-text text-darken-1">Publié le <?= date("d/m/Y", strtotime($post->date)); ?></p>

                <div class="card-content">
                    <p><?= substr($post->content, 0, 350); ?> [...]</p>
                </div>

                <p class="center-align"><a href="index.php?url=post&id=<?= $post->id ?>">Lire le chapitre complet</a></p>

            </div>
        </div>
    </div>



<?php
    }
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>