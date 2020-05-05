<?php

// Chargement des classes
require_once('Model/PostManager.php');
require_once('Model/CommentManager.php');


// Page d'accueil
function home()
{
    $postManager = new PostManager();
    $lastpost = $postManager->get_lastpost();
    $firstpost = $postManager->get_firstpost();

    require('View/frontend/home.php');
}


// Page d'erreur
function error()
{
    require('View/frontend/error.php');
}


// Page de biographie
function biography()
{
    require('View/frontend/biography.php');
}



// Récupère les articles publiés
function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->get_posts();

    require('View/frontend/listPostView.php');
}


// Récupère un article et ses commentaires 
function post()
{
    $commentManager = new CommentManager();
    $postManager = new PostManager();

    $post = $postManager->get_post();
    $responses = $commentManager->get_comments();

    require('View/frontend/postView.php');
}


// Ajouter un commentaire
function addComment($name, $email, $comment, $postId)
{
    $commentManager = new CommentManager();

    $comment = $commentManager->postComment($name, $email, $comment, $postId);
}

// Supprime un commentaire
function Warning_Comment($id)
{
    $commentManager = new CommentManager();
    $Warningcomments = $commentManager->WarningComment($id);
}

// Page des romans publiés
function publishedBooks()
{
    require('View/frontend/books.php');
}


// Page de mentions légales
function legal()
{
    require('View/frontend/legal.php');
}
