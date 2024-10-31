<?php
namespace dominio\entidades;

class Pessoa {
    protected $nome;
    protected $email;

    public function __construct($nome, $email) {
        $this->nome = $nome;
        $this->email = $email;
    }

    public function getNome() { return $this->nome; }
    public function getEmail() { return $this->email; }
}

class Usuario extends Pessoa {
    protected $tipoUsuario;

    public function __construct($nome, $email, $tipoUsuario) {
        parent::__construct($nome, $email);
        $this->tipoUsuario = $tipoUsuario;
    }

    public function getTipoUsuario() { return $this->tipoUsuario; }
}
