<?php


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //Validar si existe el usuario

        if(!isset($_SESSION)){
            session_start();
        }

        $_SESSION['auth'] = true;

        var_dump($_SESSION['auth']);

        header("Location: /inicio");
    }


?>

<form method="POST">
    <label for="">Usuario</label>
    <input type="text" name="" id="">

    <label for="">Contraseña</label>
    <input type="text" name="" id="">

    <input type="submit" value="Iniciar Sesión">
</form>