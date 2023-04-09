<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// le helper :
require_once(__DIR__ . '/../helper/dd.php');

class Category

{
    private int $id_categories;
    private string $name;

    // public function __construct(int $id_categories, string $name)
    // {
    //     $this->id_categories = $id_categories;
    //     $this->name = $name;

    // }

    public function setId_categories(int $id_categories)
    {
        $this->id_categories = $id_categories;
    }
    public function getId_categories(): int
    {
        return $this->id_categories;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }


    // on récupère l'id_categories :
    public static function getid_categoriesByName(string $name)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `id_categories` FROM `categories` WHERE `name` = ?;';
        $sth = $pdo->prepare($sql);
        $sth->execute([$name]);
        $results = $sth->fetch();
        return $results;
    }


    // afficher toutes les categories :

    public static function getAll()
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT * FROM `categories`;';
        $sth = $pdo->prepare($sql);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }
}
