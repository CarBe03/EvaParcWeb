<?php
require_once('../config/config.php');

class Artistas
{
    // Implementar los métodos de la clase

    public function todos() // Select * from artistas
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `artistas`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($artista_id) // Select * from artistas where artista_id = $artista_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `artistas` WHERE `artista_id` = $artista_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($nombre, $apellido, $fecha_nacimiento, $nacionalidad) // Insert into artistas (nombre, apellido, fecha_nacimiento, nacionalidad) values ($nombre, $apellido, $fecha_nacimiento, $nacionalidad)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `artistas` (`nombre`, `apellido`, `fecha_nacimiento`, `nacionalidad`) 
                        VALUES ('$nombre', '$apellido', '$fecha_nacimiento', '$nacionalidad')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function actualizar($artista_id, $nombre, $apellido, $fecha_nacimiento, $nacionalidad) // Update artistas set nombre = $nombre, apellido = $apellido, fecha_nacimiento = $fecha_nacimiento, nacionalidad = $nacionalidad where artista_id = $artista_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `artistas` 
                       SET `nombre`='$nombre', `apellido`='$apellido', `fecha_nacimiento`='$fecha_nacimiento', `nacionalidad`='$nacionalidad' 
                       WHERE `artista_id` = $artista_id";
            if (mysqli_query($con, $cadena)) {
                return $artista_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($artista_id) // Delete from artistas where artista_id = $artista_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `artistas` WHERE `artista_id`= $artista_id";
            if (mysqli_query($con, $cadena)) {
                return 1;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}
?>
