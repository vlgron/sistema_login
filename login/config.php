<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
