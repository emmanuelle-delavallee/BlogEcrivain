<?php
session_start();
require('Controller/frontend.php');
require('Controller/backend.php');


try {
    // Si URL existe
    if (isset($_GET['url'])) {

        // Selon l'URL 
        switch ($_GET['url']) {


                // Affiche la page de biographie
            case 'biography':
                biography();
                break;



                // Afficher la liste des articles publiés
            case 'listPosts':
                listPosts();
                break;



                // Afficher un article
            case 'post':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    post();
                } else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
                break;


                // Alerter un commentaire 
            case 'warning':
                if (isset($_GET['idcom']) && $_GET['idcom'] > 0) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        Warning_Comment($_GET['idcom']);
                        post();
                    } else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                } else {
                    throw new Exception('Aucun identifiant de commentaire envoyé');
                }
                break;



                // Si URL = à addComment, regarde s'il y a un id (article), contrôle que les variables ne soient pas vides, ajoute le commentaire, affiche l'article et le commentaire posté
            case 'addComment':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['comment'])) {
                        addComment($_POST['name'], $_POST['email'], $_POST['comment'], $_GET['id']);
                        post();
                    } else {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                } else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
                break;



                // Affiche la page des livres publiés
            case 'books':
                publishedBooks();
                break;


                // Affiche la page des mentions légales
            case 'legal':
                legal();
                break;


                // Afficher la page login (admin/modo)
            case 'login':
                login();
                break;



                // Si URL = checklogin, vérifie que les champs ne soient pas vides, s'ils sont valides : dashboard, sinon page login
            case 'checklogin':
                if (!empty($_POST['email']) && !empty($_POST['password'])) {
                    if (checkLogin($_POST['email'], $_POST['password']) == 1) {
                        $_SESSION['admin'] = $_POST['email'];

                        dashboard();
                    } else {
                        login();
                    }
                } else {
                    login();
                }
                break;



                // Afficher la page de tableau de bord
            case 'dashboard':
                dashboard();
                break;



                // Supprimer un commentaire publié
            case 'delete':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    deleteComment($_GET['id']);
                    dashboard();
                } else {
                    throw new Exception('Aucun identifiant de commentaire envoyé');
                }
                break;



                // Valider la publication d'un commentaire
            case 'seecomment':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    seeComment($_GET['id']);
                    dashboard();
                } else {
                    throw new Exception('Aucun identifiant de commentaire envoyé');
                }
                break;



                // Afficher la page d'écriture d'un nouvel article
            case 'write':
                write();
                break;



                // Envoyer le nouvel article en base
            case 'writepost':
                if (isset($_POST['title']) && isset($_POST['content'])) {
                    if (!empty($_POST['title']) && !empty($_POST['content'])) {


                        $image =  isset($_FILES['image']['name']) ?  $_FILES['image']['name'] : '';

                        if (!empty($image)) {

                            $extensions = ['.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF'];


                            // Récupère l'extension du fichier
                            $extension = strrchr($image, '.');


                            // Vérifie si l'extension du fichier sélectionné est dans le tableau extensions
                            if (!in_array($extension, $extensions)) {
                                write();
                            } else {
                                writePost($_POST['title'], $_POST['content'], isset($_POST['public']) ? "1" : "0", $_FILES['image']['tmp_name'], $extension);
                                listAllPosts();
                            }
                        } else {
                            writePost($_POST['title'], $_POST['content'], isset($_POST['public']) ? "1" : "0", '', '');
                            listAllPosts();
                        }
                    } else {
                        write();
                    }
                }

                break;



                // Afficher tous les articles (publiés/non publiés)
            case 'listallposts':
                listAllPosts();
                break;


                // Afficher tous les articles publiés (back)
            case 'allpublishedposts':
                getPublishedPosts();
                break;


                // Afficher la page de modification d'un article 
            case 'rewritepost':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    rewritePost();
                } else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
                break;


                // supprimer un article 
            case 'deletepost':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    deletePost($_GET['id']);
                    listAllPosts();
                } else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
                break;


                // Sauvegarder un article modifié
            case 'saverewritepost':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    }


                    if (!empty($_POST['title']) && !empty($_POST['content'])) {


                        $image =  isset($_FILES['image']['name']) ?  $_FILES['image']['name'] : '';

                        if (!empty($image)) {

                            $extensions = ['.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF'];


                            // Récupère l'extension du fichier
                            $extension = strrchr($image, '.');


                            // Vérifie si l'extension du fichier sélectionné est dans le tableau extensions
                            if (!in_array($extension, $extensions)) {
                                rewritePost();
                            } else {
                                editPost($_POST['title'], $_POST['content'], isset($_POST['public']) ? "1" : "0", $_GET['id'], $_FILES['image']['tmp_name'], $extension);
                                listAllPosts();
                            }
                        } else {
                            editPost($_POST['title'], $_POST['content'], isset($_POST['public']) ? "1" : "0", $_GET['id'], '', '');
                            listAllPosts();
                        }
                    } else {
                        rewritePost();
                    }
                } else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }

                break;



                // Page qui affiche les admins et modérateurs, et premet à un admin d'en ajouter
            case 'settings':
                getAllModos();
                break;



                // Ajouter un nouvel administrateur ou modérateur 
            case 'savesettings':
                if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['repeat_email']) && !empty($_POST['role']) && !empty($_POST['password']) && !empty($_POST['repeat_password'])) {
                    if ($_POST['email'] == $_POST['repeat_email'] && $_POST['password'] == $_POST['repeat_password']) {
                        addNewModo($_POST['name'], $_POST['email'], $_POST['role'], $_POST['password']);
                    }
                }
                getAllModos();
                break;


                // Supprimer un admin/modérateur
            case 'deleteModo':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    deleteAModo($_GET['id']);
                    getAllModos();
                } else {
                    throw new Exception('Aucun identifiant admin envoyé');
                }
                break;



                // Déconnecter la session en cours
            case 'logout':
                $_SESSION['admin'] = "";
                home();
                break;



                // Si aucune page n'est définie dans URL ou que la page d'existe pas, renvoi vers la page d'erreur
            default:
                error();
        }



        // Si URL n'est pas définie, renvoi vers la page d'accueil
    } else {
        home();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
