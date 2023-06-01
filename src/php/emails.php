<?php
require_once 'conexao.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $data = $_POST["data"];
    $email = $_POST["email"];


    $sql = "INSERT INTO campanhas (nome, data, email) VALUES ('$nome', '$data', '$email')";
    if (mysqli_query($conn, $sql)) {
        echo "Campanha registrada com sucesso.";
    } else {
        echo "Erro ao registrar a campanha: " . mysqli_error($conn);
    }
}


$sql = "SELECT * FROM campanhas";
$result = mysqli_query($conn, $sql);
?>