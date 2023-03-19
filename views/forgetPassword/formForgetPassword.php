<h1 class="text-center"><span class="bdRenaissanceH2">M</span>ot de <span class="bdRenaissanceH2">P</span>asse <br><span class="bdRenaissanceH2">O</span>ublié</h1>
<p class="py-1"><?= (isset($_GET["code"]))  ? CODES[$_GET["code"]] : '' ?></p>
<form method="post" class="connect mt-3" enctype="multipart/form-data" novalidate>
    <div class="d-md-flex flex-column justify-content-around align-items-center pt-3">
        <div class="form-group ">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?? '' ?>" pattern="<?= REGEX_EMAIL ?>" required>
        </div>
        <p class="error text-center pt-2" id="alertPassword1"><?= $error['password'] ?? $error['email'] ?? '' ?></p>
        <div class="form-group text-center">
            <button type="submit" id="submit" class="btn btn-default">Envoyer</button>
        </div>
        <p class="little py-3"> Pas encore inscrit ? C'est par <a href="/controllers/formSubscribeCtrl.php">ici</a>.</p>
    </div>
</form>