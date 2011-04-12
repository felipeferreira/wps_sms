<?php

class Sms_mensagem {

    private $id;
    private $descricao;
    private $valor;
    private $ativa;
    private $intervalo_padrao;
    private $intervalo_atual;
    private $sql;

    function set_id($id) {
        $this->id = $id;
    }

    function set_descricao($descricao) {
        $this->descricao = $descricao;
    }

    function set_valor($valor) {
        $this->valor = $valor;
    }

    function set_ativa($ativa) {
        $this->ativa = $ativa;
    }

    function set_intervalo_padrao($intervalo_padrao) {
        $this->intervalo_padrao = $intervalo_padrao;
    }

    function set_intervalo_atual($intervalo_atual) {
        $this->intervalo_atual = $intervalo_atual;
    }

    function set_sql($sql) {
        $this->sql = $sql;
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

    function get_valor() {
        return $this->valor;
    }

    function get_ativa() {
        return $this->ativa;
    }

    function get_intervalo_padrao() {
        return $this->intervalo_padrao;
    }

    function get_intervalo_atual() {
        return $this->intervalo_atual;
    }

    function get_sql() {
        return $this->sql;
    }
}
?>