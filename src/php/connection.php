<?php

 $username = "mbemail";
 $password_db = "1234ad5678";
 $dbname = "mbemail";
 $servername = "localhost";

// Estabelece a conexão com o MySQL
$conn = new mysqli($servername,$username, $password, $dbname);

// Verifica se ocorreu algum erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>