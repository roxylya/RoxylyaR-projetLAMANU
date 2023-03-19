<h1 class="text-center"><span class="bdRenaissanceH2">N</span>ouveau<br><span class="bdRenaissanceH2">M</span>ot de <span class="bdRenaissanceH2">P</span>asse </h1>
<p class="py-1"><?= (isset($_GET["code"]))  ? CODES[$_GET["code"]] : '' ?></p>
<form method="post" class="connect mt-3" enctype="multipart/form-data">
    <div class="d-md-flex flex-column justify-content-around align-items-center pt-3">
        <div class="w-100 d-lg-flex flex-wrap justify-content-around align-items-center">
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
        <div class="w-100 d-lg-flex flex-wrap justify-content-around align-items-center pt-lg-3">
            <div class="col-lg-11 text-center">
                <p class="error"><?= $error['password'] ?? '' ?></p>
            </div>
        </div>
        <div class="form-group text-center pb-3">
            <button type="submit" id="submit" class="btn btn-default">Envoyer</button>
        </div>
    </div>
</form>