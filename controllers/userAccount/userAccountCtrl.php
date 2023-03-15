<?php
include(__DIR__ . '/../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../views/userAccount/userAccount.php');
include(__DIR__ . '/../../views/templates/footer.php');

try {

} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../controllers/errorCtrl.php');
    die;
}