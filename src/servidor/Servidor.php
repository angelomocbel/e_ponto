<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servidor
 *
 * @author migue_000
 */

include_once 'Departamento.php';
include_once 'Entidade.php';
class Servidor implements Entidade{
    private $id;
    private $nome;
    private $cpf;
    private $usuario;
    private $senha;
    
    private $departamento;
    
    public function __construct($nome, $cpf, $usuario, $senha, $departamento) {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->departamento = $departamento;
    }
    
    function getDepartamento() {
        return $this->departamento;
    }

    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

        
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getSenha() {
        return $this->senha;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getCampos() {
        return "nome, cpf, usuario, senha, departamento_id";
    }

    public function getValores() {
        return "'".$this->nome."', '".$this->cpf.
                "', '".$this->usuario."', '".$this->senha.
                "', '".$this->departamento->getId()."'";
    }

    public function getValoresUpdate() {
        
    }

}
