<div class="text-center gold blackClover">
    <h1><span class="bdRenaissanceH1">M</span>on compte</h1>
</div>
<p class="py-1"><?= (isset($_GET["code"]))  ? CODES[$_GET["code"]] : '' ?></p>
<div class="d-flex flex-column justify-content-center align-items-center">
    <!-- ouverture formulaire -->
    <form method="post" class="w-100 createAccount mt-3" enctype="multipart/form-data" novalidate>
        <div class="d-lg-flex flex-wrap justify-content-around align-items-center pt-3">
            <!-- mail -->
            <div class="form-group col-lg-5">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?? $userConnected->email ?>" pattern="<?= REGEX_EMAIL ?>" required>
                <p class="error text-center"><?= $error['email'] ?? '' ?></p>
            </div>
            <!-- pseudo -->
            <div class="form-group col-lg-5 ">
                <label for="pseudo">Pseudo RR:</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?= $pseudo ?? $userConnected->pseudo ?>" pattern="<?= REGEX_PSEUDO ?>" required>
                <p class="error text-center"><?= $error['pseudo'] ?? '' ?></p>
            </div>
        </div>
        <div class="d-lg-flex flex-wrap justify-content-around align-items-center pt-lg-3">
            <!-- mot de passe -->
            <div class="form-group col-lg-5">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" id="password" name="password" value="<?= $password ?? '' ?>" pattern="<?= REGEX_PASSWORD ?>" required>
            </div>
            <!-- confirme mot de passe -->
            <div class="form-group col-lg-5 pt-2 pt-lg-0">
                <label for="passwordConfirm">Confirmer :</label>
                <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" value="<?= $passwordConfirm ?? '' ?>" pattern="<?= REGEX_PASSWORD ?>" required>
            </div>
        </div>
        <!-- message d'erreur mot de passe -->
        <div class="d-lg-flex flex-wrap justify-content-around align-items-center pt-lg-3">
            <div class="col-lg-11 text-center">
                <p class="error"><?= $error['password'] ?? '' ?></p>
            </div>
        </div>
        <!--    REGEX PASSWORD : min 8, 1 maj, 1 min, 1 chiffre, 1 caractère spécial-->
        <div class="d-lg-flex flex-wrap justify-content-around align-items-center">
            <!-- récupération avatar -->
            <div class="form-group col-lg-11">
                <label for="avatar" class="form-label">Avatar :</label>
                <input class="form-control" type="file" id="avatar" name="avatar" value="<?= $avatar ?? 'avatar_' . $userConnected->id_users . '.' . $userConnected->extUserAvatar ?>" accept="image/png, image/jpg, image/JPG, image/jpeg, image/gif" required>
                <p class="error text-center"><?= $error['avatar'] ?? '' ?></p>
            </div>
        </div>
        <!-- bouton pour envoyer le formulaire -->
        <div class="form-group d-flex flex-column pb-3">
            <button type="submit" id="submit" class="btn d-flex align-self-center my-2">Modifier</button>
            <a class="delete ps-md-4" href="/controllers/userAccount/deleteUserAccountCtrl.php">Supprimer mon compte</a>
        </div>
    </form>
    <!-- fermeture formulaire -->
</div>