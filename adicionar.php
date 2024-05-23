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
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "prova";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    if(isset($_POST['cadastrar'])) {
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $curso = $_POST['curso'];
        $sala = $_POST['sala'];
        $hora = $_POST['hora'];
        $data = $_POST['data'];
        $sql = "INSERT INTO clientes (Nome, Telefone, Curso, Sala, Hora, Data) VALUES ('$nome', '$telefone', '$curso', '$sala', '$hora', '$data')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>window.location.href='ladding.php';</script>";
        } else {
            echo "Erro ao cadastrar o cliente: " . $conn->error;
        }
    }
    ?>
    <div class="main-content">
        <h1>Adicionar Reserva</h1>
        <form id="reserveRoomForm" method="post">
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" required>
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" required>
            <label for="curso">Curso:</label>
            <input type="text" id="curso" name="curso" required>
            <label for="Sala">Sala:</label>
            <input type="number" id="sala" name="sala" required>
            <label for="hora">Horario:</label>
            <input type="time" id="hora" name="hora" required>
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>
            <input type="submit" name="cadastrar" value="Cadastrar">
        </form>
        <p><a href="ladding.php">Voltar para Lista de Reservas</a></p>
    </div>
    
</div>          
<footer>
    <p>&copy; 2024 Fadba</p>
</footer>
</body>
</html>