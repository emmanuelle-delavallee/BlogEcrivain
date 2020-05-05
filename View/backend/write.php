<?php

ob_start();

// Page accessible aux administrateurs (1) uniquement, les modérateurs (0) sont redirigés vers le tableau de bord
if ($sessionAdmin == 0) {
    header("Location:index.php?url=dashboard");
} ?>


<h2 id="dashboard-title">Rédiger un chapitre</h2>

<?php

if (isset($_POST['title']) ||  isset($_POST['content'])) {
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));

    $errors = [];


    // Vérifie si les champs titre et contenu ont été complétés
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

    // Affiche les erreurs s'il y en a, sinon upload et redirige vers l'article publié
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


<!--Enctype : pour pouvoir publier des images-->
<form action="index.php?url=writepost" method="post" enctype="multipart/form-data" class="col s12">

    <div class="row">

        <div class="input-field col s12">
            <input type="text" name="title" id="title">
            <label for="title">Titre du chapitre</label>
        </div>

        <div class="input-field col s12">
            <textarea name="content" id="content"></textarea>
        </div>


        <div class="file-field input-field col s12">
            <div class="btn">
                <span>Ajouter une image</span>
                <input type="file" name="image">
            </div>
        </div>


        <div class="col s6">
            <p>Public</p>
            <div class="switch">
                <label>
                    Non
                    <input type="checkbox" name="public" id="public">
                    <span class="lever"></span>
                    Oui
                </label>
            </div>
        </div>


        <div class="col s6 right-align">
            <br><br>
            <button class="btn" type="submit" name="post">Publier</button>
        </div>

    </div>

</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>