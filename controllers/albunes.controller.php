<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Controlador de Albunes

require_once('../models/albunes.model.php');
error_reporting(0);
$albunes = new Albunes;

switch ($_GET["op"]) {
    // Operaciones de Álbumes

    case 'todos': // Procedimiento para cargar todos los datos de los álbumes
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase albunes.model.php
        $datos = $albunes->todos(); // Llamo al método todos de la clase albunes.model.php
        while ($row = mysqli_fetch_assoc($datos)) // Ciclo de repetición para asociar los valores almacenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': // Procedimiento para obtener un registro de la base de datos
        $album_id = $_POST["album_id"];
        $datos = array();
        $datos = $albunes->uno($album_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar': // Procedimiento para insertar un álbum en la base de datos
        $titulo = $_POST["titulo"];
        $genero = $_POST["genero"];
        $year_lanzamiento = $_POST["year_lanzamiento"];
        $discografica = $_POST["discografica"];
        $artista_id = $_POST["artista_id"];

        $datos = array();
        $datos = $albunes->insertar($titulo, $genero, $year_lanzamiento, $discografica, $artista_id);
        echo json_encode($datos);
        break;

    case 'actualizar': // Procedimiento para actualizar un álbum en la base de datos
        $album_id = $_POST["album_id"];
        $titulo = $_POST["titulo"];
        $genero = $_POST["genero"];
        $year_lanzamiento = $_POST["year_lanzamiento"];
        $discografica = $_POST["discografica"];
        $artista_id = $_POST["artista_id"];
        
        $datos = array();
        $datos = $albunes->actualizar($album_id, $titulo, $genero, $year_lanzamiento, $discografica, $artista_id);
        echo json_encode($datos);
        break;

    case 'eliminar': // Procedimiento para eliminar un álbum en la base de datos
        $album_id = $_POST["album_id"];
        $datos = array();
        $datos = $albunes->eliminar($album_id);
        echo json_encode($datos);
        break;
}
?>
