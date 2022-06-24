<?php

    define('TEMPLATES_URL', __DIR__ . '/templates');
    define('FUNCIONES_URL', __DIR__ . '/funciones');
    define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

    function incluirTemplate(string $nombre, bool $inicio = false){
        include TEMPLATES_URL . "/${nombre}.php";
    }

    function autenticado() : void {
        session_start();

        if(!$_SESSION['login']){
            header('Location: /login');
        }
    }

    function debug($variable){
        echo "<pre>";
        var_dump($variable);
        echo "</pre>";
        exit;
    }

    //Escapar (Sanitizar) HTML
    function s($html) : string{
        return htmlspecialchars($html);
    }

    //Validar tipo de contenido
    function validarTipoContenido($tipo){
        $tipos = ['vendedor', 'propiedad'];
        return in_array($tipo, $tipos);
    }

    //Muestra los mensajes
    function mostrarNotificacion($codigo){
        $mensaje = '';

        switch ($codigo){
            case 1: 
                $mensaje = 'Creado correctamente';
                break; 

            case 2: 
                $mensaje = 'Actualizado correctamente';
                break;
        
            case 3: 
                $mensaje = 'Eliminado correctamente';
                break;

            default:
                $mensaje = false;
                break;
        }
        return $mensaje;
    }

    //Valida que el id pasado en el método GET sea un número, de no ser así, redirecciona
    function validarORedireccionar(string $url){
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id){
            header('Location: ' . $url);
        }
        return $id;
    }    

    function eliminar_acentos($cadena){
		
		//Reemplazamos la A y a
		$cadena = str_replace(
    		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
		    array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
		$cadena
		);

		//Reemplazamos la E y e
		$cadena = str_replace(
		    array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
		    array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
		$cadena );

		//Reemplazamos la I y i
		$cadena = str_replace(
		    array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
		    array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
		$cadena );

		//Reemplazamos la O y o
		$cadena = str_replace(
		    array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
		    array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
		$cadena );

		//Reemplazamos la U y u
		$cadena = str_replace(
		    array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
		    array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
		$cadena );

		//Reemplazamos la N, n, C y c
		$cadena = str_replace(
		    array('Ñ', 'ñ', 'Ç', 'ç'),
		    array('N', 'n', 'C', 'c'),
		$cadena
		);
		
		return $cadena;
	}