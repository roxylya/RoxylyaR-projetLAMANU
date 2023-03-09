<?php
include(__DIR__ . '/../../views/templates/headerUserAccount.php');

// Si le profil connecté est userAdmin 
// alors 
// include(_DIR_ . '/../views/dashboardCtrl.php');
// si le profil connecté est include(__DIR__ . '/../views/userAccount.php');
// alors
include(__DIR__ . '/../../views/userAccount/userAccount.php');

include(__DIR__ . '/../../views/templates/footer.php');
