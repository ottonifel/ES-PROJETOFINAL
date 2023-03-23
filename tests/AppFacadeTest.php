<?php
    use IU\AppFacade;
    use negocios\Pedido;
    use negocios\Restaurante;
    use PHPUnit\Framework\TestCase;

    require_once __DIR__.'/../negocios/pedido.php';
    require_once __DIR__.'/../negocios/restaurante.php';
    require_once __DIR__.'/../IU/AppFacade.php';

    class AppFacadeTest extends TestCase{
        public function testTelaDePagamentoExibeInformacoesCorretamente() {
            // Cria um objeto Pedido com valores específicos
            $pedido = new Pedido(10);
            $pedido->setFrete("Maria", 22, "Mangal");
            
            // Cria um objeto Restaurante com um nome específico
            $restaurante = new Restaurante("Subway");
            
            //cria appFacade
            $facade = new AppFacade();

            // Chama a função telaDePagamento()
            ob_start(); // Captura a saída da função
            $facade->telaDePagamento($pedido, $restaurante);
            $output = ob_get_clean(); // Armazena a saída da função em uma variável
            
            // Verifica se a saída da função é igual ao esperado
            $this->assertEquals("Restaurante: Subway<br>Preço: ".$pedido->getPrecoItens()."<br>\n Frete: ".$pedido->getFrete()."<br>\n Preço Total: ".$pedido->getPrecoTotal()."<br>", $output);
        }
        
        
    }
?>