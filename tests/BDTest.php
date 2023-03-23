<?php

    use persistencia\bd;
    use PHPUnit\Framework\TestCase;

    require_once(__DIR__.'/../persistencia/bd.php');
    
    class BDTest extends TestCase{

        public function testSingletonBD(){
            $bd = BD::getInstancia();
            $this->assertEquals(Bd::class, $bd::class);
        }

        public function testeConexaoBD(){
            $bd = BD::getInstancia();
            $conn = $bd->connectBD();
            $this->assertNotNull($conn);
            $conn = null;
        }

        public function testeSelecaoTupla(){
            $pdo = new PDO('mysql:host=localhost;dbname=bdbairro', 'root', '');

            //bairro correto
            $bairro = 'Mangal';
            $comando = "SELECT * FROM Bairros WHERE nome_bairro = '$bairro'";
            $stmt = $pdo->query($comando);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->assertEquals($bairro, $result['nome_bairro']);

            //bairro com numero na entrada
            $bairro = 15;
            $comando = "SELECT * FROM Bairros WHERE nome_bairro = '$bairro'";
            $stmt = $pdo->query($comando);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->assertEquals($bairro, $result['nome_bairro']);

            //bairro nulo
            $bairro = null;
            $comando = "SELECT * FROM Bairros WHERE nome_bairro = '$bairro'";
            $stmt = $pdo->query($comando);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->assertEquals($bairro, $result['nome_bairro']);

            $pdo = null;
        }

        public function testeRetornoExisteBairro(){
            $pdo = new PDO('mysql:host=localhost;dbname=bdbairro', 'root', '');

            //bairro correto
            $bairro = 'Mangal';

            $comando = "SELECT * FROM Bairros WHERE nome_bairro = '$bairro'";
            $stmt = $pdo->query($comando);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $temp = 0;
            if($bairro == $result['nome_bairro'])
                $temp = 1;
            
            $bd = bd::getInstancia();

            $this->assertEquals($temp, $bd->existeBairro($bairro));

            $pdo = null;
        }
    }

?>