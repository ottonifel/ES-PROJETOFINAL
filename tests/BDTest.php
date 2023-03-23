<?php

    use persistencia\bd;
    use PHPUnit\Framework\TestCase;

    require_once(__DIR__.'/../persistencia/bd.php');
    
    class BDTest extends TestCase{

        public function testeSelecaoTuplaComNumeroComoParametro(){
            $pdo = new PDO('mysql:host=localhost;dbname=bdbairro', 'root', '');

            //bairro correto
            $bairro = 15;

            $comando = "SELECT * FROM Bairros WHERE nome_bairro = '$bairro'";
            $stmt = $pdo->query($comando);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->assertEquals($bairro, $result['nome_bairro']);

            $pdo = null;
        }

        public function testeSelecaoTupla(){
            $pdo = new PDO('mysql:host=localhost;dbname=bdbairro', 'root', '');

            //bairro correto
            $bairro = 'Mangal';

            $comando = "SELECT * FROM Bairros WHERE nome_bairro = '$bairro'";
            $stmt = $pdo->query($comando);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->assertEquals($bairro, $result['nome_bairro']);

            $pdo = null;
        }

        public function testeSelecaoTuplaComValorNulo(){
            $pdo = new PDO('mysql:host=localhost;dbname=bdbairro', 'root', '');

            //bairro correto
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
        //testando a localização com entradas nulas
        public function testeLocalizacaoInvalidoNula(){
            $pdo = new PDO('mysql:host=localhost;dbname=mybd', 'root', '');

            $rua = null;
            $numero = null;
            $bairro = null;
            
            $comando = "SELECT * FROM localizacaocliente WHERE rua = '$rua' AND numero = '$numero' AND bairro = '$bairro'" ;
            $stmt = $pdo->query($comando);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->assertEquals($rua, $result['rua']);
            $this->assertEquals($numero, $result['numero']);
            $this->assertEquals($bairro, $result['bairro']);

            $pdo = null;
        }

        //testando as entradas de localização com caracteres especiais
        public function testeLocalizacaoCaracteresEspeciais(){
            $pdo = new PDO('mysql:host=localhost;dbname=mybd', 'root', '');

            $rua = '@';
            $numero = '%%%%';
            $bairro = '';
            
            $comando = "SELECT * FROM localizacaocliente WHERE rua = '$rua' AND numero = '$numero' AND bairro = '$bairro'" ;
            $stmt = $pdo->query($comando);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);


            $this->assertEquals($rua, $result['rua']);
            $this->assertEquals($numero, $result['numero']);
            $this->assertEquals($bairro, $result['bairro']);

            $pdo = null;
        }
        //testando entradas de localização com valores numericos
        public function testeLocalizacaoNumerica(){
            $pdo = new PDO('mysql:host=localhost;dbname=mybd', 'root', '');

            $rua = '1223';
            $numero = '455445';
            $bairro = '8999888';
            
            $comando = "SELECT * FROM localizacaocliente WHERE rua = '$rua' AND numero = '$numero' AND bairro = '$bairro'" ;
            $stmt = $pdo->query($comando);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);


            $this->assertEquals($rua, $result['rua']);
            $this->assertEquals($numero, $result['numero']);
            $this->assertEquals($bairro, $result['bairro']);

            $pdo = null;
        }
    }

?>