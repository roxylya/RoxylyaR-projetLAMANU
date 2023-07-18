<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// le helper :
require_once(__DIR__ . '/../helper/dd.php');

class Role

{
    private int $id_roles;
    private string $name;


    public function setId_roles(int $id_roles)
    {
        $this->id_roles = $id_roles;
    }
    public function getId_roles(): int
    {
        return $this->id_roles;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }



    // on récupère l'id_roles :
    public static function getId_rolesByName(string $name)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `id_roles` FROM `roles` WHERE `name` = ?;';
        $sth = $pdo->prepare($sql);
        $sth->execute([$name]);
        $results = $sth->fetch();
        return $results;
    }


    // afficher tous les roles :

    public static function getAll()
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT * FROM `roles`;';
        $sth = $pdo->prepare($sql);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }
}
