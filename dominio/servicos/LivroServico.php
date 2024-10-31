<?php
namespace dominio\Servicos;

use dominio\Repositorios\LivroRepositorio;
use dominio\entidades\Usuario;
use dominio\entidades\Livro;

class LivroServico {
    private $livroRepositorio;

    public function __construct(LivroRepositorio $livroRepo) {
        $this->livroRepositorio = $livroRepo;
    }

    public function emprestarLivro(Usuario $usuario, $isbn) {
        $livros = $this->livroRepositorio->listarLivros();
        foreach ($livros as $livroData) {
            if ($livroData['isbn'] === $isbn && $livroData['disponivel']) {
                $livro = new Livro($livroData['titulo'], $livroData['autor'], $livroData['isbn']);
                $livro->emprestar();
                $this->livroRepositorio->salvarLivro($livro);
                return "Livro emprestado com sucesso.";
            }
        }
        return "Livro não disponível.";
    }
}
