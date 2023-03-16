<main class="container-fluid py-5">
    <div class="row">
        <div class="col">
            <div class="d-flex flex-column justify-content-center align-items-center mt-5">
                <!-- titre de la page -->
                <h1><span class="bdRenaissanceH1">I</span>nscription </h1>
                <!-- ouverture formulaire -->
                <form method="post" class="createAccount my-5" enctype="multipart/form-data" novalidate>
                    <div class="d-lg-flex flex-wrap justify-content-around align-items-center pt-3">
                        <!-- mail -->
                        <div class="form-group col-lg-5">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?? '' ?>" pattern="<?= REGEX_EMAIL ?>" required>
                            <p class="error text-center"><?= $error['email'] ?? '' ?></p>
                        </div>
                        <!-- pseudo -->
                        <div class="form-group col-lg-5 ">
                            <label for="pseudo">Pseudo RR:</label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?= $pseudo ?? '' ?>" pattern="<?= REGEX_PSEUDO ?>" required>
                            <p class="error text-center"><?= $error['pseudo'] ?? '' ?></p>
                        </div>
                    </div>
                    <div class="d-lg-flex flex-wrap justify-content-around align-items-center pt-lg-3">
                        <!-- mot de passe -->
                        <div class="form-group col-lg-5">
                            <label for="password">Mot de passe :</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?= $password ?? '' ?>" pattern="<?=REGEX_PASSWORD?>" required>
                        </div>
                        <!-- confirme mot de passe -->
                        <div class="form-group col-lg-5 pt-2 pt-lg-0">
                            <label for="passwordConfirm">Confirmer mot de passe :</label>
                            <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" value="<?= $passwordConfirm ?? '' ?>" pattern="<?=REGEX_PASSWORD?>" required>
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
                            <input class="form-control" type="file" id="avatar" name="avatar" value="<?= $avatar ?? '' ?>" accept="image/jpg" required>
                            <p class="error text-center"><?= $error['avatar'] ?? '' ?></p>
                        </div>
                    </div>
                    <!-- bouton pour envoyer le formulaire -->
                    <div class="form-group text-center pb-2">
                        <button type="submit" id="submit" class="btn">Envoyer</button>
                    </div>
                </form>
                 <!-- fermeture formulaire -->
                 <!-- chandelier retour en haut de la page -->
                <div class="text-center">
                    <a href="#"><img class="chandlierReturn" title="Retour en haut" src="/public/assets/img/chandelier1.png" alt="chandelier"></a>
                </div>
            </div>
        </div>
    </div>
</main>