<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Fadbateca</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' href='CSS/ladding.css'>
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

<div class="main-content">
    <form id="reserveRoomForm">
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

            $sql = "SELECT id, nome, telefone, curso, sala, hora, data FROM clientes";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                echo "<h1>Lista de Reservas</h1>";
                echo "<table><tr><th>Nome</th><th>Telefone</th><th>Curso</th><th>Sala</th><th>Hora</th><th>Data</th><th>Ações</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["nome"]."</td><td>".$row["telefone"]."</td><td>".$row["curso"]."</td><td>".$row["sala"]."</td><td>".$row["hora"]."</td><td>".$row["data"]."</td><td><a href='editar.php?id=".$row['id']."'>Editar</a> | <a href='#' onclick='showPopup(".$row['id'].")'>Excluir</a></td></tr>";
                }
                    echo "</table>";
            } else {
                echo "Não há clientes cadastrados.";
            }   
            ?> 
        </div>
    </form>       
    <a target="_self" href="adicionar.php" class="adicionar"><input type="submit" name="adicionar" class="btn" value="Adicionar"></a>     
</div> 
      
<div class="popup" id="popup">
    <p>Tem certeza que deseja excluir?</p>
    <button class="btn" onclick="confirmDelete()">Sim, quero deletar</button>
    <button class="btn" onclick="hidePopup()">Cancelar</button>
</div>
<script>
    function showPopup(id) {
        document.getElementById('popup').style.display = 'block';
        document.getElementById('popup').setAttribute('data-id', id);
    }

    function hidePopup() {
        document.getElementById('popup').style.display = 'none';
        document.getElementById('popup').removeAttribute('data-id');
    }

    function confirmDelete() {
        var id = document.getElementById('popup').getAttribute('data-id');
        window.location.href = 'excluir.php?id=' + id;
    }
</script>            
<footer>
    <p>&copy; 2024 Fadba</p>
</footer>
</body>
</html>
<?php
$conn->close();
?> 