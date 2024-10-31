<?php
namespace Infra;

class Persistencia {
    public static function carregar($arquivo) {
        if (!file_exists($arquivo)) return [];
        return json_decode(file_get_contents($arquivo), true);
    }

    public static function salvar($arquivo, $dados) {
        file_put_contents($arquivo, json_encode($dados));
    }
}
?>
