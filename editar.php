<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Fadbateca</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' href='CSS/adicionar.css'>
</head>
<body>
    <header>
            <h1>Fadbateca</h1>
            <nav>
                <ul>
                    <li><a href="#servicos">Serviços</a></li>
                </ul>
            </nav>
        </header>
<div class="container">
    <?php
    if(isset($_GET['id'])) {
  
        $id = $_GET['id'];
      
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "prova";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

     
        $sql = "SELECT * FROM clientes WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Cliente não encontrado.";
            exit(); 
        }
    } else {
        echo "ID do cliente não especificado.";
        exit(); 
    }

    
    if(isset($_POST['atualizar'])) {
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $curso = $_POST['curso'];
        $sala = $_POST['sala'];
        $hora = $_POST['hora'];
        $data = $_POST['data'];
        $sql = "UPDATE clientes SET nome='$nome', telefone='$telefone', curso='$curso', sala='$sala', hora='$hora', data=$data WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>window.location.href='ladding.php';</script>";
        } else {
            echo "Erro ao atualizar o cliente: " . $conn->error;
        }
    }
    
    ?>
    <div class="main-content">
    <h1>Editar Reserva</h1>
    <form method="post">
        <label for="nome">Nome Completo:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $row['Nome']; ?>" required>
        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" value="<?php echo $row['Telefone']; ?>" required>
        <label for="curso">Curso:</label>
        <input type="text" id="curso" name="curso" value="<?php echo $row['Curso']; ?>" required>
        <label for="sala">Sala:</label>
        <input type="number" id="sala" name="sala" value="<?php echo $row['Sala']; ?>" required>
        <label for="hora">Horario:</label>
        <input type="time" id="hora" name="hora" value="<?php echo $row['Hora']; ?>" required>
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" value="<?php echo $row['Data']; ?>" required>
        <input type="submit" name="atualizar" value="Atualizar">
    </form>
    <p><a href="ladding.php">Voltar para Lista de Reservas</a></p>    
    </div>     
<footer>
    <p>&copy; 2024 Fadba</p>
</footer>
</body>
</html>