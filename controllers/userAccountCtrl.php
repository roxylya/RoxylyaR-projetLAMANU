<?php
include(__DIR__ . '/../views/templates/headerUserAccount.php');

// Si le profil connecté est userAdmin 
// alors 
// include(_DIR_ . '/../views/admin.php');
// si le profil connecté est user
// alors
include(__DIR__ . '/../views/userAccount.php');

include(__DIR__ . '/../views/templates/footer.php');
