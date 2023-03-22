<?php
    namespace persistencia;

class BD
{

    private static $instancia;
    private $conexao;

    public function __construct()
    {
        $this->conexao = $this->connectBD();
        $this->createTableBairros();
        // $this->inserirBairro($this->conexao, "Mangal", 2.5);
        // $this->inserirBairro($this->conexao,"Campolim", 4.8);
        // $this->inserirBairro($this->conexao, "Centro", 5.0);
        // $this->inserirBairro($this->conexao, "Santa Rosalia", 7.9);
        //$this->fechaBD($this->conexao);*/
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
        $dbname = "bdbairro";
        $psswd = "";

        $conn = mysqli_connect($servername, $username, $psswd, $dbname);

        if (!$conn)
            $conn = null;

        return $conn;
    }

    public function fechaBD($conn)
    {
        mysqli_close($conn);
    }

    private function createTableBairros()
    {
        $sql = "CREATE TABLE IF NOT EXISTS Bairros(
            nome_bairro VARCHAR(50) PRIMARY KEY,
            valor_frete FLOAT
        )";
        mysqli_query($this->conexao, $sql);
    }

    private function inserirBairro($conn, $nome_bairro, $valor_frete)
    {
        if (!$this->existeBairro($nome_bairro)){
            $sql = "INSERT INTO bairros (nome_bairro, valor_frete) VALUES ('" . $nome_bairro . "','" . $valor_frete . "')";
            mysqli_query($conn, $sql) or die(mysqli_error($conn));
        }
    }

    public function existeBairro($bairro)
    {
        $sql = "SELECT * FROM Bairros WHERE nome_bairro = '$bairro'";
        $result = mysqli_query($this->conexao, $sql);
        if ($result->num_rows == 1){
            return 1;
        }
        return 0;
    }

    public function resgatarFrete($bairro)
    {
        $sql = "SELECT valor_frete FROM Bairros WHERE nome_bairro = '$bairro'";
        $result = mysqli_query($this->conexao, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['valor_frete'];
    }

    public function atualizarBdInput($nome_bairro, $valor_frete) {
        $this->inserirBairro($this->conexao, $nome_bairro, $valor_frete);
    }

}


?>