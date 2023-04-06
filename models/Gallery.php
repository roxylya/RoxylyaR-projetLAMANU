<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// le helper :
require_once(__DIR__ . '/../helper/dd.php');

class Gallery

{
    private int $id_galleries;
    private string $name;
    private string $created_at;
    private int $id_types;
    private int $id_users;

    // public function __construct(int $id_galleries, string $created_at, string $name, int $id_types, int $id_users)
    // {
    //     $this->id_galleries = $id_galleries;

    //     $this->created_at = $created_at;
    //     $this->name = $name;
    //     $this->resume = $resume;
    //     $this->id_types = $id_types;
    //     $this->id_users = $id_users;
    // }

    public function setId_galleries(int $id_galleries)
    {
        $this->id_galleries = $id_galleries;
    }
    public function getId_galleries(): int
    {
        return $this->id_galleries;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function setCreated_at(string $created_at)
    {
        $this->created_at = $created_at;
    }
    public function getCreated_at(): string
    {
        return $this->created_at;
    }


    public function setId_types(int $id_types)
    {
        $this->id_types = $id_types;
    }
    public function getId_types(): int
    {
        return $this->id_types;
    }

    public function setId_users(int $id_users)
    {
        $this->id_users = $id_users;
    }
    public function getId_users(): int
    {
        return $this->id_users;
    }


    // 

    // ajouter une oeuvre à  la galerie :

    public function add()
    {
        // connection à la bd :
        $pdo = Database::getInstance();

        //On insère les données reçues   
        // on note les marqueurs nominatifs exemple :birthdate sert de contenant à une valeur

        $sql = 'INSERT INTO `galleries`(`name`, `created_at`, `id_types`, `id_users`) 
          VALUES(:name, Now(), :id_types, :id_users);';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':name', $this->name);
        $sth->bindValue(':id_types', $this->id_types, PDO::PARAM_INT);
        $sth->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        $sth->execute();

        // on vérifie si l'ajout a bien été effectué :
        $nbResults = $sth->rowCount();

        // si le nombre de ligne est strictement supérieur à 0 alors il renverra true :
        return ($nbResults > 0) ? true : false;
    }


    // on vérifie si le nom n'est pas déjà existant dans la base de données :

    public static function existsName(string $name)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `name` FROM `galleries` WHERE `name` = ?;';
        $sth = $pdo->prepare($sql);
        $sth->execute([$name]);
        $results = $sth->fetchAll();

        return (empty($results)) ? false : true;
    }


    // Afficher toutes les peintures de tous les utilisateurs:
    public static function getAll($search = "", $firstGallery = 0, $limit = 10)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `galleries`.`name` AS `galleryName`, `galleries`.`created_at`, `users`.`pseudo`, `types`.`name` AS `typeName`
        FROM `galleries` 
        JOIN `users`
        ON  `galleries`.`id_users` = `users`.`id_users`
        JOIN `types`
        ON `galleries`.`id_types` = `types`.`id_types`
        WHERE `pseudo` LIKE :search OR `galleries`.`created_at` LIKE :search  OR `galleries`.`name` LIKE :search  OR `types`.`name` LIKE :search 
        ORDER BY `created_at`
        LIMIT :firstGallery, :limit ;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $sth->bindValue(':firstGallery',  $firstGallery, PDO::PARAM_INT);
        $sth->bindValue(':limit', $limit, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }

    // Récupérer le nombre de peintures de la recherche sinon afficher tout :
    public static function getAllGalleriesCount($search = "")
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `galleries`.`name` AS `articleName`, `galleries`.`created_at`, `users`.`pseudo`, `types`.`name` AS `typeName`
        FROM `galleries` 
        JOIN `users`
        ON  `galleries`.`id_users` = `users`.`id_users`
        JOIN `types`
        ON `galleries`.`id_types` = `types`.`id_types`
        WHERE `pseudo` LIKE :search OR `galleries`.`created_at` LIKE :search  OR `galleries`.`name` LIKE :search OR `types`.`name` LIKE :search ';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }


    // Afficher le nombre de peintures d'un utilisateur :
    public static function getAllCountGalleriesUser($id_users)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `galleries`.`name` AS `articleName`, `galleries`.`created_at`, `users`.`pseudo`, `types`.`name` AS `typeName`
        FROM `galleries` 
        JOIN `users`
        ON  `galleries`.`id_users` = `users`.`id_users`
        JOIN `types`
        ON `galleries`.`id_types` = `types`.`id_types`
        WHERE `galleries`.`id_users` = :id_users
        ORDER BY `created_at`;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':id_users', $id_users, PDO::PARAM_INT);
        $sth->execute();

        // on vérifie si l'ajout a bien été effectué :
        $nbResults = $sth->rowCount();

        // si le nombre de ligne est strictement supérieur à 0 alors il renverra true :
        return $nbResults;
    }


    // Afficher toutes les peintures d'un utilisateur :
    public static function getAllGalleriesUser($id_users)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `galleries`.`name` AS `articleName`, `galleries`.`created_at`, `users`.`pseudo`, `types`.`name` AS `typeName`
        FROM `galleries` 
        JOIN `users`
        ON  `galleries`.`id_users` = `users`.`id_users`
        JOIN `types`
        ON `galleries`.`id_types` = `types`.`id_types`
        WHERE `galleries`.`id_users` = :id_users
        ORDER BY `created_at`;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':id_users', $id_users, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }


    // Afficher une oeuvre selon son id_galleries :

    public static function get($id_galleries)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `galleries`.`name` AS `articleName`, `galleries`.`created_at`, `users`.`pseudo`, `types`.`name` AS `typeName`
        FROM `galleries` 
        JOIN `users`
        ON  `galleries`.`id_users` = `users`.`id_users`
        JOIN `types`
        ON `galleries`.`id_types` = `types`.`id_types`
        WHERE `galleries`.`id_galleries`=:id_galleries;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':id_galleries', $id_galleries, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }

    // Afficher une oeuvre selon son name :

    public static function getByName($name)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `galleries`.`name` AS `articleName`, `galleries`.`created_at`, `users`.`pseudo`, `types`.`name` AS `typeName`
        FROM `galleries` 
        JOIN `users`
        ON  `galleries`.`id_users` = `users`.`id_users`
        JOIN `types`
        ON `galleries`.`id_types` = `types`.`id_types`
        WHERE `galleries`.`id_galleries`=:name;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':name', $name, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetch();

        return $results;
    }
}
