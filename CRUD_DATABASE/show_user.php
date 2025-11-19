<?php

include_once('libraries/functions.php');

// Inicialización
boot();

// Lógica de negocio
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);  
// Obtenemos el ID de la querystring

if ($id !== false) {
    $db = conectarBD();
    $usuario = getUserById($db, $id);
} else {
    header("Location: ./index_user.php");
    exit;
}

// Lógica de presentación
include_once('./templates/show_user.tpl.php');
?>
