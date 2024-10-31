<?php

namespace dominio\Repositorios;

use dominio\entidades\Livro;

class LivroRepositorio
{
    private $caminhoArquivo;

    public function __construct()
    {
        $this->caminhoArquivo = __DIR__ . '/livros.json';
    }

    public function salvarLivro(Livro $livro)
    {
        $livros = $this->listarLivros();
        $livros[$livro->getIsbn()] = [
            'titulo' => $livro->getTitulo(),
            'autor' => $livro->getAutor(),
            'isbn' => $livro->getIsbn(),
            'disponivel' => true
        ];
        return file_put_contents($this->caminhoArquivo, json_encode($livros, JSON_PRETTY_PRINT)) !== false;
    }

    public function listarLivros()
    {
        if (!file_exists($this->caminhoArquivo)) return [];

        $livrosArray = json_decode(file_get_contents($this->caminhoArquivo), true);
        $livrosAssociativos = [];

        foreach ($livrosArray as $livro) {
            $livrosAssociativos[$livro['isbn']] = $livro;
        }

        return $livrosAssociativos;
    }

    // public function buscarLivro($isbn)
    // {
    //     $livros = $this->listarLivros();
    //     if (isset($livros[$isbn])) {
    //         $livroData = $livros[$isbn];
    //         // Cria e retorna um objeto Livro ao invés de um array
    //         return new Livro(
    //             $livroData['titulo'],
    //             $livroData['autor'],
    //             $livroData['isbn']
    //         );
    //     }
    //     return null; // Retorna null se o livro não for encontrado
    // }


    public function buscarLivro($isbn)
    {
        $livros = $this->listarLivros();
        return $livros[$isbn] ?? null;
    }


    public function atualizarLivro($isbn, $titulo, $autor)
    {
        $livros = $this->listarLivros();
        if (isset($livros[$isbn])) {
            $livros[$isbn]['titulo'] = $titulo;
            $livros[$isbn]['autor'] = $autor;
            return file_put_contents($this->caminhoArquivo, json_encode($livros, JSON_PRETTY_PRINT)) !== false;
        }
        return false;
    }

    public function excluirLivro($isbn)
    {
        $livros = $this->listarLivros();
        if (isset($livros[$isbn])) {
            unset($livros[$isbn]);
            return file_put_contents($this->caminhoArquivo, json_encode($livros, JSON_PRETTY_PRINT)) !== false;
        }
        return false;
    }
}
