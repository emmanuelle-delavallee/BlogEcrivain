<?php

class Manager
{
    // Connection à la BDD
    protected function dbConnect()
    {

        $db = new \PDO('mysql:host=db5000364575.hosting-data.io;dbname=dbs353403;charset=utf8', 'dbu398416', '#OPN3m!59#3r3');
        return $db;
    }
}
