<div class="text-center gold blackClover">
    <h1><span class="bdRenaissanceH1">M</span>on compte</h1>
</div>
<p class="py-1 fondamento blue"><?= $message ?? '' ?></p>
<div class="d-flex flex-column justify-content-around align-items-center mt-3 mb-5 box bgBlue p-2">
    <div class="w-100 d-flex flex-lg-row flex-column justify-content-between align-items-center">
        <!-- ouverture formulaire -->
        <form method="post" class="w-100 update mb-3 mb-lg-0 medium gold blackClover d-flex flex-column flex-lg-row justify-content-center align-items-center p-3">
            <!-- mail -->
            <div class="w-100 form-group m-0">
                <label for="email">Email :</label>
                <div class="d-flex justify-content-center align-items-center">
                    <input type="email" class="form-control fondamento" id="email" name="email" value="<?= $email ?? $user->email ?>" pattern="<?= REGEX_EMAIL ?>" required>
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
                    <input type="text" class="form-control fondamento" id="pseudo" name="pseudo" value="<?= $pseudo ?? $user->pseudo ?>" pattern="<?= REGEX_PSEUDO ?>" required>
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
                    <input type="password" class="form-control fondamento" id="passwordConfirm" name="passwordConfirm"  pattern="<?= REGEX_PASSWORD ?>" required>
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
                    <input class="form-control fondamento" type="file" id="avatar" name="avatar" value="<?= $avatar ?? 'avatar_' . $user->id_users . '.' . $user->extUserAvatar ?>" accept="image/png, image/jpg, image/JPG, image/jpeg, image/gif" required>
                    <button type="submit" id="submitAvatar" class="btn-update text-center ms-2 blackClover"><img src="/public/assets/img/quill-dessinant-une-lignegold.png" alt="plume dorée"></button>
                </div>
                <p class="error red fondamento text-center"><?= $error['avatar'] ?? '' ?></p>
            </div>
            <!-- bouton pour envoyer le formulaire -->

        </form>
    </div>
    <!-- fermeture formulaire -->
    <a class="align-self-center red fondamento pb-3" href="/controllers/userAccount/deleteUserAccountCtrl.php">Supprimer mon compte</a>
</div>