<div class="text-center gold blackClover">
    <h1><span class="bdRenaissanceH1">B</span>ienvenue Chef <?= $user->pseudo ?> !</h1>
</div>
<p class="pt-2"><?= $message ?? '' ?></p>

<ul class=" navDashboard d-flex justify-content-center align-items-center m-0 p-0">
    <li class="active bgBlue">
        <a class="gold " href="/controllers/dashboard/Users/getAllUsersCtrl.php">Inscrits</a>
    </li>
    <li class="bgBlue">
        <a class="gold" href="/controllers/dashboard/Catalogs/getAllCatalogsCtrl.php">Catalogue</a>
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


<table class="w-75 dashboardUsers mt-0 p-1 bgBlue fondamento text-center mb-3">
    <tr class="bgBlue">
        <th>Pseudo</th>
        <th>Mail</th>
        <th>Crée le</th>
        <th>Validé</th>
        <th>Commande</th>
        <th>Commentaires</th>
        <th>Actions</th>

    </tr>
    <tr class="bgWhite">
        <td>Pseudo</td>
        <td>Mail</td>
        <td>Crée le</td>
        <td>Validé</td>
        <td>Commande</td>
        <td>Commentaires</td>
        <td><a href="/controllers/dashboard/Users/getUserCtrl.php"><img src="/public/assets/img/loupe.png" alt="icône loupe"></a>
            <a href="/controllers/dashboard/Users/deleteUserCtrl.php"><img class="ms-2" src="/public/assets/img/supprimer.png" alt="icône poubelle"></a>
        </td>
    </tr>
    <tr class="bgWhite">
        <td>Pseudo</td>
        <td>Mail</td>
        <td>Crée le</td>
        <td>Validé</td>
        <td>Commande</td>
        <td>Commentaires</td>
        <td><a href="/controllers/dashboard/Users/getUserCtrl.php"><img src="/public/assets/img/loupe.png" alt="icône loupe"></a>
            <a href="/controllers/dashboard/Users/deleteUserCtrl.php"><img class="ms-2" src="/public/assets/img/supprimer.png" alt="icône poubelle"></a>
        </td>
    </tr>
    <tr class="bgWhite">
        <td>Pseudo</td>
        <td>Mail</td>
        <td>Crée le</td>
        <td>Validé</td>
        <td>Commande</td>
        <td>Commentaires</td>
        <td><a href="/controllers/dashboard/Users/getUserCtrl.php"><img src="/public/assets/img/loupe.png" alt="icône loupe"></a>
            <a href="/controllers/dashboard/Users/deleteUserCtrl.php"><img class="ms-2" src="/public/assets/img/supprimer.png" alt="icône poubelle"></a>
        </td>
    </tr>
    <tr class="bgWhite">
        <td>Pseudo</td>
        <td>Mail</td>
        <td>Crée le</td>
        <td>Validé</td>
        <td>Commande</td>
        <td>Commentaires</td>
        <td><a href="/controllers/dashboard/Users/getUserCtrl.php"><img src="/public/assets/img/loupe.png" alt="icône loupe"></a>
            <a href="/controllers/dashboard/Users/deleteUserCtrl.php"><img class="ms-2" src="/public/assets/img/supprimer.png" alt="icône poubelle"></a>
        </td>
    </tr>
    <tr class="bgWhite">
        <td>Pseudo</td>
        <td>Mail</td>
        <td>Crée le</td>
        <td>Validé</td>
        <td>Commande</td>
        <td>Commentaires</td>
        <td><a href="/controllers/dashboard/Users/getUserCtrl.php"><img src="/public/assets/img/loupe.png" alt="icône loupe"></a>
            <a href="/controllers/dashboard/Users/deleteUserCtrl.php"><img class="ms-2" src="/public/assets/img/supprimer.png" alt="icône poubelle"></a>
        </td>
    </tr>
    <tr class="bgWhite">
        <td>Pseudo</td>
        <td>Mail</td>
        <td>Crée le</td>
        <td>Validé</td>
        <td>Commande</td>
        <td>Commentaires</td>
        <td><a href="/controllers/dashboard/Users/getUserCtrl.php"><img src="/public/assets/img/loupe.png" alt="icône loupe"></a>
            <a href="/controllers/dashboard/Users/deleteUserCtrl.php"><img class="ms-2" src="/public/assets/img/supprimer.png" alt="icône poubelle"></a>
        </td>
    </tr>
    <tr class="bgWhite">
        <td>Pseudo</td>
        <td>Mail</td>
        <td>Crée le</td>
        <td>Validé</td>
        <td>Commande</td>
        <td>Commentaires</td>
        <td><a href="/controllers/dashboard/Users/getUserCtrl.php"><img src="/public/assets/img/loupe.png" alt="icône loupe"></a>
            <a href="/controllers/dashboard/Users/deleteUserCtrl.php"><img class="ms-2" src="/public/assets/img/supprimer.png" alt="icône poubelle"></a>
        </td>
    </tr>
</table>