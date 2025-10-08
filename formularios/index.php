<?php

/***** Inicialización del entorno ******/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//*****+++Lógica de presentación*******

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Minified version -->
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <title>Document</title>
</head>
<body>
    <h1>Ejemplo formulario DWES</h1>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<!-- probar todos los tipos de input -->
        <input type="text" name="clave_del_campo">
        <input type="submit" value="Enviar">
        
    </form>
</body>
</html>