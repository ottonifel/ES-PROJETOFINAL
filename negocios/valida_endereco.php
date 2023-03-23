<?php

namespace negocios;

class ValidaEndereco {

    public static function validarEndereco($rua, $numero, $bairro, &$ruaErr, &$numeroErr, &$bairroErr) {
        $ruaErr = $numeroErr = $bairroErr = "";
        $mensagem = "";

        if (empty($rua)) {
            $ruaErr = "* Rua é requerido";
        } else {
            // checa se rua contem apenas letras e espaços
            if (!preg_match("/^[a-zA-Z ]*$/",$rua)) {
                $ruaErr = "* Apenas letras e espaços são permitidos";
            }
        }

        if (empty($numero)) {
            $numeroErr = "* Numero é requerido";
        } else {
            // checa se é um número
            if (!preg_match("/^[0-9]*$/",$numero)) {
                $numeroErr = "* Apenas números permitidos";
            }
        }

        if (empty($bairro)) {
            $bairroErr = "* Bairro é requerido";
        } else {
            // checa se bairro contem apenas letras e espaços
            if (!preg_match("/^[a-zA-Z ]*$/",$bairro)) {
                $bairroErr = "* Apenas letras e espaços são permitidos";
            }
        }

        if($ruaErr == "" && $bairroErr == "" && $numeroErr ==""){
            $mensagem = 'Endereço: Rua '.$rua.', '.$numero.', '.$bairro;
            //verifica se o endereco é valido e calcula o frete
            //...
            return true;
        } else {
            return false;
        }
    }
}

?>