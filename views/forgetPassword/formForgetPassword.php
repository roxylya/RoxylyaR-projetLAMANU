<h1 class="text-center gold blackClover"><span class="bdRenaissanceH2">M</span>ot de <span class="bdRenaissanceH2">P</span>asse <br><span class="bdRenaissanceH2">O</span>ublié</h1>
<p class="py-1"><?= (isset($_GET["code"]))  ? CODES[$_GET["code"]] : '' ?></p>
<form method="post" class="connect medium mb-5 gold fondamento mx-0" enctype="multipart/form-data" novalidate>
    <div class="w-100 d-lg-flex flex-wrap justify-content-around align-items-center pt-3 p-0">
        <div class="w-100 form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?? '' ?>" pattern="<?= REGEX_EMAIL ?>" required>
        </div>
        <p class="error text-center py-1" id="alertPassword1"><?= $error['password'] ?? $error['email'] ?? '' ?></p>
        <div class="w-100 form-group text-center pt-md-3">
            <button type="submit" id="submit" class="btn btn-default">Envoyer</button>
        </div>
        <p class="little py-3"> Pas encore inscrit ? C'est par <a href="/controllers/formSubscribeCtrl.php">ici</a>.</p>
    </div>
</form>