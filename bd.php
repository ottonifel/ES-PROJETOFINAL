<?php

class BD
{

    private static $instancia;
    private $conexao;

    private function __construct()
    {
        $this->conexao = $this->connectBD();
        $this->createTableBairros();
        $this->inserirBairro("Mangal", 2.5);
        $this->inserirBairro("Campolim", 4.8);
        $this->inserirBairro("Centro", 5.0);
        $this->inserirBairro("Santa Rosalia", 7.9);
    }

    public static function getInstancia()
    {
        if (self::$instancia == null) {
            self::$instancia = new BD();
        }
        return self::$instancia;
    }

    private function connectBD()
    {
        $servername = "localhost";
        $username = "root";
        $dbname = "myBD";
        $psswd = "";

        $conn = mysqli_connect($servername, $username, $psswd, $dbname);

        if (!$conn)
            $conn = null;

        return $conn;
    }

    public function fechaBD()
    {
        mysqli_close($this->conexao);
    }

    private function createTableBairros()
    {
        $sql = "CREATE TABLE IF NOT EXISTS Bairros(
            nome_bairro VARCHAR(50) PRIMARY KEY,
            valor_frete FLOAT,
        )";
        mysqli_query($this->conexao, $sql);
    }

    private function inserirBairro($nome_bairro, $valor_frete)
    {
        if (!$this->existeBairro($nome_bairro)) {
            $sql = "INSERT INTO Bairros (nome_bairro, valor_frete) VALUES ('" . $nome_bairro . "','" . $valor_frete . "')";
            mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));
        }
    }

    public function existeBairro($bairro)
    {
        $sql = "SELECT * FROM Bairros WHERE nome_bairro = '$bairro'";
        $result = mysqli_query($this->conexao, $sql);
        if ($result->num_rows == 0)
            return 1;
        return 0;
    }

    public function resgatarFrete($bairro)
    {
        $sql = "SELECT valor_frete FROM Bairros WHERE nome_bairro = '$bairro'";
        $result = mysqli_query($this->conexao, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['valor_frete'];
    }

}


?>