<main class="container-fluid py-5">
    <div class="row">
        <div class="col">
            <div class="d-flex flex-column mt-5">
                <div class="text-center">
                    <h1><span class="bdRenaissanceH1">M</span>on compte</h1>
                </div>
                <p class="py-1"><?= (isset($_GET["code"]))  ? CODES[$_GET["code"]] : '' ?></p>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <!-- ouverture formulaire -->
                    <form method="post" class="createAccount my-5" enctype="multipart/form-data" novalidate>
                        <div class="d-lg-flex flex-wrap justify-content-around align-items-center pt-3">
                            <!-- mail -->
                            <div class="form-group col-lg-5">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?? $userConnected->email ?>" pattern="<?= REGEX_EMAIL ?>" required>
                                <p class="error text-center"><?= $error['email'] ?? '' ?></p>
                            </div>
                            <!-- pseudo -->
                            <div class="form-group col-lg-5 ">
                                <label for="pseudo">Pseudo RR:</label>
                                <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?= $pseudo ?? $userConnected->pseudo ?>" pattern="<?= REGEX_PSEUDO ?>" required>
                                <p class="error text-center"><?= $error['pseudo'] ?? '' ?></p>
                            </div>
                        </div>
                        <div class="d-lg-flex flex-wrap justify-content-around align-items-center pt-lg-3">
                            <!-- mot de passe -->
                            <div class="form-group col-lg-5">
                                <label for="password">Mot de passe :</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?= $password ?? '' ?>" pattern="<?= REGEX_PASSWORD ?>" required>
                            </div>
                            <!-- confirme mot de passe -->
                            <div class="form-group col-lg-5 pt-2 pt-lg-0">
                                <label for="passwordConfirm">Confirmer mot de passe :</label>
                                <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" value="<?= $passwordConfirm ?? '' ?>" pattern="<?= REGEX_PASSWORD ?>" required>
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
                                <input class="form-control" type="file" id="avatar" name="avatar" value="<?= $avatar ?? 'avatar_' . $userConnected->id_users . '.' . $userConnected->extUserAvatar ?>" accept="image/png, image/jpg, image/JPG, image/jpeg, image/gif" required>
                                <p class="error text-center"><?= $error['avatar'] ?? '' ?></p>
                            </div>
                        </div>
                        <!-- bouton pour envoyer le formulaire -->
                        <div class="form-group d-flex flex-column  pb-2">
                            <button type="submit" id="submit" class="btn d-flex align-self-center">Modifier</button>
                            <a class="delete py-3 ps-md-5" title="Votre pseudo s'il apparaît sur le site sera remplacé par anonyme. Les commandes réalisées seront sauvegardées dans la base de données, les images des commandes pourront rester visibles sur le site. Vos autres données : email, pseudo, mot de passe et avatar de compte utilisateur seront supprimées, vous n'aurez plus accès à votre compte. L'annulation de la suppression de votre compte n'est pas possible." data-bs-toggle="modal" data-bs-target="#deleteUserAccount">Supprimer mon compte</a>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteUserAccount" tabindex="-1" aria-labelledby="deleteUserAccountLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="deleteUserAccountLabel"><span class="bdRenaissanceH1">S</span>uppression du compte</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                    </div>
                                    <div class="modal-body">
                                        Vous vous apprêtez à supprimer votre compte ainsi que les données enregistrées. <br>
                                        Merci de renseigner votre mot de passe.

                                        <form method="post" action="/controllers/userAccount/deleteUserAccountCtrl.php" enctype="multipart/form-data">
                                            <div class="form-group col-lg-5 py-3">
                                                <input placeholder="mot de passe" type="password" class="form-control" id="passwordDelete" name="passwordDelete" value="<?= $password ?? '' ?>" pattern="<?= REGEX_PASSWORD ?>" required>
                                                <p class="error pt-1"><?= $error['passwordDelete'] ?? '' ?></p>
                                            </div>

                                        </form>
                                        Êtes-vous sûr de vouloir supprimer votre compte ?
                                    </div>
                                    <div class="modal-footer d-flex justify-content-around align-items-center m-0 ">
                                        <button type="button" class="btn btnNo text-center m-0 p-0" data-bs-dismiss="modal">Non.</button>
                                        <a class="text-center" href="/controllers/userAccount/deleteUserAccountCtrl.php?id_users=<?= $userConnected->id_users ?>"> <button type="button" class="btn btnDelete text-center m-0 p-0">OUI.</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal end -->

                    </form>
                    <!-- fermeture formulaire -->
                </div>
                <div class="text-center py-3">
                    <a href="#"><img class="chandlierReturn" title="Retour en haut" src="/public/assets/img/chandelier1.png" alt="chandelier"></a>
                </div>
            </div>
        </div>
</main>