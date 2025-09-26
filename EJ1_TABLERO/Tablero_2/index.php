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



$ponerPersonaje =rand(0,143);


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



    </style>
</head>
<body>
    <h1>Tablero juego super rol DWES</h1>
    <div class="contenedorTablero">
        <?php echo $tableroMarkup; ?>
    </div>
</body>
</html>