<?php
require_once("Model/Manager.php");

class AdminManager extends Manager
{

    //-------------------------------------------------------------//

    // Vérifie si un utilisateur est admin
    public function checkAdmin($email, $password)
    {
        $db = $this->dbConnect();

        $a = [
            'email' => $email,
            'password' => sha1($password)
        ];

        $sql = "
        SELECT * FROM admin 
        WHERE email = :email 
        AND password = :password
        ";

        $req = $db->prepare($sql);
        $req->execute($a);

        $exist = $req->rowCount($sql);
        return $exist;
    }




    //-------------------------------------------------------------//

    // Ajoute un nouvel admin/modérateur 
    public function addModo($name, $email, $role, $password)
    {
        $db = $this->dbConnect();

        $m = [
            'name'      =>  $name,
            'email'     =>  $email,
            'role'      =>  $role,
            'password'  => sha1($password)
        ];

        // Insère les données dans la BDD
        $sql = "
        INSERT INTO admin(name,email,role,password) 
        VALUES(:name,:email,:role,:password)
        ";

        $req = $db->prepare($sql);
        $req->execute($m);
    }



    //-------------------------------------------------------------//

    // BACK : Supprimer un admin/modérateur

    public function delModo($id)
    {
        $db = $this->dbconnect();

        $db->exec("DELETE FROM admin WHERE id=" . $id);
    }



    //-------------------------------------------------------------//

    // BACK : Récupère les modérateurs de la BDD
    public function getModos()
    {
        $db = $this->dbConnect();

        $req = $db->query("
        SELECT * FROM admin
        ");

        $results = [];
        while ($rows = $req->fetchObject()) {
            $results[] = $rows;
        }
        return $results;
    }



    //-------------------------------------------------------------//

    // BACK : Vérifie si le modérateur a une session créée (administrateur ou modérateur) pour afficher les contenus auxquels il a accès, sinon retourne 0 
    function admin()
    {
        if (isset($_SESSION['admin'])) {

            $db = $this->dbConnect();

            $a = [
                'email'     =>  $_SESSION['admin'],
                'role'      =>  'admin'
            ];

            $sql = "SELECT * FROM admin WHERE email=:email AND role=:role";
            $req = $db->prepare($sql);
            $req->execute($a);

            // Retourne le compte de la requête : 0 pour modérateur, 1 pour administrateur
            $exist = $req->rowCount($sql);

            return $exist;
        } else {
            return 0;
        }
    }

    //-------------------------------------------------------------//

    // BACK : Vérifie si le modérateur ou administrateur pour afficher les contenus ou pas 
    function adminOrModo()
    {

        $db = $this->dbConnect();
        if (isset($_SESSION['admin'])) {
            $value = $_SESSION['admin'];

            $req = $db->query("SELECT email FROM admin WHERE email='$value' ");



            while ($rows = $req->fetchObject()) {
                $result =  $rows->email;
            }

            if (!empty($result)) {
                $exist = 1;
            } else {
                $exist = 0;
            }
        } else {
            $exist = 0;
        }

        return $exist;
    }
}
