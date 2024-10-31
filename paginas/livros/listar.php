<?php
require '../../dominio/repositorios/LivroRepositorio.php';

use dominio\Repositorios\LivroRepositorio;

$livroRepo = new LivroRepositorio();
$livros = $livroRepo->listarLivros();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Livros</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.min.css">
</head>

<body style="background-color: #F4F6F9;">
    <div class="container mt-4 mb-5">
        <h1 class="text-center mb-4">Lista de Livros</h1>


        <div class="d-flex justify-content-between mt-3">
            <a href="adicionar.php" class="btn btn-primary mb-3">Adicionar Novo Livro</a>
            <a href="../../index.php" class="btn btn-secondary mb-3">Voltar o menu</a>
        </div>
        
        <table id="table" class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>ISBN</th>
                    <th>Disponível</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livros as $livro): ?>
                    <tr>
                        <td><?= htmlspecialchars($livro['titulo']); ?></td>
                        <td><?= htmlspecialchars($livro['autor']); ?></td>
                        <td><?= htmlspecialchars($livro['isbn']); ?></td>
                        <td><?= $livro['disponivel'] ? 'Sim' : 'Não'; ?></td>
                        <td style="width: 150px;">
                            <a href="editar.php?isbn=<?= $livro['isbn']; ?>" class="btn btn-warning btn-sm">Editar</a>

                            <a href="excluir.php?isbn=<?= $livro['isbn']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este livro?');">Excluir</a>
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