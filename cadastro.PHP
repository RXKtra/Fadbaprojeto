<!-- MENSAGEM PARA O FRONT-END:  
        Adicionar orientações para o usuario saber o que a senha precisa 
    Back-end: Lucas Souza S2 -->

<?php

    include_once("./BACKEND/conexao/conexaoMySQL.php");
    include_once("./BACKEND/CRUD/manipular_dados.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        if (isset($_POST['submit'])) {
        
            $manipulacaoDados = new manipulacaodedados();

            
            $manipulacaoDados->setTabela("usuario_cad");

            $campos = "user_name, password"; 
            $senha = $_POST['senha']; 
            $nome = $_POST['nome']; 
            
            $dados = "'$nome', '$senha'"; 

            // Defina os campos e valores no objeto manipulacaodedados
            $manipulacaoDados->setCampos($campos);
            $manipulacaoDados->setDados($dados);

            // Insira os dados no banco de dados
            $manipulacaoDados->inserir();

            // Exiba uma mensagem de sucesso ou erro
            if (!empty($manipulacaoDados->msg)) {
                echo $manipulacaoDados->msg;
            } else {
                echo "Erro ao inserir dados no banco de dados.";
            }
        }
    }
    ?>


<!DOCTYPE html>

<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Fadbateca</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='CSS/cadastro.css'>
    <script src='main.js'></script>
</head>

<body>
    <div>
        <img style="margin-top: -2px; margin-left: -2px;" width="210" height="auto" src="images/image.png">
    </div>
    <section class="area-cadastro">
        <div class="cadastro">
            <h1>Cadastro</h1>
            <form action="cadastro.php" method="post" onsubmit="return validarForm()">
                <?php 
                // Verifica se o formulário foi enviado
                if(isset($_POST['submit'])) {
                    // Armazena os valores das senhas enviadas pelo formulário
                    $senha = $_POST['senha'];
                    $senha2 = $_POST['senha2'];
                    $nome = $_POST ['nome'];

                    // Verifica se as senhas são diferentes
                    if (empty($senha) || empty($senha2)) {
                        echo '<script>alert("Os campos não podem ficar vazios");</script>';
                    } elseif ($senha != $senha2) {
                        echo '<script>alert("As senhas são incompatíveis");</script>';
                    }
                    elseif (empty ($nome)){
                        echo '<script> alert("você precisa definir um nome para o usuario")';
                    }
                            elseif(strlen($senha) < 8){
                        echo '<script> alert ("A senha precisa ter mais de 8 caracteres"); </script>';
                        
                    }
                    
                    elseif (!preg_match('/[A-Z]/', $senha) || !preg_match('/[!@#$%&*()-_=+{};:.,><~^]/', $senha) || !preg_match('/[0-9]/',  $senha)) {

                    echo '<script> alert ("A senha precisa ter pelo menos 1 letra maiuscula, um carctere especial e um numero.");</script>';

                    }
                }
                ?>
                <input type="text" name="nome" id="nome" placeholder="Digite seu usuario">
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha">
                <input type="password" name="senha2" id="senha2" placeholder="Confirme a senha">
                <p>A senha precisa ter pelo menos 1 letra maiúscula,<br> um caractere especial, um número e oito
                    caracteres.
                </p>
                <input style="background-color: #d2d2d3;" type="submit" name="submit" value="Cadastrar">







            </form>
        </div>
    </section>
    <footer>
        <p>&copy;2024 Fadbateca</p>
    </footer>


    <script>
            function validarForm() {
                var senha = document.getElementById("senha").value;
                var senha2 = document.getElementById("senha2").value;
                var nome = document.getElementById("nome").value;

                if (senha != senha2) {
                    alert("As senhas são incompatíveis");
                    return false;
                } else if (senha == "" || senha2 == "") {
                    alert("Os campos não podem ficar vazios");
                    return false;
                } else if (senha.length < 8) {
                    alert("A senha precisa ter mais de 8 caracteres");
                    return false;
                } else if (nome == "") {
                    alert("Você precisa definir um nome para o usuário");
                    return false;
                } else if (!senha.match(/[A-Z]/) || !senha.match(/[!@#$%&*()-_=+{};:.,><~^]/) || !senha.match(/[0-9]/)) {
                    alert("A senha precisa ter pelo menos 1 letra maiúscula, um caractere especial e um número.");
                    return false;
                }

                return true;
            }
    </script>
</body>

</html>