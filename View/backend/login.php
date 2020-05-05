<?php

ob_start();

// S'il y a une session active, redirige vers le tableau de bord
if ($sessionAdminOrModo == 1) {
    header("Location:index.php?url=dashboard");
}
?>



<div class="row">

    <div class="col l4 m6 s12 offset-l4 offset-m3">

        <div class="card-panel">

            <div class="row">

                <div class="col s6 offset-s3">
                    <img src="Public/img/admin.png" alt="administrateur" width="100%">
                </div>

            </div>

            <h4 class="center-align">Se connecter</h4>


            <?php
            if (isset($_POST['submit'])) {
                // htmlspecialchars : l'utilisateur ne peut pas saisir de code HTML dans le champs ; trim : supprime les espaces de début et de fin
                $email = htmlspecialchars(trim($_POST['email']));
                $password = htmlspecialchars(trim($_POST['password']));

                //tableau qui permet de stocker les erreursà la connection
                $errors = [];

                // Vérifie que les champs ont été remplis 
                if (empty($email) || empty($password)) {
                    $errors['empty'] = "Tous les champs n'ont pas été compétés";
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








            <form action="index.php?url=checklogin" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="email" id="email" name="email">
                        <label for="email">Adresse email</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input type="password" id="password" name="password">
                        <label for="password">Mot de passe</label>
                    </div>
                </div>


                <!-- à centrer ? -->
                <button type="submit" name="submit" class="waves-effect waves-light btn light-green">
                    <i class="material-icons left">perm_identity</i>
                    Se connecter
                </button>

            </form>

        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>