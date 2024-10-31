<?php
require '../../dominio/entidades/Livro.php';
require '../../dominio/repositorios/LivroRepositorio.php';

use dominio\entidades\Livro;
use dominio\Repositorios\LivroRepositorio;

$livroRepo = new LivroRepositorio();

$isbn = $_GET['isbn'] ?? '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];

    $livroRepo->atualizarLivro($isbn, $titulo, $autor);
    echo "<script>alert('Livro atualizado com sucesso!'); window.location.href = 'listar.php';</script>";
    exit();
}

$livro = $livroRepo->buscarLivro($isbn);
if (!$livro) {
    die("Livro não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="background-color: #F4F6F9;">
    <div class="container mt-4">
        <h1 class="text-center mb-4">Editar Livro</h1>
        <form method="POST">
            <div class="form-group">
                <label for="titulo"><b>Título:</b></label>
                <input type="text" class="form-control" name="titulo" value="<?php echo htmlspecialchars($livro['titulo']); ?>" required>
            </div>
            <div class="form-group">
                <label for="autor"><b>Autor:</b></label>
                <input type="text" class="form-control" name="autor" value="<?php echo htmlspecialchars($livro['autor']); ?>" required>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="listar.php" class="btn btn-secondary mt-2">Voltar para Listar Livros</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>