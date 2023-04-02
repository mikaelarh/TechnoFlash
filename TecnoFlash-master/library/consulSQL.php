<?php

class ejecutarSQL {

    public static function conectar() {
        $host_db = "localhost"; // Host de la BD
        $usuario_db = "root"; // Usuario de la BD
        $clave_db = ""; // Contraseña de la BD
        $nombre_db = "store"; // Nombre de la BD  
        
        if(!$con = new mysqli($host_db, $usuario_db, $clave_db, $nombre_db)){
            die("Error en el servidor, verifique sus datos");
        }
        
        return $con;
    }

    public static function consultar($query) {
        $consul=mysqli_query(ejecutarSQL::conectar(),$query) or die ("Problemas al insertar".mysqli_error(ejecutarSQL::conectar()));
        return $consul;
    }

}

/* Clase para hacer las consultas Insertar, Eliminar y Actualizar */

class consultasSQL {

    public static function InsertSQL($tabla, $campos, $valores) {
        if (!$consul = ejecutarSQL::consultar("insert into $tabla ($campos) VALUES($valores)")) {
            die("Ha ocurrido un error al insertar los datos en la tabla $tabla");
        }
        return $consul;
    }

    public static function DeleteSQL($tabla, $condicion) {
        if (!$consul = ejecutarSQL::consultar("delete from $tabla where $condicion")) {
            die("Ha ocurrido un error al eliminar los registros en la tabla $tabla");
        }
        return $consul;
    }

    public static function UpdateSQL($tabla, $campos, $condicion) {
        if (!$consul = ejecutarSQL::consultar("update $tabla set $campos where $condicion")) {
            die("Ha ocurrido un error al actualizar los datos en la tabla $tabla");
        }
        return $consul;
    }

}
