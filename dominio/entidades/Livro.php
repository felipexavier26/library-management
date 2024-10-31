<?php
namespace dominio\entidades;

class Livro {
    private $titulo;
    private $autor;
    private $isbn;
    private $disponivel;

    public function __construct($titulo, $autor, $isbn) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->isbn = $isbn;
        $this->disponivel = true;
    }

    public function emprestar() {
        $this->disponivel = false;
    }

    public function devolver() {
        $this->disponivel = true;
    }

    public function isDisponivel() {
        return $this->disponivel;
    }

    public function getTitulo() { return $this->titulo; }
    public function getAutor() { return $this->autor; }
    public function getIsbn() { return $this->isbn; }
}
