<!DOCTYPE html>
<html lang="fr">

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="public/css/materialize.css" media="screen" />
    <link type="text/css" rel="stylesheet" href="public/css/style.css" media="screen" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog de Jean Forteroche | Administration</title>
    <!-- script Tiny MCE -->
    <script src="https://cdn.tiny.cloud/1/uyeoghl01lu3t6kcxu1ju9owd3zx3vjwrusqd921xm809lf6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

</head>


<body>


    <?php require('topbar.php'); ?>




    <!-- Container de la page, contrôle la largeur occupée-->
    <div class="container">
        <?= $content ?>
    </div>




    <!--JavaScript at end of body for optimized loading-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> <!-- à supprimer ? -->
    <script src="public/js/materialize.js"></script>
    <script src="public/js/script.js"></script>


</body>

</html>