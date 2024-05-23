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

 
    $sql = "DELETE FROM clientes WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
    
        header("Location: ladding.php");
        exit(); 
    } else {
        echo "Erro ao excluir o cliente: " . $conn->error;
    }

   
    $conn->close();
} else {
    echo "ID do cliente não especificado.";
}
?>
