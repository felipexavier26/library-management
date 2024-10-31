<?php

namespace dominio\Repositorios;

use dominio\entidades\Emprestimo;

class EmprestimoRepositorio
{
    private $caminhoArquivo = __DIR__ . '/emprestimos.json';

    public function salvarEmprestimo(Emprestimo $emprestimo)
    {
        $emprestimos = $this->listarEmprestimos();
        $emprestimos[] = [
            'usuario' => [
                'nome' => $emprestimo->getUsuario()->getNome(),
                'email' => $emprestimo->getUsuario()->getEmail(),
                'tipoUsuario' => $emprestimo->getUsuario()->getTipoUsuario()
            ],
            'livro' => [
                'titulo' => $emprestimo->getLivro()->getTitulo(),
                'isbn' => $emprestimo->getLivro()->getIsbn(),
            ],
            'dataEmprestimo' => $emprestimo->getDataEmprestimo(),
            'dataDevolucao' => $emprestimo->getDataDevolucao()
        ];
        file_put_contents($this->caminhoArquivo, json_encode($emprestimos));
    }

    public function listarEmprestimos()
    {
        if (!file_exists($this->caminhoArquivo)) return [];
        return json_decode(file_get_contents($this->caminhoArquivo), true);
    }

    public function atualizarEmprestimo($emprestimoAtualizado)
    {
        $emprestimos = $this->listarEmprestimos(); 

        foreach ($emprestimos as $key => $emprestimo) {
            if (
                $emprestimo['livro']['isbn'] === $emprestimoAtualizado['livro']['isbn'] &&
                $emprestimo['dataDevolucao'] === null
            ) {
                $emprestimos[$key] = $emprestimoAtualizado; 
                file_put_contents($this->caminhoArquivo, json_encode($emprestimos, JSON_PRETTY_PRINT)); 
                return; 
            }
        }
    }


    public function excluirEmprestimo($isbn)
    {
        $emprestimos = $this->listarEmprestimos();
        foreach ($emprestimos as $indice => $emprestimo) {
            if ($emprestimo['livro']['isbn'] === $isbn) {
                unset($emprestimos[$indice]);
                file_put_contents($this->caminhoArquivo, json_encode(array_values($emprestimos)));
                return true;
            }
        }
        return false;
    }
}
