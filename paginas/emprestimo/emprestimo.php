<?php
require './processar_emprestimo/processar_emprestimo.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empréstimos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.min.css">

</head>

<body style="background-color: #F4F6F9;">
    <div class="container mt-4 mb-5">
        <h1 class="text-center">Empréstimo de Livros</h1>

        <?php if (!empty($msgErro)): ?>
            <div class='alert alert-danger'><?= htmlspecialchars($msgErro); ?></div>
        <?php endif; ?>

        <?php if (!empty($msgSucesso)): ?>
            <div class='alert alert-success'><?= htmlspecialchars($msgSucesso); ?></div>
            <script>
                setTimeout(function() {
                    window.location.href = "emprestimo.php";
                }, 3000);
            </script>
        <?php endif; ?>

        <form method="POST" class="mt-3 mb-2">
            <h3>Registrar Novo Empréstimo</h3>

            <div class="container mt-4 mb-5">
                <div class="row"> 
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="usuario">Selecionar Usuário:</label>
                            <select name="usuario" class="form-control" required>
                                <option value="">Selecione um usuário</option>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <option value="<?= htmlspecialchars($usuario['email']); ?>"><?= htmlspecialchars($usuario['nome']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="livro">Selecionar Livro:</label>
                            <select name="livro" class="form-control" required>
                                <option value="">Selecione um livro disponível</option>
                                <?php foreach ($livrosDisponiveis as $livro): ?>
                                    <option value="<?= htmlspecialchars($livro['isbn']); ?>"><?= htmlspecialchars($livro['titulo']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Registrar Empréstimo</button>
            </div>


        </form>

        <h3 class="mb-4">Empréstimos Atuais</h3>

        <table id="table" class="table table-striped">
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Livro</th>
                    <th>Data e Hora de Empréstimo</th>
                    <th>Data e Hora de Devolução</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emprestimos as $emprestimo): ?>
                    <tr>
                        <td><?= htmlspecialchars($emprestimo['usuario']['nome']); ?></td>
                        <td><?= htmlspecialchars($emprestimo['livro']['titulo']); ?></td>
                        <td><?= htmlspecialchars($emprestimo['dataEmprestimo']); ?></td>
                        <td>
                            <?php
                            if (isset($emprestimo['dataDevolucao'])) {
                                echo htmlspecialchars($emprestimo['dataDevolucao']);
                            } else {
                                echo 'Em Aberto';
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($emprestimo['dataDevolucao'] === null): ?>
                                <a href="devolver.php?isbn=<?= $emprestimo['livro']['isbn']; ?>" class="btn btn-success btn-sm">Devolver</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="../../index.php" class="btn btn-secondary mt-3">Voltar para o menu</a>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../assets/js/app.js"></script>

</body>

</html>