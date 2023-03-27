<h1 class="gold blackClover"><span class="bdRenaissanceH1">C</span>onnexion </h1>
<p class="py-1"><?= (isset($_GET["code"]))  ? CODES[$_GET["code"]] : '' ?></p>
<form method="post" class="connect medium my-5 gold fondamento mx-0" enctype="multipart/form-data" novalidate>
    <div class="d-lg-flex flex-wrap justify-content-around align-items-center pt-3">
        <div class="w-100 form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?? '' ?>" pattern="<?= REGEX_EMAIL ?>" required>
        </div>
        <div class="w-100 form-group mt-lg-0 mt-3">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" value="<?= $password ?? '' ?>" pattern="<?= REGEX_PASSWORD ?>" required>
        </div>
    </div>
    <p class="w-100 error text-center pt-2" id="alertPassword1"><?= $error['password'] ?? $error['email'] ?? '' ?></p>
    <div class="form-group text-center">
        <button type="submit" id="submit" class="btn btn-default">Envoyer</button>
    </div>
    <div class="py-3 text-center d-flex flex-lg-row flex-column justify-content-center align-items-center">
        <p class="little pe-lg-5"> Pas encore inscrit ? C'est par <a class="blue" href="/controllers/formSubscribeCtrl.php">ici</a>.</p>
        <p class="little mt-lg-0 mt-2"> Mot de passe oublié ? C'est par <a class="blue" href="/controllers/forgetPassword/formForgetPasswordCtrl.php">là</a>.</p>
    </div>
</form>