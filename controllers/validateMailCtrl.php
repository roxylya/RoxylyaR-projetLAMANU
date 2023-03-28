<?php

$id_users = intval(filter_input(INPUT_GET, 'id_users', FILTER_SANITIZE_NUMBER_INT));


$validationIsOk = User::updateValidate($id_users);

if($validationIsOk){
    session_start();
    $id_users = $_SESSION['id_users'];
    $user= User::getById($id_users);
}