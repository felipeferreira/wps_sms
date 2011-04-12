<?php

class Sms_grupo_usuario {

    private $id;
    private $descricao;
    private $ativo;
   
    function set_id($id) {
        $this->id = $id;
    }

    function set_descricao($descricao) {
        $this->descricao = $descricao;
    }

    function set_ativo($ativo) {
        $this->ativo = $ativo;
    }

    function get_id() {
        return $this->id;
    }

    function get_nome() {
        return $this->nome;
    }

    function get_descricao() {
        return $this->descricao;
    }

    function get_ativo() {
        return $this->ativa;
    }

}
?>