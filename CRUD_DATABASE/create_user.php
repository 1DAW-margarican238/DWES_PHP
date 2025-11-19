<?php

include_once('./libraries/functions.php');

//Inicialización
boot();

//Lógica de negocio
$mensaje = '';
$db = conectarBD();
insertUser($db);
//Lógica de presentación
//Presenta el html a partir de los datos en el CSV
include_once('./templates/create_users.tpl.php');
?>