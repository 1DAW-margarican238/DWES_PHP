<?php
function boot(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 
}

function dumpObjectStructure($obj){
    if(is_object($obj)){
        echo 'ESTRUCTURA OBJETO';
        $rco = new ReflectionClass($obj);
        $structure = [
            'atributos' => $rco->getProperties(),
            'metodos' => $rco->getMethods()
        ];
        echo '<pre>'.print_r($structure,true).'</pre>';
    }else{
        echo "La variable no es un objeto";
    }
}

function dump($var){
    echo '<pre>'.print_r($var,true).'</pre>';
}

function clearFileContent($ruta){
    $fhandler = fopen($ruta, 'w');
    fclose($fhandler);
}


// function getData(){
//     $db = new PDO("mysql:host=localhost;dbname=crud_mysql", "crud_mysql", "crud_mysql");
//     return ($db->query('SELECT * FROM usuarios'));
// }

function conectarBD(){
    try {
        $db = new PDO("mysql:host=localhost;dbname=crud_mysql;charset=utf8", "crud_mysql", "crud_mysql");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
        return $db; 
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        return null; 
    }
}


function getData($source, $db  = '', $ruta = '', $campoId = '' ){
    if ($source == 'csv'){
        $data = array();
        if($handler = fopen($ruta, 'r')){
            $cabeceras = fgetcsv($handler, 1000, ",");
            if(!empty($campoId)){
                $campoIndex = array_search($campoId,$cabeceras);
            }else{
                $campoIndex = null;
            }
            while (($lineData = fgetcsv($handler, 1000, ",")) !== FALSE) {
                if(isset($campoIndex)){
                    // dump($cabeceras);
                    // dump($lineData);
                    $data[$lineData[$campoIndex]] = array_combine($cabeceras,$lineData);
                }else{
                    $data[] = array_combine($cabeceras,$lineData);
                }
            }
            return $data;
        }else{
            return null;
        }
    }else if ($source == 'db'){
        $mostrar = $db->query('SELECT * FROM usuarios');
        return $mostrar;
    }
}



function insertUser($db){
if(isset($_POST['crear'])){
    $userData = filter_input_array(INPUT_POST,[
        'nombre' => FILTER_DEFAULT,
        'email' => FILTER_VALIDATE_EMAIL,
        'rol' => FILTER_DEFAULT
    ]);
    

        // Usar prepared statement
        $insert = $db->prepare("INSERT INTO usuarios (nombre, email, rol, fecha_alta) VALUES (?, ?, ?, NOW())");

        return $insert->execute([
            $userData['nombre'],
            $userData['email'],
            $userData['rol']
        ]);
}
}

 
function getUserById($db, $id) {

    $get = $db->prepare("SELECT nombre, email, rol FROM usuarios WHERE id = :id");
    $get->bindParam(':id', $id, PDO::PARAM_INT);
    $get->execute();

    $usuario = $get->fetch(PDO::FETCH_ASSOC);
    
    if ($usuario) {
        return $usuario;
    } else {
        return null;
    }
    
}





function updateUser($db, $id, $nombre, $email, $rol) {
   $update = $db->prepare("UPDATE usuarios SET nombre = :nombre, email = :email, rol = :rol WHERE id = :id");
    $update->bindParam("nombre", $nombre, PDO::PARAM_STR);
    $update->bindParam("email", $email, PDO::PARAM_STR);
    $update->bindParam("rol", $rol, PDO::PARAM_STR);
    $update->bindParam("id", $id, PDO::PARAM_INT);
    $update->execute();
}


function deleteUser($db, $id) {
    $delete = $db->prepare("DELETE FROM usuarios WHERE id = :id");
    $delete->bindParam(":id", $id, PDO::PARAM_INT);
    return $delete->execute();
    
}







?>