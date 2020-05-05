<?php

ob_start();

// Page accessible aux administrateurs (1) uniquement, les modérateurs (0) sont redirigés vers le tableau de bord
if ($sessionAdmin == 0) {
    header("Location:index.php?url=dashboard");
} ?>


<!--ferme la div de la page index.php qui bloque l'image de dépasser du cadre prédéfini-->
</div>

<div class="parallax-container">
    <div class="parallax">
        <img src="Public/img/posts/<?= $post->image ?>" alt="<?= $post->title ?>">
    </div>
</div>


<!--réouvre la div de la page index.php fermé plus haut-->
<div class="container">

    <?php

    // Affiche l'article qu'il soit publié ou non
    if (isset($_POST['submit'])) {
        $title = trim($_POST['title']);
        $content = $_POST['content'];
        $posted = isset($_POST['public']) ? "1" : "0";
        $errors = [];

        // Affiche un message d'erreur si l'un des champs est vide (titre ou contenu)
        if (empty($title) || empty($content)) {
            $errors['empty'] = "Veuillez remplir tous les champs";
        }


        // Vérifier si une image a été saisie, sinon ce sera l'image par défaut définie en BDD
        if (!empty($_FILES['image']['name'])) {
            $file = $_FILES['image']['name'];
            $extensions = ['.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF'];


            // Récupère l'extension du fichier
            $extension = strrchr($file, '.');


            // Vérifie si l'extension du fichier sélectionné est dans le tableau extensions
            if (!in_array($extension, $extensions)) {
                $errors['image'] = "Cette image n'est pas valide (formats acceptées : .png, .jpg, .jpeg, .gif, .png, .jpg, .jpeg, .gif)";
            }
        } else {
        }

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


    <form action="index.php?url=saverewritepost&id=<?= $post->id ?>" enctype="multipart/form-data" method="post">
        <div class="row">

            <div class="input-field col s12">
                <input type="text" name="title" id="title" value="<?= $post->title ?>" />
                <label for="title">Titre de l'article</label>
            </div>

            <div class="input-field col s12">
                <textarea id="content" name="content"><?= $post->content ?></textarea>
            </div>

            <div class="file-field input-field col s12">
                <div class="btn">
                    <span>Modifier l'image</span>
                    <input type="file" name="image">
                </div>
            </div>

            <div class="col s6">
                <p>Public</p>
                <div class="switch">
                    <label>
                        Non
                        <input type="checkbox" name="public" <?php echo ($post->posted == "1") ? "checked" : "" ?> />
                        <span class="lever"></span>
                        Oui
                    </label>
                </div>
            </div>

            <div class="col s6 right-align">
                <br><br>
                <button class="btn" type="submit" name="post">Modifier l'article</button>
            </div>


        </div>


    </form>

    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>