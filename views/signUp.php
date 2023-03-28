<!-- titre de la page -->
<h1 class="gold blackClover"><span class="bdRenaissanceH1">I</span>nscription </h1>
<!-- ouverture formulaire -->
<form method="post" class="connect mt-3 mb-5 medium gold fondamento" enctype="multipart/form-data" novalidate>
    <div class="d-flex flex-column justify-content-around align-items-center pt-3 px-1 px-lg-0">
        <!-- mail -->
        <div class="w-100 form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?? '' ?>" pattern="<?= REGEX_EMAIL ?>" required>
            <p class="red little text-center"><?= $error['email'] ?? '' ?></p>
        </div>
        <!-- pseudo -->
        <div class="w-100 form-group">
            <label for="pseudo">Pseudo RR:</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?= $pseudo ?? '' ?>" pattern="<?= REGEX_PSEUDO ?>" required>
            <p class="red little text-center"><?= $error['pseudo'] ?? '' ?></p>
        </div>
        <!-- mot de passe -->
        <div class="w-100 form-group pt-2">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" value="<?= $password ?? '' ?>" pattern="<?= REGEX_PASSWORD ?>" required>
        </div>
        <!-- confirme mot de passe -->
        <div class="w-100 form-group pt-2">
            <label for="passwordConfirm">Confirmer mot de passe :</label>
            <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" value="<?= $passwordConfirm ?? '' ?>" pattern="<?= REGEX_PASSWORD ?>" required>
        </div>
        <!-- message d'erreur mot de passe -->
        <div class="w-100 text-center pt-1">
            <p class="red little"><?= $error['password'] ?? '' ?></p>
        </div>
        <!--    REGEX PASSWORD : min 8, 1 maj, 1 min, 1 chiffre, 1 caractère spécial-->
        <!-- récupération avatar -->
        <div class="w-100 form-group">
            <label for="avatar" class="form-label">Avatar :</label>
            <input class="form-control" type="file" id="avatar" name="avatar" value="<?= $avatar ?? '' ?>" accept="image/png, image/jpg, image/JPG, image/jpeg, image/gif" required>
            <p class="red little text-center"><?= $error['avatar'] ?? '' ?></p>
        </div>
        <div class="w-100 checkCgu form-group little py-3 d-flex flex-column justify-content-around align-items-center">
            <div class="checkCgu d-flex justify-content-around align-items-center">
                <input type="checkbox" id="cGU" name="cGU" required>
                <label for="cGU"> J'ai lu et j'accepte les <a href="/conditions-generales-d-utilisation.html"> Conditions Générales d'Utilisation</a>.</label>
            </div>
            <p class="red little"><?= $error['checkboxCgu'] ?? '' ?></p>
        </div>

        <!-- bouton pour envoyer le formulaire -->
        <div class="form-group text-center py-2">
            <button type="submit" id="submit" class="btn">Envoyer</button>
        </div>
    </div>
</form>
<!-- fermeture formulaire -->