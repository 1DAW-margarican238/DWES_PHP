<?php

include_once('./libraries/functions.php');

//Inicialización
boot();

//Lógica de negocio
//Obtenemos id de la querystring
$id = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);

if ($id !== false) {
    $db = conectarBD();

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
    }

    $usuario = getUserById($db, $id);
    if ($usuario === null) {
        header("Location: ./index_user.php");
        exit;
    }
} else {
    header("Location: ./index_user.php");
    exit;
}

//Lógica de presentación
//Presenta el html a partir de los datos en el CSV
include_once('./templates/edit_user.tpl.php');
?>