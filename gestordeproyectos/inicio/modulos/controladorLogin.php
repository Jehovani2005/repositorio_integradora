<?php
    require_once '../clases/login.php';
    $usuario=$_POST['correo'];
    $pass=$_POST['contrasena'];

    $login=new Login($usuario,$pass);

    $login->validar();
    if($_SESSION['validada']==1)
            header("location: ../index.php");
    else
    header("Location: ../../iniciosesion.php?error=1");
?>