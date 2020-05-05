<?php ob_start();


// Déconnecte la session en cours
unset($_SESSION['admin']);
header("Location:../");


$content = ob_get_clean();
