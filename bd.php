<?php
    class BD{
        private $bairros = array("Mangal", "Campolim", "Centro", "Santa Rosalia");
        private $fretes = array(2.50, 4.80, 5.0, 7.9);
	
        public function existeBairro($bairro){
            for($i = 0; $i <= sizeof($this->bairros); $i++){
                if($bairro == $this->bairros[$i]){
                    return 1;
                }
            }
            return 0;
        }

        public function resgatarFrete($bairro){
            for($i = 0; $i <= sizeof($this->bairros); $i++){
                if($bairro == $this->bairros[$i]){
                    return $this->fretes[$i];
                }
            }
            return null;
        }

    }

?>