<?php
require './processar_devolucao/processar_devolucao.php'
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devolução de Empréstimos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1>Devolução de Empréstimos</h1>

        <?php if (!empty($msgErro)) echo "<div class='alert alert-danger'>$msgErro</div>"; ?>
        <a href="emprestimo.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>
</html>
