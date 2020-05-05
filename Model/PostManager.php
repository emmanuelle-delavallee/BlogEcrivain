<?php

require_once("Model/Manager.php");


class PostManager extends Manager
{

    // FRONT/BACK : récupère les articles publiés de la BDD
    public function get_posts()
    {
        $db = $this->dbconnect();

        // Requête SQL récupère tous les posts publiés
        $req = $db->query("
            SELECT * 
            FROM posts 
            WHERE posted='1' 
            ORDER BY date DESC
        ");

        // Stocke les résultats dans un tableau
        $results = [];

        // Parcourt les résultats de la requête et les mets dans le tableau
        while ($rows = $req->fetchObject()) {
            $results[] = $rows;
        }

        // Retourne le tableau
        return $results;
    }



    //-------------------------------------------------------------//

    // FRONT : récupère un article publié de la BDD
    public function get_post()
    {

        $db = $this->dbconnect();

        // Requête SQL
        $req = $db->query("
        SELECT posts.id,
               posts.title,
               posts.content,
               posts.image,
               posts.content,
               posts.date
        FROM posts
        WHERE posts.id = '{$_GET['id']}'
        AND posts.posted = '1'
    ");

        // Résultats hors tableau car 1 seul résultat attendu
        $result = $req->fetchObject();

        // Retourne le résultat
        return $result;
    }



    //-------------------------------------------------------------//

    // FRONT : récupère les premier articles publiés de la BDD (limité à un nombre à définir)
    public function get_firstpost()
    {

        $db = $this->dbconnect();

        // Requête SQL
        $req = $db->query("
        SELECT *
        FROM posts
        WHERE posted = '1'
        order by date 
        LIMIT 1 
    ");

        // Stocke les résultats dans un tableau
        $results = [];

        // Parcourt les résultats de la requête et les mets dans le tableau
        while ($rows = $req->fetchObject()) {
            $results[] = $rows;
        }

        // Retourne le tableau
        return $results;
    }



    //-------------------------------------------------------------//

    // FRONT : récupère les derniers articles publiés de la BDD (limité à un nombre à définir)
    public function get_lastpost()
    {

        $db = $this->dbconnect();

        // Requête SQL
        $req = $db->query("
        SELECT *
        FROM posts
        WHERE posted = '1'
        order by date desc 
        LIMIT 1
    ");

        // Stocke les résultats dans un tableau
        $results = [];

        // Parcourt les résultats de la requête et les mets dans le tableau
        while ($rows = $req->fetchObject()) {
            $results[] = $rows;
        }

        // Retourne le tableau
        return $results;
    }



    //-------------------------------------------------------------// 

    // BACK : récupère tous les articles de la BDD (publiés/non publiés)
    function getAllPosts()
    {
        $db = $this->dbconnect();

        $req = $db->query("
            SELECT * 
            FROM posts 
            ORDER BY date DESC
        ");

        // Stocke les résultats dans un tableau
        $results = [];

        // Parcourt les résultats de la requête et les mets dans le tableau
        while ($rows = $req->fetchObject()) {
            $results[] = $rows;
        }

        // Retourne le tableau
        return $results;
    }



    //-------------------------------------------------------------//

    // BACK : récupère l'article dont l'ID est dans l'URL (publié/non publié)
    function getAPost()
    {

        $db = $this->dbconnect();

        $req = $db->query("
        SELECT  posts.id,
                posts.title,
                posts.image,
                posts.date,
                posts.content,
                posts.posted,
                admin.name
        FROM posts
        JOIN admin
        WHERE posts.id = '{$_GET['id']}'
    ");

        $result = $req->fetchObject();
        return $result;
    }



    //-------------------------------------------------------------//

    // BACK : modifie un article déjà créé et MAJ la BDD
    public function edit($title, $content, $posted, $id)
    {

        $db = $this->dbconnect();

        $e = [
            'title'     => $title,
            'content'   => $content,
            'posted'    => $posted,
            'id'        => $id,
        ];

        // Modifie la BDD en fonction des données saisies, ne modifie pas la date de publication pour ne pas le remonter en haut de liste
        $sql = "
        UPDATE posts 
        SET title=:title, 
            content=:content, 
            posted=:posted 
        WHERE id=:id
        ";

        $req = $db->prepare($sql);
        $req->execute($e);
    }




    //-------------------------------------------------------------//

    // BACK : crée un nouvel article
    public function createPost($title, $content, $posted)
    {
        $db = $this->dbconnect();

        $p = [
            'title'     =>  $title,
            'content'   =>  $content,
            'posted'    =>  $posted

        ];

        $sql = "
        INSERT INTO posts(title,content,date,posted)
        VALUES(:title,:content,NOW(),:posted)
        ";

        $req = $db->prepare($sql);
        $req->execute($p);
    }




    //-------------------------------------------------------------//

    // BACK : ajoute une image à un article 
    public function postImg($tmp_name, $extension)
    {

        $db = $this->dbconnect();


        $query = $db->query("
        SELECT max(id) as mid
        FROM posts
        ");
        $nombre = $query->fetch();
        $id = $nombre['mid'];


        //Tableau   
        $i = [
            'id'    =>  $id,
            'image' =>  $id . $extension
        ];

        // Update de la BDD là où l'ID correspond à l'ID de l'article, insère l'image et change l'image par défaut
        $sql = "
        UPDATE posts 
        SET image = :image 
        WHERE id = :id
        ";


        $req = $db->prepare($sql);
        $req->execute($i);

        // Classe le fichier sélectionné dans le dossier image
        move_uploaded_file($tmp_name, "Public/img/posts/" . $id . $extension);
    }




    //-------------------------------------------------------------//
    // BACK : ajoute une image à un article 
    public function editpostImg($id, $tmp_name, $extension)
    {

        $db = $this->dbconnect();

        //Tableau   
        $i = [
            'id'    =>  $id,
            'image' =>  $id . $extension
        ];

        // Update de la BDD là où l'ID correspond à l'ID de l'article, insère l'image et change l'image par défaut
        $sql = "
    UPDATE posts 
    SET image = :image 
    WHERE id = :id
    ";


        $req = $db->prepare($sql);
        $req->execute($i);
        // Classe le fichier sélectionné dans le dossier image
        move_uploaded_file($tmp_name, "Public/img/posts/" . $id . $extension);
    }




    //-------------------------------------------------------------//
    // BACK : supprime un article (l'option s'affiche uniquement pour les articles "non publiés")


    public function delpost($id)
    {
        $db = $this->dbconnect();


        //Tableau   
        $i = [
            'id'    =>  $id
        ];

        $sql = "
        DELETE FROM posts
        WHERE id = :id
        ";

        $req = $db->prepare($sql);
        $req->execute($i);
    }
}
