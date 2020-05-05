<?php ob_start();

// Page accessible aux administrateurs et modérateurs qui ont une session active
if ($sessionAdminOrModo == 0) {
    header("Location:index.php?url=login");
} ?>


<h2 id="dashboard-title">Tableau de bord</h2>

<div class="row">

    <?php

    // Affiche le nom des tables et le nombre d'entrées de chacune des tables

    $i = 0;

    foreach ($tables as $table_name => $table) {
    ?>

        <div class="col l4 m4 s12">
            <div class="card">
                <div class="card-content teal white-text center">

                    <span class="card_title"><?= $table_name ?></span>

                    <h4 id="dashboard-subtitle"><?= $nbrInTable[$i]; ?></h4>

                </div>
            </div>
        </div>

    <?php
        $i = $i + 1;
    }

    ?>

</div>


<h4 id="dashboard-subtitle">Commentaires non lus</h4>


<table class="responsive-table">
    <thead>
        <tr>
            <th>Article</th>
            <th>Commentaire</th>
            <th>Actions</th>
        </tr>
    <tbody>
        <?php
        if (!empty($comments)) {
            foreach ($comments as $comment) {

        ?>

                <tr id="commentaire_<?= $comment->id ?>">

                    <td>
                        <?= $comment->title ?>
                    </td>
                    <td>
                        <?php if ($comment->seen == '2') { ?>

                            <span class="red-text"> <strong>
                                <?php   } ?>
                                <?= substr($comment->comment, 0, 100); ?> [...]
                                <?php if ($comment->seen == '2') { ?>
                                </strong>
                            </span>

                        <?php   } ?>
                    </td>
                    <td>
                        <a href="#comment_<?= $comment->id ?>" class="btn-floating btn-small waves-effect waves-light blue modal-trigger" id="dashboard-btn"><i class="material-icons">add</i></a>
                        <a href="index.php?url=seecomment&id= <?= $comment->id ?>" id="<?= $comment->id ?>" class="btn-floating btn-small waves-effect waves-light green see_comment"><i class="material-icons">done</i></a>
                        <a href="index.php?url=delete&id= <?= $comment->id ?>" id="<?= $comment->id ?>" class="btn-floating btn-small waves-effect waves-light red delete_comment"><i class="material-icons">delete</i></a>

                        <div class="modal" id="comment_<?= $comment->id ?>">
                            <div class="modal-content">
                                <h4><?= $comment->title ?></h4>
                                <p>Commentaire posté par
                                    <strong><?= $comment->name . " (" . $comment->email . ")</strong><br/>Le " . date("d/m/Y à H:i", strtotime($comment->date)) ?>
                                </p>
                                <hr>
                                <p> <?= nl2br($comment->comment) ?></p>
                            </div>

                            <div class="modal-footer">
                                <a href="index.php?url=delete&id= <?= $comment->id ?>" class="modal-action modal-close waves-effect waves-red btn-flat delete_comment"><i class="material-icons">delete</i></a>
                                <a href="index.php?url=seecomment&id= <?= $comment->id ?>" id="<?= $comment->id ?>" class="modal-action modal-close waves-effect waves-green btn-flat see_comment"><i class="material-icons">done</i></a>
                            </div>
                        </div>

                    </td>

                </tr>

            <?php
            }
        } else {
            ?>
            <tr>
                <td></td>
                <td>Aucun commentaire à valider</td>
            </tr>


        <?php
        }
        ?>

    </tbody>
    </thead>
</table>

<?php

$content = ob_get_clean();

require('template.php');
