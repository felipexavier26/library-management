<?php
namespace dominio\entidades;

class Emprestimo {
    private $usuario; 
    private $livro;   
    private $dataEmprestimo;
    private $dataDevolucao;

    public function __construct(Usuario $usuario, Livro $livro) {
        $this->usuario = $usuario;
        $this->livro = $livro;
        $this->dataEmprestimo = date('d/m/Y H:i:s');
        
        $this->dataDevolucao = null;
    }

    public function devolver() {
        $this->dataDevolucao = date('d/m/Y H:i:s');
        $this->livro->devolver();
    }

    public function getUsuario() { return $this->usuario; }
    public function getLivro() { return $this->livro; }
    public function getDataEmprestimo() { return $this->dataEmprestimo; }
    public function getDataDevolucao() { return $this->dataDevolucao; }
}
