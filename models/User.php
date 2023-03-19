<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// le helper :
require_once(__DIR__ . '/../helper/dd.php');

class User
{
    private int $id_users;
    private string $pseudo;
    private string $email;
    private string $password;
    private string $extUserAvatar;
    private string $created_at;
    private string $updated_at;
    private string $validated_at;
    private int $id_roles;

    // public function __construct(int $id_users, string $pseudo, string $email, string $password,string $extUserAvatar, string $created_at, string $updated_at, string $validated_at, int $idRole)
    // {
    //     $this->id_users = $id_users;
    //     $this->pseudo = $pseudo;
    //     $this->email = $email;
    //     $this->password = $password;
    //     $this->extUserAvatar = $extUserAvatar;
    //     $this->created_at = $created_at;
    //     $this->updated_at = $updated_at;
    //     $this->validated_at = $validated_at;
    //     $this->id_roles = $id_roles;
    // }

    public function setId_users(int $id_users)
    {
        $this->id_users = $id_users;
    }
    public function getId_users(): int
    {
        return $this->id_users;
    }

    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;
    }
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }
    public function getpassword(): string
    {
        return $this->password;
    }

    public function setExtUserAvatar(string $extUserAvatar)
    {
        $this->extUserAvatar = $extUserAvatar;
    }
    public function getExtUserAvatar(): string
    {
        return $this->extUserAvatar;
    }

    public function setCreated_at(string $created_at)
    {
        $this->created_at = $created_at;
    }
    public function getCreated_at(): string
    {
        return $this->created_at;
    }

    public function setUpdated_at(string $updated_at)
    {
        $this->updated_at = $updated_at;
    }
    public function getUpdated_at(): string
    {
        return $this->updated_at;
    }

    public function setValidated_at(string $validated_at)
    {
        $this->validated_at = $validated_at;
    }
    public function getValidated_at(): string
    {
        return $this->validated_at;
    }

    public function setId_roles(int $id_roles)
    {
        $this->id_roles = $id_roles;
    }
    public function getId_roles(): int
    {
        return $this->id_roles;
    }



    // vérifier si l'email existe déjà dans la base de données :
    public static function existsEmail(string $email)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `id_users` FROM `users` WHERE `email` = ?;';
        $sth = $pdo->prepare($sql);
        $sth->execute([$email]);
        $results = $sth->fetchAll();

        return (empty($results)) ? false : true;
    }


    // vérifier si le pseudo existe déjà dans la base de données :
    public static function existsPseudo(string $pseudo)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `id_users` FROM `users` WHERE `pseudo` = ?;';
        $sth = $pdo->prepare($sql);
        $sth->execute([$pseudo]);
        $results = $sth->fetchAll();

        return (empty($results)) ? false : true;
    }


    // méthode d' ajout d'un user à la bd :
    public function add()
    {
        // connection à la bd :
        $pdo = Database::getInstance();

        //On insère les données reçues   
        // on note les marqueurs nominatifs exemple :birthdate sert de contenant à une valeur

        $sql = 'INSERT INTO `users`(`pseudo`, `email`, `password`, `extUserAvatar`, `created_at`, `updated_at`, `id_roles`) 
        VALUES(:pseudo, :email, :password, :extUserAvatar, :created_at, :updated_at, :id_roles);';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':pseudo', $this->pseudo);
        $sth->bindValue(':email', $this->email);
        $sth->bindValue(':password', $this->password);
        $sth->bindValue(':extUserAvatar', $this->extUserAvatar);
        $sth->bindValue(':created_at', $this->created_at);
        $sth->bindValue(':updated_at', $this->updated_at);
        $sth->bindValue(':id_roles', $this->id_roles, PDO::PARAM_INT);
        $sth->execute();

        // on vérifie si l'ajout a bien été effectué :
        $nbResults = $sth->rowCount();

        // si le nombre de ligne est strictement supérieur à 0 alors il renverra true :
        return ($nbResults > 0) ? true : false;
    }

    // méthode pour récupérer les informations d'un utilisateur y compris son rôle en fonction de son id_users et son email:
    public static function getByEmail($email): object | bool
    {
        $pdo = Database::getInstance();
        // je formule ma requête affiche tout de la table liste concernant l'email récupéré
        $sql = 'SELECT * 
        FROM `users` 
        JOIN `roles` 
        ON  `roles`.`id_roles` = `users`.`id_roles`
        WHERE  `users`.`email`= :email;';
        // je fais appel à la méthode prepare qui me renvoie la réponse de ma requête, je stocke la réponse dans la variable 
        // $sth qui est un pdo statement:
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':email', $email);
        // on exécute la requête
        $sth->execute();
        // On stocke le résultat dans un objet puisque paramétrage effectué:
        $results = $sth->fetch();
        // que l'on retourne en sortie de méthode
        return $results;
    }

    // méthode pour récupérer les informations d'un utilisateur y compris son rôle en fonction de son id_users et son email:
    public static function getById($id_users): object | bool
    {
        $pdo = Database::getInstance();
        // je formule ma requête affiche tout de la table liste concernant l'id_users récupéré
        $sql = 'SELECT * 
            FROM `users` 
            JOIN `roles` 
            ON  `roles`.`id_roles` = `users`.`id_roles`
            WHERE  `users`.`id_users`= :id_users;';
        // je fais appel à la méthode prepare qui me renvoie la réponse de ma requête, je stocke la réponse dans la variable 
        // $sth qui est un pdo statement:
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':id_users', $id_users, PDO::PARAM_INT);
        // on exécute la requête
        $sth->execute();
        // On stocke le résultat dans un objet puisque paramétrage effectué:
        $results = $sth->fetch();
        // que l'on retourne en sortie de méthode
        return $results;
    }

    // Update :

    public function update($id_users)
    {
        $pdo = Database::getInstance();
        $sql = ' UPDATE `users` 
        SET `pseudo`=:pseudo, `email`=:email, `password`=:password, `extUserAvatar`=:extUserAvatar, `updated_at`=:updated_at 
        WHERE `id_users`=:id_users;';
        //On insère les données reçues   
        //  on note les marqueurs nominatifs :
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id_users', $id_users, PDO::PARAM_INT);
        $sth->bindValue(':pseudo', $this->pseudo);
        $sth->bindValue(':email', $this->email);
        $sth->bindValue(':password', $this->password);
        $sth->bindValue(':extUserAvatar', $this->extUserAvatar);
        $sth->bindValue(':updated_at', $this->updated_at);
        $sth->execute();
        // on vérifie si l'ajout a bien été effectué :
        $nbResults = $sth->rowCount();

        // si le nombre de ligne est strictement supérieur à 0 alors il renverra true :
        return ($nbResults > 0) ? true : false;
    }


    // Update Password quand mot de passe oublié :

    public function updatePassword($id_users)
    {
        $pdo = Database::getInstance();
        $sql = ' UPDATE `users` 
         SET `password`=:password, `updated_at`=:updated_at 
         WHERE `id_users`=:id_users;';
        //On insère les données reçues   
        //  on note les marqueurs nominatifs :
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id_users', $id_users, PDO::PARAM_INT);
        $sth->bindValue(':password', $this->password);
        $sth->bindValue(':updated_at', $this->updated_at);
        $sth->execute();
        // on vérifie si l'ajout a bien été effectué :
        $nbResults = $sth->rowCount();

        // si le nombre de ligne est strictement supérieur à 0 alors il renverra true :
        return ($nbResults > 0) ? true : false;
    }



    // Delete un user :

    public static function delete($id_users)
    {
        $pdo = Database::getInstance();
        // je mets des as pour différencier mes id des différentes tables :
        $sql = 'DELETE FROM `users` 
              WHERE `users`.`id_users`=:id_users ;';
        // on prépare la requête
        $sth = $pdo->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':id_users', $id_users, PDO::PARAM_INT);
        // on exécute la requête
        $sth->execute();
        // on vérifie si la suppression a bien été effectuée :
        $nbResults = $sth->rowCount();
        // si le nombre de ligne est strictement supérieur à 0 alors il renverra true :
        return ($nbResults > 0) ? true : false;
    }


    //     // vérifier si l'id_users existe dans la base de données :
    //     public static function existsId(int $id_users)
    //     {
    //         $pdo = Database::getInstance();
    //         $sql = 'SELECT `id_users` FROM `users` WHERE `id_users` = ?;';
    //         $sth = $pdo->prepare($sql);
    //         $sth->execute([$id_users]);
    //         $results = $sth->fetchAll();

    //         return (empty($results)) ? false : true;
    //     }

    //     // Afficher tous les users. (admin)
    //     public static function getAll($research = "", $firstUser = 0, $limit = 10)
    //     {
    //         $pdo = Database::getInstance();
    //         $sql = 'SELECT *.`users`, `name`.`roles`
    //         FROM `users` 
    //         JOIN `roles`
    //         ON  `roles`.`id_roles` = `users`.`id_roles`
    //         WHERE `pseudo` LIKE :research OR `email` LIKE :research OR `password` LIKE :research OR `extUserAvatar` LIKE :research OR `created_at` LIKE :research OR `validate_at` LIKE :research OR `name` LIKE :research 
    //         ORDER BY `pseudo`
    //         LIMIT :firstUser, :limit ;';
    //         $sth = $pdo->prepare($sql);
    //         // On affecte les valeurs au marqueur nominatif :
    //         $sth->bindValue(':research', '%' . $research . '%', PDO::PARAM_STR);
    //         $sth->bindValue(':firstUser',  $firstUser, PDO::PARAM_INT);
    //         $sth->bindValue(':limit', $limit, PDO::PARAM_INT);
    //         $sth->execute();
    //         $results = $sth->fetchAll();

    //         return $results;
    //     }

    //     // Afficher le nombre d'users récupéré dans la recherche :
    //     public static function getAllCount($research = "")
    //     {
    //         $pdo = Database::getInstance();
    //         $sql = 'SELECT *.`users`, `name`.`roles`
    //         FROM `users` 
    //         JOIN `roles`
    //         ON  `roles`.`id_roles` = `users`.`id_roles`
    //         WHERE `pseudo` LIKE :research OR `email` LIKE :research OR `password` LIKE :research OR `extUserAvatar` LIKE :research OR `created_at` LIKE :research OR `validate_at` LIKE :research OR `name` LIKE :research ;';
    //         $sth = $pdo->prepare($sql);
    //         // On affecte les valeurs au marqueur nominatif :
    //         $sth->bindValue(':research', '%' . $research . '%', PDO::PARAM_STR);
    //         $sth->execute();
    //         $results = $sth->fetchAll();

    //         return $results;
    //     }
}
