<?php
include(__DIR__ . '/../views/templates/header.php');

// Si le profil connecté est userAdmin 
// alors 
// include(_DIR_ . '/../views/admin.php');
// si le profil connecté est user
// alors
include(__DIR__ . '/../views/userCount.php');

include(__DIR__ . '/../views/templates/footer.php');
