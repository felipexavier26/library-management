<?php
require '../../dominio/repositorios/LivroRepositorio.php';
require '../../dominio/repositorios/UsuarioRepositorio.php';
require '../../dominio/repositorios/EmprestimoRepositorio.php';
require '../../dominio/entidades/Emprestimo.php';
require '../../dominio/entidades/Usuario.php';
require '../../dominio/entidades/Livro.php';

use dominio\Repositorios\LivroRepositorio;
use dominio\Repositorios\UsuarioRepositorio;
use dominio\Repositorios\EmprestimoRepositorio;
use dominio\entidades\Emprestimo;
use dominio\entidades\Usuario;
use dominio\entidades\Livro;

$livroRepo = new LivroRepositorio();
$usuarioRepo = new UsuarioRepositorio();
$emprestimoRepo = new EmprestimoRepositorio();
$msgSucesso = "";
$msgErro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['usuario'], $_POST['livro'])) {
    $usuarioData = $usuarioRepo->buscarUsuario($_POST['usuario']);
    $livroData = $livroRepo->buscarLivro($_POST['livro']);

    if ($usuarioData && $livroData && $livroData['disponivel']) {
        $usuario = new Usuario(
            $usuarioData['nome'],
            $usuarioData['email'],
            $usuarioData['tipoUsuario']
        );

        $livro = new Livro(
            $livroData['isbn'],
            $livroData['titulo'],
            $livroData['autor'],
            $livroData['disponivel']
        );

        $novoEmprestimo = new Emprestimo($usuario, $livro);
        $emprestimoRepo->salvarEmprestimo($novoEmprestimo);

        $livroRepo->atualizarLivro($livroData['isbn'], $livroData['titulo'], $livroData['autor'], false);

        $msgSucesso = "Empréstimo registrado com sucesso!";
    } else {
        $msgErro = "Livro indisponível ou usuário inválido.";
    }
}

$emprestimos = $emprestimoRepo->listarEmprestimos();
$livrosDisponiveis = array_filter($livroRepo->listarLivros(), fn($livro) => $livro['disponivel']);
$usuarios = $usuarioRepo->listarUsuarios();
?>
