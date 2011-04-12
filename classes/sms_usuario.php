<?php

class Sms_usuario {

    private $id;
    private $nome;
    private $telefone;

    function set_id($id) {
        $this->id = $id;
    }

    function set_nome($nome) {
        $this->nome = $nome;
    }

    function set_telefone($telefone) {
        $this->telefone = $telefone;
    }

    function get_id() {
        return $this->id;
    }

    function get_nome() {
        return $this->nome;
    }

    function get_telefone() {
        return $this->telefone;
    }

}
?>