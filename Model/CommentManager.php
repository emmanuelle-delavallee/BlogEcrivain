<?php

require_once("Model/Manager.php");

class CommentManager extends Manager
{

    /* Pour les commentaires : 
0 = En attente de validation mais visible sur le site
1 = Validé par un modérateur/administrateur
2 = Signalé par un utilisateur
3 = Supprimé par un admin/modérateur
*/


    // FRONT : Récupérer et afficher les commentaires d'un article
    function get_comments()
    {
        $db = $this->dbConnect();

        $req = $db->query("
        SELECT * 
        FROM comments  
        WHERE post_id ='{$_GET['id']}' 
        and (seen = '0' or seen = '1')
        ORDER BY date ASC
        ");

        $results = [];
        while ($rows = $req->fetchObject()) {
            $results[] = $rows;
        }

        return $results;
    }



    //-------------------------------------------------------------//

    // FRONT : Envoyer un commentaire
    public function postComment($name, $email, $comment, $postId)
    {
        $db = $this->dbConnect();

        $c = array(
            'name'      => $name,
            'email'     => $email,
            'comment'   => htmlspecialchars($comment),
            'post_id'   => $postId

        );


        $sql = "
        INSERT INTO comments(name,email,comment,post_id,date) 
        VALUES(:name, :email, :comment, :post_id, NOW())
        ";

        $req = $db->prepare($sql);
        $req->execute($c);
    }



    //-------------------------------------------------------------//

    // FRONT : Signaler un commentaire 
    public function WarningComment($id)
    {
        $db = $this->dbconnect();
        $db->exec("UPDATE comments SET seen='2'  WHERE id=" . $id);
    }



    //-------------------------------------------------------------//

    // BACK : Récupère les commentaires non lus ou signalés de la base de données
    public function getUnreadComments()
    {
        $db = $this->dbconnect();

        $req = $db->query("
        SELECT  comments.id,
                comments.name,
                comments.email,
                comments.date,
                comments.post_id,
                comments.comment,
                comments.seen,
                posts.title
        FROM comments
        JOIN posts
        ON comments.post_id = posts.id
        WHERE comments.seen = '0' or comments.seen = '2'
        ORDER BY comments.date ASC
    ");

        $results = [];
        while ($rows = $req->fetchObject()) {
            $results[] = $rows;
        }
        return $results;
    }


    //-------------------------------------------------------------//

    // BACK : Récupère le nombre d'entrées d'une table
    public function inTable($table)
    {

        $db = $this->dbconnect();

        $query = $db->query("
        SELECT COUNT(id) as nb
        FROM $table
        ");
        $nombre = $query->fetch();

        return $nombre['nb'];
    }



    //-------------------------------------------------------------//

    // BACK : Supprimer un commentaire mais le conserver en base
    public function delComment($id)
    {
        $db = $this->dbconnect();

        $db->exec("UPDATE comments SET seen='3'  WHERE id=" . $id);
    }



    //-------------------------------------------------------------//

    // BACK : Valider un commentaire
    public function viewComment($id)
    {
        $db = $this->dbconnect();
        $db->exec("UPDATE comments SET seen='1'  WHERE id=" . $id);
    }
}
