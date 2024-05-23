<?php

class ConexaoMySQL
{
    protected $servidor;
    protected $usuario;
    protected $senha;
    protected $banco;
    protected $conexao;
    protected $qry;
    protected $dados;
    protected $totalDados;
    
    public function __construct()
    {
        $this->servidor = "localhost"; // quando o bd for disponibilizado trocar pelo usuario e o link do mesmo
        $this->usuario = "root";
        $this->senha = "";//colocar a senha
        $this->banco = "fadbateca";
        $this->conectar();
    }
    
    function conectar()
    {
        $this->conexao = @mysqli_connect($this->servidor, $this->usuario, $this->senha) or
            die("Não foi possível conectar com o servidor de banco de dados: " . mysqli_connect_error());
        
        @mysqli_select_db($this->conexao, $this->banco) or 
            die("Não foi possível conectar com o Banco de dados: " . mysqli_error($this->conexao));        
    }

    function executarSQL($sql)
    {
        $this->qry = @mysqli_query($this->conexao, $sql) or 
            die("Erro ao executar o comando SQL: $sql <br>" . mysqli_error($this->conexao));
        return $this->qry;
    }

    function listar($qr)
    {
        $this->dados = @mysqli_fetch_assoc($qr);
        return $this->dados;
    }
    
    function contaDados($qry)
    {
        $this->totalDados = mysqli_num_rows($qry);
        return $this->totalDados;
    }
}

?>
