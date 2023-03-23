<?php
    namespace negocios;

    class Item{
        private $valor;

        private $nome;

        public function __construct($valor, $nome){
            $this->nome = $nome;
            $this->valor = $valor;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getValor(){
            return $this->valor;
        }

        public function setValor($valor) {
            $this->valor = $valor;
        }
    }

?>