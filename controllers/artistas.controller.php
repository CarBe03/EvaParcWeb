<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Controlador de Artistas

require_once('../models/artistas.model.php');
error_reporting(0);
$artistas = new Artistas;

switch ($_GET["op"]) {
    // Operaciones de Artistas

    case 'todos': // Procedimiento para cargar todos los datos de los artistas
        $datos = array();
        $datos = $artistas->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': // Procedimiento para obtener un registro de la base de datos
        $artista_id = $_POST["artista_id"];
        $datos = array();
        $datos = $artistas->uno($artista_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar': // Procedimiento para insertar un artista en la base de datos
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $nacionalidad = $_POST["nacionalidad"];

        $datos = array();
        $datos = $artistas->insertar($nombre, $apellido, $fecha_nacimiento, $nacionalidad);
        echo json_encode($datos);
        break;

    case 'actualizar': // Procedimiento para actualizar un artista en la base de datos
        $artista_id = $_POST["artista_id"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $nacionalidad = $_POST["nacionalidad"];
        
        $datos = array();
        $datos = $artistas->actualizar($artista_id, $nombre, $apellido, $fecha_nacimiento, $nacionalidad);
        echo json_encode($datos);
        break;

    case 'eliminar': // Procedimiento para eliminar un artista en la base de datos
        $artista_id = $_POST["artista_id"];
        $datos = array();
        $datos = $artistas->eliminar($artista_id);
        echo json_encode($datos);
        break;
}
?>
