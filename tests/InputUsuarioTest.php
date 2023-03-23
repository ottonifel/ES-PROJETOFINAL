<?php

use negocios\ValidaEndereco;
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../negocios/valida_endereco.php';


class InputUsuarioTest extends TestCase{

    public function testInputNull(){
        $bairro = $numero = $rua = null;
        $ruaErr = $numeroErr = $bairroErr = "";
        $result = ValidaEndereco::validarEndereco($rua, $numero, $bairro, $ruaErr, $numeroErr, $bairroErr);
        $this->assertEquals(false, $result);
    }
    



    public function testInputSpecial(){
        $bairro = $numero = $rua = "!@#$%^&*()";
        $ruaErr = $numeroErr = $bairroErr = "";
        $result = ValidaEndereco::validarEndereco($rua, $numero, $bairro, $ruaErr, $numeroErr, $bairroErr);
        $this->assertEquals(false, $result);    
    }


    /*
    public function testInputLongString(){

    }

    public function testInputVazia(){

    }
    */

}












?>