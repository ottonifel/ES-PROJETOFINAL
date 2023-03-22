<?php
    namespace IU;
    use negocios\Pedido;
    use negocios\Restaurante;
    

    class AppFacade{
        //apresentar 
        public function telaDePagamento(Pedido $pedido, Restaurante $restaurante){
            echo "Restaurante: ";
                    echo $restaurante->getNome(). '<br>';
                    echo "Preço: ";
                    echo $pedido->getPrecoItens(). '<br>';
                    echo "\n Frete: ";
                    echo $pedido->getFrete(). '<br>';
                    echo "\n Preço Total: ";
                    echo $pedido->getPrecoTotal(). '<br>'; 
        }
    }

?>