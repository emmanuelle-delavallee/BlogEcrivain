<!DOCTYPE html>
<html lang="fr">

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="Public/css/materialize.css" media="screen" />
    <link type="text/css" rel="stylesheet" href="Public/css/style.css" media="screen" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog de Jean Forteroche</title>
</head>

<body>


    <?php require('topbar.php'); ?>


    <!-- Container de la page, contrôle la largeur occupée-->
    <div class="container">
        <?= $content ?>
    </div>


    <?php require('botbar.php'); ?>


    <!--JavaScript at end of body for optimized loading-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="Public/js/materialize.js.js"></script>
    <script src="Public/js/script.js"></script>

</body>

</html>