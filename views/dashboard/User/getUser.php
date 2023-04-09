<p class="pt-3 fondamento medium blue"><?= $message ?? '' ?></p>
<h1 class="blackClover blue pb-3"> <span class="bdRenaissanceH1 blue ">M</span>odifier un <span class="bdRenaissanceH1 blue ">I</span>nscrit</h1>
<div class="dashboard d-flex flex-column justify-content-center align-items-center">
    <!-- nav dashboard start -->
    <ul class="navDashboard d-flex justify-content-center align-items-center m-0 me-3 ms-0 ps-0 p-0">
        <li class="active bgBlue">
            <a class="gold " href="/controllers/dashboard/dashboardCtrl.php">Inscrits</a>
        </li>
        <li class="bgBlue">
            <a class="gold" href="/controllers/dashboard/Catalogs/getAllCatalogsCtrl.php">Catalogue</a>
        </li>
        <li class="bgBlue">
            <a class="gold" href="/controllers/dashboard/Galleries/getAllGalleriesCtrl.php">Galerie</a>
        </li>
        <li class="bgBlue">
            <a class="gold" href="/controllers/dashboard/Orders/getAllOrdersCtrl.php">Commandes</a>
        </li>
        <li class="bgBlue">
            <a class="gold" href="/controllers/dashboard/GoldenBook/getAllCommentsCtrl.php">Livre d'Or</a>
        </li>
    </ul>
    <!-- nav dashboard end -->
    <div class="d-flex bgBlue formUpdate flex-column justify-content-center align-items-start">
        <div class="w-100 d-flex flex-lg-row flex-column justify-content-between align-items-center">
            <!-- ouverture formulaire -->
            <form method="post" class="w-100 update mb-3 mb-lg-0 medium gold blackClover d-flex flex-column flex-lg-row justify-content-center align-items-center p-3">
                <!-- mail -->
                <div class="w-100 form-group m-0">
                    <label for="email">Email :</label>
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="email" class="form-control fondamento" id="email" name="email" value="<?= $email ?? $theUser->email ?>" pattern="<?= REGEX_EMAIL ?>" required>
                        <button type="submit" id="submitEmail" class="btn-update text-center blackClover ms-2"><img src="/public/assets/img/quill-dessinant-une-lignegold.png" alt="plume dorée"></button>
                    </div>
                    <p class="error red fondamento text-center"><?= $error['email'] ?? '' ?></p>
                </div>
            </form>
            <!-- fermeture formulaire -->
            <!-- ouverture formulaire -->
            <form method="post" class="w-100 update mb-3 mb-lg-0 medium gold blackClover d-flex flex-column flex-lg-row justify-content-center align-items-center p-3">
                <!-- pseudo -->
                <div class="w-100 form-group m-0">
                    <label for="pseudo">Pseudo RR:</label>
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="text" class="form-control fondamento" id="pseudo" name="pseudo" value="<?= $pseudo ?? $theUser->pseudo ?>" pattern="<?= REGEX_PSEUDO ?>" required>
                        <button type="submit" id="submitPseudo" class="btn-update text-center blackClover ms-2"><img src="/public/assets/img/quill-dessinant-une-lignegold.png" alt="plume dorée"></button>
                    </div>
                    <p class="error red fondamento text-center"><?= $error['pseudo'] ?? '' ?></p>
                </div>
            </form>
            <!-- fermeture formulaire -->
        </div>

        <div class="d-flex flex-lg-row flex-column justify-content-between align-items-center my-0 ">
            <!-- ouverture formulaire -->
            <form method="post" class="w-100 update mb-3 mb-lg-0 medium gold blackClover d-flex flex-column flex-lg-row justify-content-center align-items-center p-3">
                <div class="w-100 d-flex flex-column justify-content-center align-items-center">
                    <!-- mot de passe -->
                    <div class="w-100 form-group m-0">
                        <label for="password">Mot de passe :</label>
                        <input type="password" class="form-control fondamento" id="password" name="password" pattern="<?= REGEX_PASSWORD ?>" required>
                    </div>
                    <!-- confirme mot de passe -->
                    <div class="w-100 form-group pt-2 pt-lg-0 m-0">
                        <label for="passwordConfirm">Confirmer :</label>
                        <input type="password" class="form-control fondamento" id="passwordConfirm" name="passwordConfirm" pattern="<?= REGEX_PASSWORD ?>" required>
                    </div>
                    <!-- message d'erreur mot de passe -->
                    <div class="text-center">
                        <p class="error red fondamento text-center"><?= $error['password'] ?? '' ?></p>
                    </div>
                </div>
                <!-- bouton pour envoyer le formulaire -->
                <button type="submit" id="submitPassword" class="btn-update text-center blackClover ms-2"><img src="/public/assets/img/quill-dessinant-une-lignegold.png" alt="plume dorée"></button>
            </form>
            <!-- fermeture formulaire -->
            <!--    REGEX PASSWORD : min 8, 1 maj, 1 min, 1 chiffre, 1 caractère spécial-->
            <!-- récupération avatar -->
            <!-- ouverture formulaire -->
            <form method="post" class="w-100 update mb-3 mb-lg-0 medium gold blackClover d-flex flex-column flex-lg-row justify-content-center align-items-center p-3" enctype="multipart/form-data">
                <div class="w-100 form-group m-0">
                    <label for="avatar" class="form-label">Avatar :</label>
                    <div class="w-100 d-flex justify-content-center align-items-center">
                        <input class="form-control fondamento" type="file" id="avatar" name="avatar" value="<?= $avatar ?? 'avatar_' . $theUser->id_users . '.' . $theUser->extUserAvatar ?>" accept="image/png, image/jpg, image/JPG, image/jpeg, image/gif" required>
                        <button type="submit" id="submitAvatar" class="btn-update text-center ms-2 blackClover"><img src="/public/assets/img/quill-dessinant-une-lignegold.png" alt="plume dorée"></button>
                    </div>
                    <p class="error red fondamento text-center"><?= $error['avatar'] ?? '' ?></p>
                </div>
                <!-- bouton pour envoyer le formulaire -->

            </form>
        </div>
        <!-- fermeture formulaire -->
    </div>
</div>