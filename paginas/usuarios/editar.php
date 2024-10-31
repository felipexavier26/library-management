<?php
require '../../dominio/entidades/Usuario.php';
require '../../dominio/repositorios/UsuarioRepositorio.php';

use dominio\entidades\Usuario;
use dominio\Repositorios\UsuarioRepositorio;

$usuarioRepo = new UsuarioRepositorio();
$email = $_GET['email'] ?? '';

$usuario = $usuarioRepo->buscarUsuario($email);
if (!$usuario) {
    die("Usuário não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $novoEmail = $_POST['email'];
    $tipoUsuario = $_POST['tipoUsuario'];

    try {
        if ($usuarioRepo->atualizarUsuario($email, $novoEmail, $nome, $tipoUsuario)) {
            echo "<script>alert('Usuário atualizado com sucesso!'); window.location.href = 'listar.php';</script>";
            exit();
        } else {
            echo "<script>alert('Erro ao atualizar usuário.');</script>";
        }
    } catch (\Exception $e) {
        echo "<script>alert('" . addslashes($e->getMessage()) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="background-color: #F4F6F9;">
    <div class="container mt-4">
        <h1 class="text-center mb-4">Editar Usuário</h1>
        <form method="POST">
            <div class="form-group">
                <label for="nome"><b>Nome:</b></label>
                <input type="text" class="form-control" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email"><b>E-mail:</b></label>
                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="tipoUsuario"><b>Tipo de Usuário:</b></label>
                <select name="tipoUsuario" class="form-control" required>
                    <option value="Aluno" <?php if ($usuario['tipoUsuario'] == 'Aluno') echo 'selected'; ?>>Aluno</option>
                    <option value="Professor" <?php if ($usuario['tipoUsuario'] == 'Professor') echo 'selected'; ?>>Professor</option>
                </select>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="listar.php" class="btn btn-secondary mt-2">Voltar para Listar Usuários</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>