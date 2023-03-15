<main class="container-fluid py-5">
    <div class="row">
        <div class="col">
            <div class="d-flex flex-column mt-5">
                <div class="text-center ">
                    <h1><span class="bdRenaissanceH1">B</span>ienvenue <?= $userConnected->pseudo ?> !</h1>
                </div>
                <div class="profilUser mt-3 p-3 d-flex flex-row justify-content-center align-items-center">
                    <div class="d-flex flex-column justify-content-center align-items-center p-5">
                        <a href="/controllers/userAccount/profilAccountCtrl.php">Mon compte</a>
                        <a href="/controllers/userAccount/ordersUserCtrl.php">Mes achats</a>
                    </div>
                    <img class="avatarProfil" src="/public/uploads/avatars/avatar_<?= $userConnected->pseudo ?>.jpg" alt="avatarUser">
                    <div class="d-flex flex-column justify-content-center align-items-center p-5">
                        <a href="/controllers/userAccount/dressingUserCtrl.php">Mon dressing</a>
                        <a href="/controllers/userAccount/galleryUserCtrl.php">Ma galerie</a>
                    </div>
                </div>
                <div class="text-center py-3">
                    <a href="#"><img class="chandlierReturn" title="Retour en haut" src="/public/assets/img/chandelier1.png" alt="chandelier"></a>
                </div>
            </div>
        </div>
</main>