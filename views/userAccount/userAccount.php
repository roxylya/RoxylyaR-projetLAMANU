<main class="container-fluid py-5">
    <div class="row">
        <div class="col">
            <div class="userConnected d-flex flex-column mt-5">
               <a class="exit" href="/controllers/homeCtrl.php"><img class="exitDoor" src="/public/assets/img/door.png" alt="porte ouverte icône de déconnexion"></a>
                <div class="text-center ">
                    <h1><span class="bdRenaissanceH1">B</span>ienvenue <?= $userConnected->pseudo ?> !</h1>
                </div>
                <div class="profilUser mt-3 p-3">
                    <div class="actionUser p-5">
                      <div class="btnUserAccount d-flex justify-content-around align-items-center"> <img src="/public/assets/img/plume.png" alt="icône édition"><a href="/controllers/userAccount/profilAccountCtrl.php">Mon <br> compte</a></div>
                      <div class="btnUserAccount d-flex justify-content-around align-items-center"><img src="/public/assets/img/icons8-panier-en-osier-96.png" alt=""><a href="/controllers/userAccount/ordersUserCtrl.php">Mes <br> achats</a></div>
                    </div>
                    <img class="avatarProfil" src="/public/uploads/avatars/avatar_<?= $userConnected->pseudo ?>.jpg" alt="avatarUser">
                    <div class="lookUser p-5">
                    <div class="btnUserAccount d-flex justify-content-around align-items-center"><img src="/public/assets/img/armoire.png" alt=""><a href="/controllers/userAccount/dressingUserCtrl.php">Mon <br> dressing</a></div>
                    <div class="btnUserAccount d-flex justify-content-around align-items-center"><img src="/public/assets/img/tableau.png" alt=""><a href="/controllers/userAccount/galleryUserCtrl.php">Ma <br> galerie</a></div>
                    </div>
                </div>
                <div class="text-center py-3">
                    <a href="#"><img class="chandlierReturn pt-5" title="Retour en haut" src="/public/assets/img/chandelier1.png" alt="chandelier"></a>
                </div>
            </div>
        </div>
</main>