<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bem vindo</title>
</head>
<body>
    <div>
        <h1>Olá, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bem vindo ao nosso site.</h1>
        <p>
            <a href="logout.php">Sair</a>
        </p>
    </div>    
</body>
</html>
