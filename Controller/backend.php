<?php


// Chargement des classes
require_once('Model/AdminManager.php');
require_once('Model/CommentManager.php');
require_once('Model/PostManager.php');



// Vérifie la connection de l'admin/modo
function checkLogin($email, $password)
{
    $adminManager = new AdminManager();

    $checkLogin = $adminManager->checkAdmin($email, $password);

    return $checkLogin;
}



// Login de l'admin/modo
function login()
{
    $adminManager = new AdminManager();

    $sessionAdminOrModo = $adminManager->adminOrModo();

    require('View/backend/login.php');
}



// Affiche le tableau de bord de l'admin/modo
function dashboard()
{
    $adminManager = new AdminManager();
    $commentManager = new CommentManager();

    // Récupère les tables existantes
    $tables = [
        "Publications"      =>  "posts",
        "Commentaires"      =>  "comments",
        "Administrateurs"   =>  "admin"
    ];

    $i = 0;

    foreach ($tables as $table_name => $table) {

        $nbrInTable[$i] = $commentManager->inTable($table);

        $i = $i + 1;
    }

    // Affiche le tableau de bord de l'admin/modo
    $comments = $commentManager->getUnreadComments();
    $sessionAdminOrModo = $adminManager->adminOrModo();

    require('View/backend/dashboard.php');
}



// Supprime un commentaire
function deleteComment($id)
{
    $commentManager = new CommentManager();
    $delcomments = $commentManager->delComment($id);
}



// Valide un commentaire
function seeComment($id)
{
    $commentManager = new CommentManager();
    $viewcomments = $commentManager->viewComment($id);
}



// Ecrire un nouvel article
function writePost($title, $content, $posted, $tmp_name, $extension)
{
    $postManager = new PostManager();
    $post = $postManager->createPost($title, $content, $posted);
    if (!empty($tmp_name) && !empty($extension)) {

        $img = $postManager->postImg($tmp_name, $extension);
    }
}


// Ecrire un nouvel article
function write()
{
    $adminManager = new AdminManager();

    $sessionAdmin = $adminManager->admin();
    require('View/backend/write.php');
}


// Récupère tous les articles (publiés/non publiés)
function listAllPosts()
{
    $postManager = new PostManager();
    $adminManager = new AdminManager();

    unset($allPosts);
    $allPosts = $postManager->getAllPosts();
    $sessionAdmin = $adminManager->admin();

    require('View/backend/listAll.php');
}


// Récupère tous les articles publiés
function getPublishedPosts()
{
    $postManager = new PostManager();
    $adminManager = new AdminManager();
    unset($allPosts);
    $allPosts = $postManager->get_posts();
    $sessionAdmin = $adminManager->admin();

    require('View/backend/list.php');
}


// Récupère un article (publié/non publié)
function rewritePost()
{
    $postManager = new PostManager();
    $adminManager = new AdminManager();

    $post = $postManager->getAPost();
    $sessionAdmin = $adminManager->admin();

    require('View/backend/post.php');
}



// Modifie un article (publié/non publié)
function editPost($title, $content, $posted, $id, $tmp_name, $extension)
{
    $postManager = new PostManager();

    $edit = $postManager->edit($title, $content, $posted, $id);


    if (!empty($tmp_name) && !empty($extension)) {

        $img = $postManager->editpostImg($id, $tmp_name, $extension);
    }
}


// Supprime un article
function deletePost($id)
{
    $postManager = new PostManager();
    $del = $postManager->delpost($id);
}



// Récupère les modérateurs
function getAllModos()
{
    $adminManager = new AdminManager();

    $modos = $adminManager->getModos();
    $sessionAdmin = $adminManager->admin();

    require('View/backend/settings.php');
}


// Ajoute un modérateur

function addNewModo($name, $email, $role, $password)
{
    $adminManager = new AdminManager();

    $modo = $adminManager->addModo($name, $email, $role, $password);
}


// Supprime un modérateur

function deleteAModo($id)
{
    $adminManager = new AdminManager();

    $delmodo = $adminManager->delModo($id);
}
