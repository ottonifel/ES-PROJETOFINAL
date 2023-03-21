<?php
    require 'restaurante.php';
    //require 'bd.php';
    require 'pedido.php';
    
    //$myBD = new BD();
    $restaurante = new Restaurante("Subway");
    $pedido = new Pedido();


?>

<?php
// define variables and set to empty values
//$cont = 0;
$ruaErr = $numeroErr = $bairroErr = "";
$rua = $numero = $bairro = "";
$mensagem="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["rua"])) {
    $ruaErr = "Rua é requerido";
    //$cont = 1;
  } else {
    $rua = test_input($_POST["rua"]);
 // checa se rua contem apenas letras e espaços
    if (!preg_match("/^[a-zA-Z ]*$/",$rua)) {
      $ruaErr = "Apenas letras e espaços são permitidos";
    }
  }

  if (empty($_POST["numero"])) {
    $numeroErr = "Numero é requerido";
  } else {
    $numero = test_input($_POST["numero"]);
      // checa se é um número
    if (!preg_match("/^[0-9]*$/",$numero)) {
      $numeroErr = "Apenas números permitidos";
    }
  }

  if (empty($_POST["bairro"])) {
    $bairroErr = "Bairro é requerido";
  } else {
    $bairro = test_input($_POST["bairro"]);
 // checa se bairro contem apenas letras e espaços
    if (!preg_match("/^[a-zA-Z ]*$/",$bairro)) {
      $bairroErr = "Apenas letras e espaços são permitidos";
    }
  }
  if($ruaErr == "" && $bairroErr == "" && $numeroErr ==""){
  $pedido->setFrete($_POST["rua"],$_POST["numero"], $_POST["bairro"]); //posição aqui está errada pois esse comando realiza mesmo quando algo é preenchido fora dos padrões acima
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<html>
    <head> 
        <title>Tela de Pagamento</title>
        <!-- estilo -->
        <style>
            h1, h2 {
                font-size: 25px;
                text-align: center;
            }
            
            .dados {
                padding: 10px 100px;
                margin: auto;
                border: 3px solid #146551;
                border-radius: 10px;
                background-color: #8FC1B5;
                width: max-content;
            }
        </style>
    </head>
    <body> 
        <div class = "tela">
            <div class = "dados">
                <h1>Pagamento</h1>
                <?php
                    echo "Restaurante: ";
                    echo $restaurante->getNome(). '<br>';
                    echo "Preço: ";
                    echo $pedido->getPrecoItens(). '<br>';
                    echo "\n Frete: ";
                    echo $pedido->getFrete(). '<br>';
                    echo "\n Preço Total: ";
                    echo $pedido->getPrecoTotal(). '<br>';
                ?>


                <?php
                    
                    //echo $myBD->resgatarFrete("Campolim");
                    //$facade->exibePrecoTotalPedido($pedido);
                    

                ?>
                <h2>Localização</h2>
                <?php


                ?>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                Rua: <input type="text" name="rua">
                <span class="error"><font color="#AA0000">* <?php echo $ruaErr;?></font></span>
                <br><br>
                Número:
                <input type="text" name="numero">
                <span class="error"><font color="#AA0000">* <?php echo $numeroErr;?></font></span>
                <br><br>
                Bairro:
                <input type="text" name="bairro">
                <span class="error"><font color="#AA0000">* <?php echo $bairroErr;?></font></span>
                <br><br>
                <input type="submit" name="submit" value="Submit"><br><br>
  

</form>
            </div>
        </div>
    </body>
</html>