<?php

namespace dominio\Repositorios;
use dominio\entidades\Usuario;
class UsuarioRepositorio
{
    private $caminhoArquivo = __DIR__ . '/usuarios.json';

    public function salvarUsuario(Usuario $usuario)
    {
        $usuarios = $this->listarUsuarios();

        foreach ($usuarios as $user) {
            if ($user['email'] === $usuario->getEmail()) {
                throw new \Exception("Usuário com este email já existe.");
            }
        }

        $usuarios[] = [
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'tipoUsuario' => $usuario->getTipoUsuario()
        ];
        file_put_contents($this->caminhoArquivo, json_encode($usuarios, JSON_PRETTY_PRINT));
    }

    public function listarUsuarios()
    {
        if (!file_exists($this->caminhoArquivo)) return [];
        return json_decode(file_get_contents($this->caminhoArquivo), true);
    }

    public function atualizarUsuario($emailAntigo, $novoEmail, $nome, $tipoUsuario)
    {
        $usuarios = $this->listarUsuarios(); 

        foreach ($usuarios as $usuario) {
            if ($usuario['email'] === $novoEmail && $usuario['email'] !== $emailAntigo) {
                throw new \Exception("Usuário com este email já existe.");
            }
        }

        foreach ($usuarios as $indice => $usuario) {
            if ($usuario['email'] === $emailAntigo) {
                $usuarios[$indice]['nome'] = $nome;
                $usuarios[$indice]['email'] = $novoEmail; 
                $usuarios[$indice]['tipoUsuario'] = $tipoUsuario;

                return file_put_contents($this->caminhoArquivo, json_encode($usuarios, JSON_PRETTY_PRINT)) !== false;
            }
        }

        return false; 
    }

    public function buscarUsuario($email)
    {
        $usuarios = $this->listarUsuarios();
        foreach ($usuarios as $usuario) {
            if ($usuario['email'] === $email) {
                return $usuario;
            }
        }
        return null;
    }

    public function excluirUsuario($email)
    {
        $usuarios = $this->listarUsuarios();
        foreach ($usuarios as $indice => $usuario) {
            if ($usuario['email'] === $email) {
                unset($usuarios[$indice]);
                file_put_contents($this->caminhoArquivo, json_encode(array_values($usuarios), JSON_PRETTY_PRINT));
                return true;
            }
        }
        return false; 
    }
}
