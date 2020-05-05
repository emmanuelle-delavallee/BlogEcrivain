// FRONTEND

$(document).ready(function () {
  $(".sidenav").sidenav(); // Menu latéral
  $(".materialboxed").materialbox(); // Zoom des images
  $("select").formSelect(); // Utilisation de select dans les formulaires
  $(".parallax").parallax(); // Parallax pour les images des chapitres
  $(".fixed-action-btn").floatingActionButton(); // Bouton flottant pour écrire un article (admin)
});

// Tiny MCE
tinymce.init({
  selector: "textarea#content",
  plugins: "autoresize", // Ajuste la dimension de l'éditeur à la taille du texte saisi
});

// BACKEND
$(document).ready(function () {
  // Lance le modal de lecture des commentaires
  $(".modal").modal();
});
