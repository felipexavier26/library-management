<?php
namespace dominio\Servicos;

use dominio\Repositorios\EmprestimoRepositorio;
use dominio\Repositorios\LivroRepositorio;
use dominio\entidades\Emprestimo;
use dominio\entidades\Usuario;
use dominio\entidades\Livro;

class EmprestimoServico {
    private $emprestimoRepositorio;
    private $livroRepositorio;

    public function __construct(EmprestimoRepositorio $emprestimoRepo, LivroRepositorio $livroRepo) {
        $this->emprestimoRepositorio = $emprestimoRepo;
        $this->livroRepositorio = $livroRepo;
    }

    public function realizarEmprestimo(Usuario $usuario, Livro $livro) {
        if (!$livro->isDisponivel()) {
            return "Livro não disponível para empréstimo.";
        }

        $emprestimo = new Emprestimo($usuario, $livro);
        $livro->emprestar();
        $this->emprestimoRepositorio->salvarEmprestimo($emprestimo); 
        return "Empréstimo realizado com sucesso.";
    }
}
