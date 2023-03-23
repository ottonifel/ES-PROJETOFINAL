<?php
    use PHPUnit\Framework\TestCase;

    use negocios\Pedido;

    require_once __DIR__.'/../negocios/pedido.php';


    /**
     * Summary of TestePrecoTotal
     */
    class PrecoTotalTest extends TestCase {
        
        /**
         * Testes colocam diferentes valores base dos itens do pedido, verificando assertion com o valor esperado total
         */
        public function testeValidarSomaItens() {
            
            /*ASSERTION 1*/
            $valorBase = 10;
            $pedido = new Pedido($valorBase); //pedido base 
            $valortotal = $pedido->getPrecoItens();
            $this->assertEquals($this->calculaValorEsperado($valorBase), $valortotal);
            
            
            /*ASSERTION 2*/
            $valorBase = 15;
            $pedido = new Pedido($valorBase); //pedido base 
            $valortotal = $pedido->getPrecoItens();
            $this->assertEquals($this->calculaValorEsperado($valorBase), $valortotal);
            
            /*ASSERTION 3*/
            $valorBase = 0;
            $pedido = new Pedido($valorBase); //pedido base 
            $valortotal = $pedido->getPrecoItens();
            $this->assertEquals($this->calculaValorEsperado($valorBase), $valortotal);

            /*ASSERTION 4*/
            $valorBase = 30;
            $pedido = new Pedido($valorBase); //pedido base 
            $valortotal = $pedido->getPrecoItens();
            $this->assertEquals($this->calculaValorEsperado($valorBase), $valortotal);

            /*ASSERTION 5*/
            $valorBase = 9.5; //não imprime o valor final certo quando algum item possui valor decimal...
            $pedido = new Pedido($valorBase); //pedido base 
            $valortotal = $pedido->getPrecoItens();
            $this->assertEquals($this->calculaValorEsperado($valorBase), $valortotal);
    }
    /**
     * Função auxiliar para comparação do assert
     * Ela calcula o valor esperado (pré definido pra cada item) de acordo com $valorBase
     */
    
    public function calculaValorEsperado($valorBase) {
        return ($valorBase*3) + 15;
    }
}

?>