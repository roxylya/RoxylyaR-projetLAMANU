<div class="text-center">
    <h1><span class="bdRenaissanceH1">S</span>uppression de <span class="bdRenaissanceH1">M</span>on <span class="bdRenaissanceH1">C</span>ompte</h1>
</div>
<p class="py-1"><?= (isset($_GET["code"]))  ? CODES[$_GET["code"]] : '' ?></p>
<div class="box d-flex flex-column justify-content-center align-items-center p-md-5 m-3 mb-0 p-3">
    <h2 class="mb-3"><span class="bdRenaissanceH2">I</span>nformations</h2>
    <p> * Vous vous apprêtez à supprimer votre compte ainsi que les données enregistrées. <br>
        * Votre pseudo s'il apparaît sur le site sera remplacé par "Anonyme". <br>
        * Les commandes réalisées seront sauvegardées dans la base de données,
        les images des commandes pourront rester visibles sur le site dans la partie galerie ou catalogue ou la page d'accueil. <br>
        * Vos autres données : email, pseudo, mot de passe et avatar de compte utilisateur
        seront supprimées, vous n'aurez plus accès à votre compte. <br>
        * L'annulation de la demande de suppression de votre compte n'est pas possible.</p>
    <form method="post" action="/controllers/userAccount/deleteUserAccountCtrl.php">
        <div class="form-group py-3">
            <label class="pb-2" for="passwordDelete">Votre mot de passe :</label>
            <input type="password" class="form-control" id="passwordDelete" name="passwordDelete" value="<?= $passwordDelete ?? '' ?>" pattern="<?= REGEX_PASSWORD ?>" required>
            <p class="error pt-1"><?= $error['passwordDelete'] ?? '' ?></p>
        </div>
        <p class="py-1">Êtes-vous sûr de vouloir supprimer votre compte ?</p>
        <div class="btnChoice d-flex justify-content-around align-items-center">
            <a class="text-center" href="/controllers/userAccount/userAccountCtrl.php"> <button type="button" class="btn btnNo text-center" data-bs-dismiss="modal">Non</button></a>
            <a class="text-center" href="/controllers/userAccount/deleteUserAccountCtrl.php"> <button type="submit" class="btn btnDelete text-center">Oui</button></a>
        </div>
    </form>
</div>