<?php

// include_once 'autoload.php';
include_once "index5.php";

$usuario_default = "usuario";
$pass_default = "usuario";

$usuario_admin = "admin";
$pass_admin = "admin";

$usuario = $_POST["user"];
$pass = $_POST["password"];

if ($usuario == $usuario_default && $pass == $pass_default){
    session_start();
    $_SESSION["user"] = $usuario;
    header("location: main.php");
    exit();
} elseif ($usuario == $usuario_admin && $pass == $pass_admin){
    session_start();
    $_SESSION['user'] = $usuario;
    $_SESSION['socios'] = $vc->listarSocios();
    $_SESSION['productos'] = $vc->listarSocios();
    
    header('location:mainAdmin.php');
}else {
    header('location:index.php?errores=login');
}
?>