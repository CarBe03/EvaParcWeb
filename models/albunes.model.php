<?php
require_once('../config/config.php');

class Albunes
{
    // Implementar los métodos de la clase

    public function todos() // Select * from albunes
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `albunes`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($album_id) // Select * from albunes where album_id = $album_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `albunes` WHERE `album_id` = $album_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($titulo, $genero, $year_lanzamiento, $discografica, $artista_id) // Insert into albunes (titulo, genero, year_lanzamiento, discografica, artista_id) values ($titulo, $genero, $year_lanzamiento, $discografica, $artista_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `albunes` (`titulo`, `genero`, `year_lanzamiento`, `discografica`, `artista_id`) 
                        VALUES ('$titulo', '$genero', '$year_lanzamiento', '$discografica', $artista_id)";
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

    public function actualizar($album_id, $titulo, $genero, $year_lanzamiento, $discografica, $artista_id) // Update albunes set titulo = $titulo, genero = $genero, year_lanzamiento = $year_lanzamiento, discografica = $discografica, artista_id = $artista_id where album_id = $album_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `albunes` 
                       SET `titulo`='$titulo', `genero`='$genero', `year_lanzamiento`='$year_lanzamiento', `discografica`='$discografica', `artista_id`=$artista_id 
                       WHERE `album_id` = $album_id";
            if (mysqli_query($con, $cadena)) {
                return $album_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($album_id) // Delete from albunes where album_id = $album_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `albunes` WHERE `album_id`= $album_id";
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
