<?php
    namespace negocios;
    use negocios\Item;
    use negocios\Endereco;
    use persistencia\BD;

    require_once __DIR__.'/../negocios/item.php';
    require_once __DIR__.'/../negocios/endereco.php';



    class Pedido{
        private $precoTotal = 0;
        private $precoItens = 0;
        private $frete = 0;
        private $itens;
        private $endereco;

        private $myBD; 

        public function __construct(){
            
            $this->endereco = new Endereco("", "", "");
            
            $this->itens = array(
                new Item(30, "File de Frango"),
                new Item(40, "X-tudo"),
                new Item(10, "Refrigerante"),
            );
            //acha preco total do pedido
            foreach($this->itens as $item){
                $this->precoTotal+=$item->getValor();
            }
            $this->precoItens = $this->precoTotal;
            $this->precoTotal+=$this->frete;
            $this->myBD = BD::getInstancia();

        }

        public function getPrecoTotal(){
            return  $this->precoTotal;
        }

        public function getPrecoItens(){
            return $this->precoItens;
        }

        public function getFrete(){
            return  $this->frete;
        }

        public function setFrete($rua, $numero, $bairro){
            $this->frete = rand(1,10); //valor padrao base
            $this->myBD->atualizarBdInput($bairro, $this->frete);

            $this->endereco->setBairro($bairro);
            $this->endereco->setRua($rua);
            $this->endereco->setNumero($numero);
            $this->precoTotal+=$this->frete;
            

        }
    }
?>