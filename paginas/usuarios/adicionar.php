<?php
require '../../dominio/entidades/Usuario.php';
require '../../dominio/repositorios/UsuarioRepositorio.php';

use dominio\entidades\Usuario;
use dominio\Repositorios\UsuarioRepositorio;

$usuarioRepo = new UsuarioRepositorio();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tipoUsuario = $_POST['tipoUsuario'];

    $usuario = new Usuario($nome, $email, $tipoUsuario);
    $usuarioRepo->salvarUsuario($usuario);
    header("Location: listar.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="background-color: #F4F6F9;">
    <div class="container mt-4">
        <h1 class="text-center mb-4"> Adicionar Usuário</h1>
        <form method="POST">
            <div class="form-group">
                <label for="nome"><b>Nome:</b></label>
                <input type="text" class="form-control" name="nome" required placeholder="Digite o nome">
            </div>

            <div class="form-group">
                <label for="email"><b>Email:</b></label>
                <input type="email" class="form-control" name="email" required placeholder="Digite o nome">
            </div>

            <div class="form-group">
                <label for="tipoUsuario"><b>Tipo de Usuário:</b></label>
                <select name="tipoUsuario" class="form-control" required>
                    <option value="">Selecione um Tipo de Usuário</option>
                    <option value="Aluno">Aluno</option>
                    <option value="Professor">Professor</option>
                </select>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-primary">Adicionar</button>
                <a href="listar.php" class="btn btn-secondary">Voltar para Listar Usuário</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>