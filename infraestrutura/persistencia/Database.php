<?php
namespace Infraestrutura\Persistencia;

class Database {
    private $pdo;
    private $banco = __DIR__ . '/biblioteca.db'; 

    public function __construct() {
        try {
            $this->pdo = new \PDO("sqlite:" . $this->banco);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function criarTabelas() {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS livros (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            titulo TEXT NOT NULL,
            autor TEXT NOT NULL,
            isbn TEXT NOT NULL UNIQUE,
            disponivel BOOLEAN NOT NULL
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS usuarios (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            tipo_usuario TEXT NOT NULL
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS emprestimos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            usuario_id INTEGER NOT NULL,
            livro_id INTEGER NOT NULL,
            data_emprestimo TEXT NOT NULL,
            data_devolucao TEXT,
            FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
            FOREIGN KEY (livro_id) REFERENCES livros(id)
        )");
    }
}
