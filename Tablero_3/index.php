<?php

/* Inicialización del entorno */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* Zona de declaración de funciones */
//Funciones de debugueo
function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}




//Función lógica presentación
function getTableroMArkup ($tablero, $ponerPersonaje){
    $cont =0;
    $output = '';
    //dump($tablero);
    foreach ($tablero as $filaIndex => $datosFila) {
        foreach ($datosFila as $columnaIndex => $tileType) {
            //dump($tileType);
            $cont++;
            if($cont == $ponerPersonaje){
            $output .= '<div class = "tile ' . $tileType . '"> <img src="betis.png" width="50px"; heihgt"50px";/></div>';
            }else{
             $output .= '<div class = "tile ' . $tileType . '"></div>';
            }
        }
    }
    return $output;
}


   $ponerPersonaje = null;

if((isset($_GET ['fila']) && isset($_GET ['col']))&&(($_GET ['fila']) <13  && ($_GET ['col'])<13)&&(($_GET ['fila']) >0  && ($_GET ['col'])>0)){
    $fila = $_GET ['fila'];
    $col = $_GET ['col'];
    $ponerPersonaje = (($fila*12-12) + ($col));
}

function posicionInvalida($ponerPersonaje){
    if(!isset($ponerPersonaje)){
        echo '<p>La posición es nula, menor que 1 o mayor que 12.</p>';
    }
}

//Lógica de negocio
//El tablero es un array bidimensional en el que cada fila contiene 12 palabras cuyos valores pueden ser:
// agua
//fuego
//tierra
// hierba
function leerArchivoCSV($archivoCSV) {
    $tablero = [];

    if (($puntero = fopen($archivoCSV, "r")) !== FALSE) {
        while (($datosFila = fgetcsv($puntero)) !== FALSE) {
            $tablero[] = $datosFila;
        }
        fclose($puntero);
    }

    return $tablero;
}

$tablero = leerArchivoCSV('contenido_tablero/contenido.csv');

//Lógica de presentación
$tableroMarkup = getTableroMArkup($tablero, $ponerPersonaje);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Minified version -->
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">

    <title>Document</title>
    <style>
        .contenedorTablero {
           max-width: 600px;
            width: 100%;
            height: 600px;
            border-radius: 5px;
            border: solid 2px grey;
            box-shadow: grey;
            display:grid;
            grid-template-rows:repeat(12, 1fr);
            grid-template-columns:repeat(12, 1fr);
        }
        .tile {
            /* width: 50px; */
            /* height: 50px; */
            float: left;
            margin: 0;
            padding: 0;
            border-width: 0;
            background-image: url('464.jpg');
            background-size: 209px;
        }
        .fuego {
        background-position: -105px -52px;

        }
        .tierra {
        background-position: -157px 0px;
        }
        .agua {
        background-position: -53px 0px;
        }
        .hierba {
        background-position: 0px 0px;
        }

        .mensaje{
        font-weight: bold;
        }

    </style>
</head>
<body>
    <h1>Tablero juego super rol DWES</h1>
    <div class="contenedorTablero">
        <?php echo $tableroMarkup; ?>
    </div>
    <div class="mensaje">
    <?php
        echo posicionInvalida($ponerPersonaje);
    ?>
    </div>

   
</body>
</html>