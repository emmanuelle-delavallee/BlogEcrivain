<?php

ob_start();

// Page accessible aux administrateurs (1) uniquement, les modérateurs (0) sont redirigés vers le tableau de bord
if ($sessionAdmin == 0) {
    header("Location:index.php?url=dashboard");
} ?>


<h2>Paramètres</h2>

<div class="row">

    <div class="col s12 m12 ">

        <h4>Modérateurs</h4>

        <table class="responsive-table">

            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th></th>
                </tr>
            </thead>



            <tbody>

                <?php
                foreach ($modos as $modo) {
                ?>

                    <tr>
                        <td><?= $modo->name ?></td>
                        <td><?= $modo->email ?></td>
                        <td><?= $modo->role ?></td>
                        <td><a href="index.php?url=deleteModo&id= <?= $modo->id ?>" id="<?= $modo->id ?>" class="btn-floating btn-small waves-effect waves-light delete_comment"><i class="material-icons">delete</i></a></td>
                    </tr>

                <?php
                }
                ?>
            </tbody>

        </table>

    </div>


    <div class="col s12 m12 l6 offset-l3">
        <h4>Ajouter un modérateur</h4>

        <?php
        if (isset($_POST['submit'])) {

            $name = htmlspecialchars(trim($_POST['name']));
            $email = htmlspecialchars(trim($_POST['email']));
            $repeat_email = htmlspecialchars(trim($_POST['repeat_email']));
            $role = htmlspecialchars(trim($_POST['role']));
            $password = htmlspecialchars(trim($_POST['password']));
            $repeat_password = htmlspecialchars(trim($_POST['repeat_password']));

            $errors = [];


            // Vérifie que tous les champs ont été complétés
            if (empty($name) || empty($email) || empty($repeat_email) || empty($password) || empty($repeat_password)) {
                $errors['empty'] = "Veuillez remplir tous les champs";
            }


            // Vérifie que les deux adresses email saisies soient identiques
            if ($email != $repeat_email) {
                $errors['different'] = "Les adresses email ne correspondent pas";
            }


            // Vérifie que les deux mots de passe saisis soient identiques
            if ($password != $repeat_password) {
                $errors['different_MDP'] = "Les mots de passe ne correspondent pas";
            }

            // Affiche les erreurs s'il y en a
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


        <!-- Formulaire d'inscription d'un nouvel admin/modo -->
        <form action="index.php?url=savesettings" method="post">
            <div class="row">
                <div class="input-field col s12 m12 l12">
                    <input type="text" name="name" id="name">
                    <label for="name">Nom</label>
                </div>


                <div class="input-field col s12 m12 l12">
                    <input type="email" name="email" id="email">
                    <label for="email">Adresse email</label>
                </div>

                <div class="input-field col s12 m12 l12">
                    <input type="email" name="repeat_email" id="repeat_email">
                    <label for="repeat_email">Répéter l'adresse email</label>
                </div>

                <div class="input-field col s12 l6">
                    <input type="password" name="password" id="password">
                    <label for="password">Mot de passe</label>
                </div>

                <div class="input-field col s12 l6">
                    <input type="password" name="repeat_password" id="repeat_password">
                    <label for="repeat_password">Répéter le mot de passe</label>
                </div>


                <div class="input-field col s12 l6">
                    <select class="col l12" name="role" id="role">
                        <option value="modo">Modérateur</option>
                        <option value="admin">Administrateur</option>
                    </select>
                    <label for="role">Rôle :</label>
                </div>


                <div class="col s12 l6 center-align">
                    <button type="submit" name="submit" class="btn valign-wrapper">Ajouter</button>
                </div>
            </div>

        </form>
    </div>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>