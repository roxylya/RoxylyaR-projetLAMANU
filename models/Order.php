<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// le helper :
require_once(__DIR__ . '/../helper/dd.php');

class Order  	

{
    private int $id_orders;
    private string $created_at;
    private int $id_banners;
    private int $id_portraits;
    private int $id_outfits;
    private int $id_users;

    // public function __construct(int $id_orders, string $created_at, int $id_banners, int $id_portraits, int $id_outfits, int $id_users)
    // {
    //     $this->id_orders = $id_orders;
    //     $this->created_at = $created_at;
    //     $this->id_banners = $id_banners;
    //     $this->id_portraits = $id_portraits;
    //     $this->id_outfits = $id_outfits;
    //     $this->id_users = $id_users;
    // }

    public function setId_orders(int $id_orders)
    {
        $this->id_orders = $id_orders;
    }
    public function getId_orders(): int
    {
        return $this->id_orders;
    }

    public function setCreated_at(string $created_at)
    {
        $this->created_at = $created_at;
    }
    public function getCreated_at(): string
    {
        return $this->created_at;
    }

    public function setId_banners(int $id_banners)
    {
        $this->id_banners = $id_banners;
    }
    public function getId_banners(): int
    {
        return $this->id_banners;
    }
    public function setId_portraits(int $id_portraits)
    {
        $this->id_portraits = $id_portraits;
    }
    public function getId_portraits(): int
    {
        return $this->id_portraits;
    }
    public function setId_outfits(int $id_outfits)
    {
        $this->id_outfits = $id_outfits;
    }
    public function getId_outfits(): int
    {
        return $this->id_outfits;
    }

    public function setId_users(int $id_users)
    {
        $this->id_users = $id_users;
    }
    public function getId_users(): int
    {
        return $this->id_users;
    }



    // Afficher toutes les commandes de tous les utilisateurs:
    public static function getAll($search = "", $firstOrder = 0, $limit = 10)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `orders`.*, `users`.`pseudo`
        FROM `orders` 
        JOIN `users`
        ON  `orders`.`id_users` = `users`.`id_users`
        JOIN `creations`
        ON `orders`.`id_orders` = `creations`.`id_orders`
        WHERE `pseudo` LIKE :search OR `orders`.`created_at` LIKE :search  
        ORDER BY `created_at`
        LIMIT :firstOrder, :limit ;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $sth->bindValue(':firstOrder',  $firstOrder, PDO::PARAM_INT);
        $sth->bindValue(':limit', $limit, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }

    // Récupérer le nombre de commandes de la recherche sinon afficher tout :
    public static function getAllOrdersCount($search = "")
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `orders`.*, `users`.`pseudo`
        FROM `orders` 
        JOIN `users`
        ON  `orders`.`id_users` = `users`.`id_users`
        JOIN `creations`
        ON `orders`.`id_orders` = `creations`.`id_orders`
        WHERE `pseudo` LIKE :search OR `orders`.`created_at` LIKE :search;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }


    // Afficher le nombres de commandes d'un utilisateur :
    public static function getAllCountOrdersUser($id_users)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `orders`.*, `users`.`pseudo`
        FROM `orders` 
        JOIN `users`
        ON  `orders`.`id_users` = `users`.`id_users`
        WHERE `orders`.`id_users` = :id_users
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


    // Afficher toutes les commandes d'un utilisateur :
    public static function getAllOrdersUser($id_users)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `orders`.*, `users`.`pseudo`
        FROM `orders` 
        JOIN `users`
        ON  `orders`.`id_users` = `users`.`id_users`
        JOIN `creations`
        ON `orders`.`id_orders` = `creations`.`id_orders`
        ORDER BY `created_at`;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':id_users', $id_users, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }


    // Afficher une commande selon son id_orders :

    public static function get($id_orders)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `orders`.*, `users`.`pseudo`
        FROM `orders` 
        JOIN `users`
        ON  `orders`.`id_users` = `users`.`id_users`
        JOIN `creations`
        ON `orders`.`id_orders` = `creations`.`id_orders`
        WHERE `orders`.`id_orders`=:id_orders;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':id_orders', $id_orders, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }
}
