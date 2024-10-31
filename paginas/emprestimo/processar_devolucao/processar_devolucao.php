<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../dominio/repositorios/EmprestimoRepositorio.php';
require '../../dominio/repositorios/LivroRepositorio.php';
require '../../dominio/repositorios/UsuarioRepositorio.php';
require '../../dominio/entidades/Emprestimo.php';
require '../../dominio/entidades/Livro.php';
require '../../dominio/entidades/Usuario.php';

use dominio\Repositorios\EmprestimoRepositorio;
use dominio\Repositorios\LivroRepositorio;
use dominio\Repositorios\UsuarioRepositorio;
use dominio\entidades\Emprestimo;
use dominio\entidades\Usuario;
use dominio\entidades\Livro;

$emprestimoRepo = new EmprestimoRepositorio();
$livroRepo = new LivroRepositorio();
$usuarioRepo = new UsuarioRepositorio();
$msgErro = "";

if (isset($_GET['isbn']) && !empty($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    
    $emprestimos = $emprestimoRepo->listarEmprestimos();
    $emprestimo = null;

    foreach ($emprestimos as $e) {
        if ($e['livro']['isbn'] === $isbn && $e['dataDevolucao'] === null) {
            $emprestimo = $e;
            break;
        }
    }

    if ($emprestimo) {
        $emprestimo['dataDevolucao'] = date('d/m/Y H:i:s');
        $emprestimoRepo->atualizarEmprestimo($emprestimo);
        $livroRepo->atualizarLivro($isbn, $emprestimo['livro']['titulo'], $emprestimo['livro']['autor'], true);
        
        header("Location: emprestimo.php?msg=Devolução registrada com sucesso");
        exit();
    } else {
        $msgErro = "Empréstimo não encontrado ou já devolvido.";
    }
} else {
    $msgErro = "ISBN inválido.";
}
?>
