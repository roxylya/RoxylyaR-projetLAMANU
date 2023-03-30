<div class="text-center gold blackClover">
    <h1><span class="bdRenaissanceH1">M</span>on compte</h1>
</div>
<p class="py-1"><?= (isset($_GET["code"]))  ? CODES[$_GET["code"]] : '' ?></p>

    <!-- ouverture formulaire -->
    <form method="post" class="connect mt-3 mb-5 medium gold fondamento d-flex flex-column justify-content-center align-items-center p-3" enctype="multipart/form-data" novalidate>
        <!-- mail -->
        <div class="w-100 form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?? $user->email ?>" pattern="<?= REGEX_EMAIL ?>" required>
            <p class="error text-center"><?= $error['email'] ?? '' ?></p>
        </div>
        <!-- pseudo -->
        <div class="w-100 form-group">
            <label for="pseudo">Pseudo RR:</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?= $pseudo ?? $user->pseudo ?>" pattern="<?= REGEX_PSEUDO ?>" required>
            <p class="error text-center"><?= $error['pseudo'] ?? '' ?></p>
        </div>
        <!-- mot de passe -->
        <div class="w-100 form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" value="<?= $password ?? '' ?>" pattern="<?= REGEX_PASSWORD ?>" required>
        </div>
        <!-- confirme mot de passe -->
        <div class="w-100 form-group pt-2 pt-lg-0">
            <label for="passwordConfirm">Confirmer :</label>
            <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" value="<?= $passwordConfirm ?? '' ?>" pattern="<?= REGEX_PASSWORD ?>" required>
        </div>
        <!-- message d'erreur mot de passe -->
        <div class="w-100 text-center">
            <p class="error"><?= $error['password'] ?? '' ?></p>
        </div>
        <!--    REGEX PASSWORD : min 8, 1 maj, 1 min, 1 chiffre, 1 caractère spécial-->
        <!-- récupération avatar -->
        <div class="w-100 form-group">
            <label for="avatar" class="form-label">Avatar :</label>
            <input class="form-control" type="file" id="avatar" name="avatar" value="<?= $avatar ?? 'avatar_' . $user->id_users . '.' . $user->extUserAvatar ?>" accept="image/png, image/jpg, image/JPG, image/jpeg, image/gif" required>
            <p class="error text-center"><?= $error['avatar'] ?? '' ?></p>
        </div>
        <!-- bouton pour envoyer le formulaire -->
        <div class="w-100 form-group d-flex flex-column justify-content-center align-items-center pb-3">
            <button type="submit" id="submit" class="btn text-center my-2">Modifier</button>
        </div>
        <a class="delete align-self-start" href="/controllers/userAccount/deleteUserAccountCtrl.php">Supprimer mon compte</a>
    </form>
    <!-- fermeture formulaire -->