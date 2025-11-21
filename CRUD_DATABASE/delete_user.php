<?php
include_once('./libraries/functions.php');

boot();
$db = conectarBD();

$id = $_GET['id'];   
$usuario = getUserById($db, $id); 


if (isset($_POST['confirmar'])) {
    deleteUser($db, $id);
    header("Location: index_user.php");
    exit;
}

if (isset($_POST['volver'])) {
    header("Location: index_user.php");
    exit;
}

include('./templates/delete_user.tpl.php');
