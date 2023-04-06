<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// le helper :
require_once(__DIR__ . '/../helper/dd.php');

class Type

{
    private int $id_types;
    private string $name;

    // public function __construct(int $id_types, string $name)
    // {
    //     $this->id_types = $id_types;
    //     $this->name = $name;

    // }

    public function setId_types(int $id_types)
    {
        $this->id_types = $id_types;
    }
    public function getId_types(): int
    {
        return $this->id_types;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }


    // on récupère l'id_types :
    public static function getId_typesByName(string $name)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `id_types` FROM `types` WHERE `name` = ?;';
        $sth = $pdo->prepare($sql);
        $sth->execute([$name]);
        $results = $sth->fetchAll();
        return $results;
    }


    // afficher tous les types :

    public static function getAll()
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT * FROM `types`;';
        $sth = $pdo->prepare($sql);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }
}
