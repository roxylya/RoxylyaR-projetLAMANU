<p class="pt-3"><?= $message ?? '' ?></p>
<h1 class="blackClover blue pb-3"> <span class="bdRenaissanceH1 blue ">A</span>jouter sur le <span class="bdRenaissanceH1 blue ">C</span>atalogue</h1>
<h2 class="dashboardDisplay text-center fondamento blue medium">Accessible à partir de 1110px de largeur d'écran ! </h2>
<div class="modeOff m-0 p-0">
    <!-- nav dashboard start -->
    <ul class="navDashboard d-flex justify-content-center align-items-center m-0  ms-0 ps-0 p-0">
        <li class="bgBlue">
            <a class="active gold" href="/admin-les-inscrits.html">Inscrits</a>
        </li>
        <li class="bgBlue">
            <a class="gold" href="/admin-catalogue.html">Catalogue</a>
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

    <!-- ouverture formulaire -->
    <form method="post" class="connect mt-3 mb-5 medium gold fondamento" enctype="multipart/form-data">
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
                <input type="password" class="form-control" id="password" name="password" pattern="<?= REGEX_PASSWORD ?>" required>
            </div>
            <!-- confirme mot de passe -->
            <div class="w-100 form-group pt-2">
                <label for="passwordConfirm">Confirmer mot de passe :</label>
                <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" pattern="<?= REGEX_PASSWORD ?>" required>
            </div>
            <!-- message d'erreur mot de passe -->
            <div class="w-100 text-center pt-1">
                <p class="red little" id="alertPassword"><?= $error['password'] ?? '' ?></p>
            </div>
            <!--    REGEX PASSWORD : min 8, 1 maj, 1 min, 1 chiffre, 1 caractère spécial-->
            <!-- récupération avatar -->
            <div class="w-100 form-group">
                <label for="avatar" class="form-label">Avatar :</label>
                <input class="form-control" type="file" id="avatar" name="avatar" value="<?= $avatar ?? '' ?>" accept="image/png, image/jpeg" required>
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
</div>