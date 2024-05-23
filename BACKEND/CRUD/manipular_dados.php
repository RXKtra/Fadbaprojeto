    <?php
        include_once ("./BACKEND/conexao/conexaoMySQL.php");
        class manipulacaodedados extends ConexaoMySQL{
        public $msg;
        protected  $sql;
        protected $tabela; 
        protected $campos;
        protected $dados;


        public function getMsg($msg){
            $this-> msg =$msg;
        }

        public function getSql($sqll){
            $this-> sql =$sqll;
        }
        
        public function setTabela ($tbl){
            $this->tabela = $tbl;
        }

        public function setCampos ($cmp){
            $this -> campos = $cmp;
        }
        public function setDados($dd){
            // Envolve o valor entre aspas simples para garantir que seja tratado como uma string
            $this->dados =  $dd ;
        }

        

        public function inserir() {
            $this->sql = "INSERT INTO $this->tabela ($this->campos) VALUES ($this->dados)";
            echo "Query SQL: " . $this->sql . "<br>";
        
            if ($this->executarSQL($this->sql)) { // Chame a função executarSQL() usando $this->
                $this->msg = "Usuário cadastrado com sucesso\n";
            } else {
                $this->msg = "Erro ao cadastrar usuário\n";
                echo "Erro SQL: " . mysqli_error($this->conexao) . "<br>"; // Mensagem de debug para imprimir erros de SQL
            }
        }
    
    }
    ?>