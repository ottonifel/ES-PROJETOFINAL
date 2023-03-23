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

        //construtor sobrecarregado com $valorUn (valor base para cálculo do valor individual de itens pré definidos)
        public function __construct(int $valorUn){
            
            $this->endereco = new Endereco("", "", "");
            
            $this->itens = array(
                new Item($valorUn, "File de Frango"),
                new Item($valorUn + 10, "X-tudo"),
                new Item($valorUn + 5, "Refrigerante"),
            );
            //acha preco total do pedido
            foreach($this->itens as $item){
                $this->precoItens+=$item->getValor();
            }
            $this->precoItens;
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
            $this->frete = rand(1,10); //valor aleatório para frete
            //atyaliza bairro no Banco de Dados
            $this->myBD->atualizarBdInput($bairro, $this->frete);

            $this->endereco->setBairro($bairro);
            $this->endereco->setRua($rua);
            $this->endereco->setNumero($numero);
            $this->precoTotal = $this->precoItens + $this->frete;
        }
    }
?>