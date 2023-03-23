<?php
    use negocios\Restaurante;
    use negocios\Pedido;
    use negocios\Item;
    use IU\AppFacade;
    use negocios\ValidaEndereco;
    require_once __DIR__.'/../negocios/valida_endereco.php';
    require_once __DIR__.'/../negocios/pedido.php';
    require_once __DIR__.'/../negocios/restaurante.php';
    require_once __DIR__.'/../negocios/item.php';
    require_once __DIR__.'/../IU/AppFacade.php';
    
    $restaurante = new Restaurante("Subway");

    //pedido com 3 itens 
    //valor 1 = $var 
    //valor 2 = $var + 10
    //valor 3 = $var + 5

    $pedido = new Pedido(20);
    $facade = new AppFacade();
?>

<?php
// define variables and set to empty values
$ruaErr = $numeroErr = $bairroErr = "";
$rua = $numero = $bairro = "";
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $rua = $_POST["rua"];
  $numero = $_POST["numero"];
  $bairro = $_POST["bairro"];

  if(ValidaEndereco::validarEndereco($rua, $numero, $bairro, $ruaErr, $numeroErr, $bairroErr)){
    $facade->atualizaTelaEndereco($pedido,$rua,$numero,$bairro);
    $mensagem = 'Endereço: Rua '.$rua.', '.$numero.', '.$bairro;
    if($pedido->getFrete() == null){
      $bairroErr = "* Endereço inválido";
      $ruaErr = "* Endereço inválido";
      $numeroErr = "* Endereço inválido";
    }
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
                    $facade->telaDePagamento($pedido, $restaurante);
                ?>
                <h2>Localização</h2>
                <?php


                ?>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                Rua: <input type="text" name="rua">
                <span class="error"><font color="#AA0000"> <?php echo $ruaErr;?></font></span>
                <br><br>
                Número:
                <input type="text" name="numero">
                <span class="error"><font color="#AA0000"> <?php echo $numeroErr;?></font></span>
                <br><br>
                Bairro:
                <input type="text" name="bairro">
                <span class="error"><font color="#AA0000"> <?php echo $bairroErr;?></font></span>
                <br><br>
                <span class="error"><font color="#000000"><?php echo $mensagem. '<br>'.'<br>';?></font></span>
                <input type="submit" name="submit" value="Submit"><br><br>


</form>
            </div>
        </div>
    </body>
</html>
