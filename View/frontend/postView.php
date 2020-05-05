<?php ob_start();

// Vérifie que la requête a renvoyé quelque chose

if ($post == false) {
    header("Location:index.php?url=error");
} else {
?>

    <!--ferme la div de la page index.php qui bloque l'image de dépasser du cadre prédéfini-->
    </div>

    <div class="parallax-container">
        <div class="parallax">
            <img src="Public/img/posts/<?= $post->image ?>" alt="<?= $post->title ?>">
        </div>
    </div>


    <!--réouvre la div de la page index.php fermé plus haut-->
    <div class="container">

        <h2><?= $post->title ?></h2>
        <h6 class="grey-text text-darken-1">Publié le <?= date("d/m/Y", strtotime($post->date)) ?></h6>
        <p><?= nl2br($post->content) ?></p>

    <?php
}
    ?>

    <hr>

    <h5 class="center-align">Commentaires</h5>
    <?php

    if ($responses != false) {
        foreach ($responses as $response) {
    ?>
            <blockquote>
                <strong><?= $response->name ?>, le <?= date("d/m/Y", strtotime($response->date)) ?></strong>
                <p><?= nl2br($response->comment) ?></p>
                <a href="index.php?url=warning&id=<?= $response->post_id ?>&idcom=<?= $response->id ?>">Signaler ce commentaire</a>
            </blockquote>

    <?php
        }
    } else echo "Soyez le premier à commenter cet article !"
    ?>

    <h5 class="center-align">Ajouter un commentaire</h5>

    <?php
    if (isset($_POST['submit'])) {

        // Trim supprime l'espace avant le mot 
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $comment = htmlspecialchars(trim($_POST['comment']));

        // Stocke les erreurs dans un tableau pour pouvoir les afficher
        $errors = [];

        // Vérifie que les champs ont bien été complétés
        if (empty($name) || empty($email) || empty($comment)) {
            $errors['empty'] = "Tous les champs n'ont pas été remplis";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "L'adresse email n'est pas valide";
            }
        }

        // Affiche les erreurs si existantes
        if (!empty($errors)) {
    ?>
            <div class="card red">
                <div class="card-content white-text">
                    <?php
                    foreach ($errors as $error) {
                        echo $error . "<br/>";
                    }

                    ?>
                </div>
            </div>
    <?php
        }
    }



    ?>

    <form action="index.php?url=addComment&id=<?= $post->id ?>" method="post">

        <div class="row">

            <div class="input-field col s12 m6">
                <input type="text" name="name" id="name">
                <label for="name">Nom</label>
            </div>

            <div class="input-field col s12 m6">
                <input type="email" name="email" id="email">
                <label for="email">Adresse email</label>
            </div>

            <div class="input-field col s12">
                <textarea name="comment" id="comment" class="materialize-textarea"></textarea>
                <label for="comment">Commentaire</label>
            </div>

            <div class="col s12">
                <button type="submit" name="submit" class="btn waves-effect">
                    Commenter ce post
                </button>
            </div>

        </div>

    </form>

    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>