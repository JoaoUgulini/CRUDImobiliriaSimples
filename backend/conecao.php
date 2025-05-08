<?php
class conexao
{
    private $host = 'localhost';
    private $usuario = 'root';
    private $senha = '';
    private $banco = 'bdimovel';
    private $conn;
    public function connect() {
        try {
            $this->conn = new mysqli($this->host, $this->usuario, $this->senha, $this->banco);
            if ($this->conn->connect_error) {
                throw new Exception("Falha na conexão com o banco de dados: " . $this->conn->connect_error);
            }
            return $this->conn;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }


    public function disconnect()
    {
        if ($this->conn !== null) {
            $this->conn->close();
            $this->conn = null;
            return true;
        }
        return false;
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    public function prepare($sql)
    {
        return $this->conn->prepare($sql);
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

?>