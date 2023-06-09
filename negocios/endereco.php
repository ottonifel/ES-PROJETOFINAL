<?php
    namespace negocios;
    use Exception;
    use persistencia\BD;
    require_once __DIR__.'/../persistencia/bd.php';

    class Endereco{
        //declaracao de variáveis

        private $rua;
        private $numero;
        private $bairro;
        private $myBD;

        public function __construct($rua, $numero, $bairro){
            $this->rua =  $rua;
            $this->numero = $numero;
            $this->bairro = $bairro;
            $this->myBD = BD::getInstancia();
        }


        public function getBairro(){
            return $this->bairro;
        }

        public function getRua(){
            return $this->rua;
        }

        public function getNumero(){
            return $this->numero;
        }

        public function setRua($rua){
            $this->rua = $rua;
        }

        public function setNumero($numero){
            $this->numero = $numero;
        }

        public function setBairro($bairro){
            if($this->myBD->existeBairro($bairro)){
                $this->bairro =  $bairro;
                return $this->myBD->resgatarFrete($bairro);  
            } else{
                throw new BairroInvalidoException("Bairro ausente nos enderecos entregaveis pelo restaurante");
            }
        }
        
      

    }

    class BairroInvalidoException extends Exception{
        public function __construct($message, $code = 0, $previous = null){
            parent::__construct($message, $code, $previous);
        }
    }
?>