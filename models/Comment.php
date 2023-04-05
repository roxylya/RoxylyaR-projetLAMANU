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



    // Afficher tous les commentaires :
    public static function getAll()
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `comments`.*, `users`.`pseudo`
          FROM `comments` 
          JOIN `users`
          ON  `comments`.`id_users` = `users`.`id_users`
          ORDER BY `created_at`';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }

    public static function get($id_users)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `comments`.*, `users`.`pseudo`
          FROM `comments` 
          JOIN `users`
          ON  `comments`.`id_users` = `users`.`id_users`
          WHERE `comments`.`id_users`=:id_users;';
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':id_users', $id_users, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();

        return $results;
    }
}
