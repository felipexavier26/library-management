<?php
require '../../dominio/repositorios/LivroRepositorio.php';

use dominio\Repositorios\LivroRepositorio;

$livroRepo = new LivroRepositorio();

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    if ($livroRepo->excluirLivro($isbn)) {
        header("Location: listar.php?msg=Livro excluído com sucesso!");
    } else {
        header("Location: listar.php?msg=Livro não encontrado.");
    }
    exit();
}
?>
