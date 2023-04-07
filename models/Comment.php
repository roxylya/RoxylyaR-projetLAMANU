<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// le helper :
require_once(__DIR__ . '/../helper/dd.php');

class Comment
{
    private int $id_comments;
    private string $created_at;
    private string $notice;
    private int $id_users;

    // public function __construct(int $id_comments, string $created_at, string $notice, string $validated_at, int $id_users)
    // {
    //     $this->id_comments = $id_comments;
    //     $this->created_at = $created_at;
    //     $this->notice = $notice;
    //     $this->validated_at = $validated_at;
    //     $this->id_users = $id_users;
    // }

    public function setId_comments(int $id_comments)
    {
        $this->id_comments = $id_comments;
    }
    public function getId_comments(): int
    {
        return $this->id_comments;
    }

    public function setCreated_at(string $created_at)
    {
        $this->created_at = $created_at;
    }
    public function getCreated_at(): string
    {
        return $this->created_at;
    }

    public function setNotice(string $notice)
    {
        $this->notice = $notice;
    }
    public function getNotice(): string
    {
        return $this->notice;
    }

    public function setId_users(int $id_users)
    {
        $this->id_users = $id_users;
    }
    public function getId_users(): int
    {
        return $this->id_users;
    }


    // <div class="box bgBlue comments m-3 m-md-4 p-3 d-flex flex-column">
    // <!-- comment header -->
    // <div class="commentHeader d-flex justify-content-around align-items-center ">
    //     <img src="/public/uploads/avatars/avatar_10.jpg" alt="avatar de l'user en cours">
    //     <div class="d-flex flex-column justify-content-center align-items-center">
    //         <h2 class="ms-2 gold blackClover large text-center">Pseudo de l'user</h2>
    //         <p class="gold small fondamento">date de la création</p>
    //     </div>
    // </div>
    // <!-- comment body -->
    // <p class="pt-2 gold fondamento justify">Merci à Dame Cassiopée pour cette magnifique tenue d'invitée pour le mariage de ma fille. Je reviendrais!</p>
    // <!-- comment footer -->
    // <p class="gold small fondamento d-flex align-self-end m-0 p-0">Denière édition : date de dernière édition</p>






    // ajouter un commentaire au livre d'or :

    public function add()
    {
        // connection à la bd :
        $pdo = Database::getInstance();

        //On insère les données reçues   
        // on note les marqueurs nominatifs exemple :id_users sert de contenant à une valeur

        $sql = 'INSERT INTO `comments`(`created_at`, `notice`, `id_users`) 
       VALUES(Now(), :notice, :id_users);';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':notice', $this->notice);
        $sth->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        $sth->execute();

        // on vérifie si l'ajout a bien été effectué :
        $nbResults = $sth->rowCount();

        // si le nombre de ligne est strictement supérieur à 0 alors il renverra true :
        return ($nbResults > 0) ? true : false;
    }


    // Afficher tous les commentaires de tous les utilisateurs:
    public static function getAll($search = "", $first = 0, $limit = 12)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `comments`.*, `users`.`id_users` AS `userIdUser`, `users`.`pseudo`, `users`.`extUserAvatar`
        FROM `comments` 
        JOIN `users`
        ON  `comments`.`id_users` = `users`.`id_users`
        WHERE `pseudo` LIKE :search OR `comments`.`created_at` LIKE :search OR `notice` LIKE :search 
        ORDER BY `created_at`
        LIMIT :first, :limit ;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $sth->bindValue(':first',  $first, PDO::PARAM_INT);
        $sth->bindValue(':limit', $limit, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }

    // Récupérer le nombre de commentaires de la recherche sinon afficher tout :
    public static function getAllCommentsCount($search = "")
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `comments`.*, `users`.*
        FROM `comments` 
        JOIN `users`
        ON  `comments`.`id_users` = `users`.`id_users`
        WHERE `pseudo` LIKE :search OR `comments`.`created_at` LIKE :search OR `notice` LIKE :search ;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }


    // Afficher le nombres de commentaires d'un utilisateur :
    public static function getAllCountCommentsUser($id_users)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `comments`.*, `users`.`id_users`
             FROM `comments` 
             JOIN `users`
             ON  `comments`.`id_users` = `users`.`id_users`
             WHERE `comments`.`id_users` = :id_users
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


    // Afficher tous les commentaires d'un utilisateur :
    public static function getAllCommentsUser($id_users)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `comments`.*, `users`.`pseudo`
        FROM `comments` 
        JOIN `users`
        ON  `comments`.`id_users` = `users`.`id_users`
                   ORDER BY `created_at`;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':id_users', $id_users, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }


    // Afficher un commentaire selon son id_comments :

    public static function get($id_comments)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `comments`.*, `users`.*
          FROM `comments` 
          JOIN `users`
          ON  `comments`.`id_users` = `users`.`id_users`
          WHERE `comments`.`id_comments`=:id_comments;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':id_comments', $id_comments, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetch();

        return $results;
    }
}
