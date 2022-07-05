<?php
    function conectarBD() : mysqli {
        $db = new mysqli('localhost', 'root', '1234', 'havtechnology');
        $db->query("SET NAMES 'utf8'");

        if(!$db){
            echo "No se pudo conectar";
            exit;
        }

        return $db;
    }