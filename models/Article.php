<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// le helper :
require_once(__DIR__ . '/../helper/dd.php');

class Article

{
    private int $id_articles;
    private string $name;
    private string $resume;
    private string $created_at;
    private int $id_categories;
    private int $id_users;

    // public function __construct(int $id_articles, string $created_at, string $name, int $resume, int $id_categories, int $id_users)
    // {
    //     $this->id_articles = $id_articles;

    //     $this->created_at = $created_at;
    //     $this->name = $name;
    //     $this->resume = $resume;
    //     $this->id_categories = $id_categories;
    //     $this->id_users = $id_users;
    // }

    public function setId_articles(int $id_articles)
    {
        $this->id_articles = $id_articles;
    }
    public function getId_articles(): int
    {
        return $this->id_articles;
    }

    public function setCreated_at(string $created_at)
    {
        $this->created_at = $created_at;
    }
    public function getCreated_at(): string
    {
        return $this->created_at;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setResume(string $resume)
    {
        $this->resume = $resume;
    }
    public function getResume(): string
    {
        return $this->resume;
    }
    public function setId_categories(int $id_categories)
    {
        $this->id_categories = $id_categories;
    }
    public function getId_categories(): int
    {
        return $this->id_categories;
    }

    public function setId_users(int $id_users)
    {
        $this->id_users = $id_users;
    }
    public function getId_users(): int
    {
        return $this->id_users;
    }

    // on vérifie si le nom n'est pas déjà existant dans la base de données :

    public static function existsName(string $name)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `name` FROM `articles` WHERE `name` = ?;';
        $sth = $pdo->prepare($sql);
        $sth->execute([$name]);
        $results = $sth->fetchAll();

        return (empty($results)) ? false : true;
    }


    // ajouter une oeuvre à  la galerie :

    public function add()
    {
        // connection à la bd :
        $pdo = Database::getInstance();

        //On insère les données reçues   
        // on note les marqueurs nominatifs exemple :birthdate sert de contenant à une valeur

        $sql = 'INSERT INTO `articles`(`name`, `resume`, `created_at`, `id_categories`, `id_users`) 
       VALUES(:name, :resume, Now(), :id_categories, :id_users);';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':name', $this->name);
        $sth->bindValue(':resume', $this->resume);
        $sth->bindValue(':id_categories', $this->id_categories, PDO::PARAM_INT);
        $sth->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        $sth->execute();

        // on vérifie si l'ajout a bien été effectué :
        $nbResults = $sth->rowCount();

        // si le nombre de ligne est strictement supérieur à 0 alors il renverra true :
        return ($nbResults > 0) ? true : false;
    }



    // Afficher toutes les tenues de tous les utilisateurs:
    public static function getAll($search = "", $firstArticle = 0, $limit = 10)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `articles`.`name` AS `articleName`, `articles`.`id_articles`, `articles`.`resume`, `articles`.`created_at`, `users`.`pseudo`, `categories`.`name` AS `categoryName`
        FROM `articles` 
        JOIN `users`
        ON  `articles`.`id_users` = `users`.`id_users`
        JOIN `categories`
        ON `articles`.`id_categories` = `categories`.`id_categories`
        WHERE `pseudo` LIKE :search OR `articles`.`created_at` LIKE :search  OR `articles`.`name` LIKE :search OR `articles`.`resume` LIKE :search OR `categories`.`name` LIKE :search 
        ORDER BY `created_at`
        LIMIT :firstArticle, :limit ;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $sth->bindValue(':firstArticle',  $firstArticle, PDO::PARAM_INT);
        $sth->bindValue(':limit', $limit, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }

    // Récupérer le nombre de tenues de la recherche sinon afficher tout :
    public static function getAllArticlesCount($search = "")
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `articles`.`name` AS `articleName`, `articles`.`id_articles`, `articles`.`resume`, `articles`.`created_at`, `users`.`pseudo`, `categories`.`name` AS `categoryName`
        FROM `articles` 
        JOIN `users`
        ON  `articles`.`id_users` = `users`.`id_users`
        JOIN `categories`
        ON `articles`.`id_categories` = `categories`.`id_categories`
        WHERE `pseudo` LIKE :search OR `articles`.`created_at` LIKE :search  OR `articles`.`name` LIKE :search OR `articles`.`resume` LIKE :search OR `categories`.`name` LIKE :search ';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }


    // Afficher le nombre de tenues d'un utilisateur :
    public static function getAllCountArticlesUser($id_users)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `articles`.`name` AS `articleName`,  `articles`.`id_articles`, `articles`.`resume`, `articles`.`created_at`, `users`.`pseudo`, `categories`.`name` AS `categoryName`
        FROM `articles` 
        JOIN `users`
        ON  `articles`.`id_users` = `users`.`id_users`
        JOIN `categories`
        ON `articles`.`id_categories` = `categories`.`id_categories`
        WHERE `articles`.`id_users` = :id_users
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


    // Afficher toutes les tenues d'un utilisateur :
    public static function getAllArticlesUser($id_users)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `articles`.`name` AS `articleName`,  `articles`.`id_articles`, `articles`. `id_categories AS `idCat`, `articles`.`resume`, `articles`.`created_at`, `users`.`pseudo`, `categories`.`name` AS `categoryName`
        FROM `articles` 
        JOIN `users`
        ON  `articles`.`id_users` = `users`.`id_users`
        JOIN `categories`
        ON `articles`.`id_categories` = `categories`.`id_categories`
        WHERE `articles`.`id_users` = :id_users
        ORDER BY `created_at`;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':id_users', $id_users, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }


    // Afficher une tenue selon son id_articles :

    public static function get($id_articles)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `articles`.`name` AS `articleName`, `articles`.`id_articles`, `articles`.`resume`, `articles`.`created_at`, `users`.`pseudo`, `categories`.`name` AS `categoryName`, `articles`.`id_categories` AS `idCat`, `categories`.`id_categories`
        FROM `articles` 
        JOIN `users`
        ON  `articles`.`id_users` = `users`.`id_users`
        JOIN `categories`
        ON `articles`.`id_categories` = `categories`.`id_categories`
        WHERE `articles`.`id_articles`=:id_articles;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':id_articles', $id_articles, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetch();

        return $results;
    }
}
