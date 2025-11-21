<?php

include_once('./libraries/functions.php');

//Inicialización
boot();

//Lógica de negocio
//Obtenemos id de la querystring

$db = conectarBD();
$id = $_SERVER["REQUEST_METHOD"] === "GET" ? filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT) : intval($_POST["id"]);
$usuario = getUserById($db, $id);

if ($id !== false) {
    

    if (isset($_POST['actualizar'])) {
        $userData = filter_input_array(INPUT_POST, [
            'nombre' => FILTER_DEFAULT,
            'email' => FILTER_VALIDATE_EMAIL,
            'rol' => FILTER_DEFAULT
        ]);

        var_dump($userData);

        if (!empty($userData['nombre']) && !empty($userData['email']) && !empty($userData['rol'])) {
            updateUser($db, $id, $userData['nombre'], $userData['email'], $userData['rol']);
        }
        header("Location: ./index_user.php");

    }

    
} else {
    header("Location: ./index_user.php");
}

//Lógica de presentación
include_once('./templates/edit_user.tpl.php');
?>