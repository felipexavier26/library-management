<?php
session_start();
require '../../dominio/repositorios/UsuarioRepositorio.php';

use dominio\Repositorios\UsuarioRepositorio;

$usuarioRepo = new UsuarioRepositorio();
$usuarios = $usuarioRepo->listarUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.min.css">
</head>

<body style="background-color: #F4F6F9;">
    <div class="container mt-4 mb-5">
        <h1 class="text-center mb-4">Lista de Usuários</h1>


        <div class="d-flex justify-content-between mt-3">
            <a href="adicionar.php" class="btn btn-primary mb-3">Adicionar Novo Usuário</a>
            <a href="../../index.php" class="btn btn-secondary mb-3">Voltar o menu</a>
        </div>


        <table id="table" class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo de Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['tipoUsuario'] ?? 'Desconhecido'); ?></td>
                        <td>
                            <a href="editar.php?email=<?php echo urlencode($usuario['email']); ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="excluir.php?email=<?php echo urlencode($usuario['email']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../assets/js/app.js"></script>

</body>

</html>