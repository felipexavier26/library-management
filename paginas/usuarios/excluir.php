<?php
require '../../dominio/repositorios/UsuarioRepositorio.php';

use dominio\Repositorios\UsuarioRepositorio;

$usuarioRepo = new UsuarioRepositorio();

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $usuarioRepo->excluirUsuario($email);
    header("Location: listar.php");
    exit();
}
?>
