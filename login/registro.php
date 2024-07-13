<?php
require_once 'config.php';

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["nome"]))) {
        $username_err = "Por favor digite seu nome.";
    } else {
        $username = trim($_POST["nome"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor digite sua senha.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "INSERT INTO usuarios (nome, password) VALUES (?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if ($stmt->execute()) {
                header("location: login.php");
            } else {
                echo "Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            $stmt->close();
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <div>
        <h2>Registro</h2>
        <p>Por favor preencha este formulário para criar uma conta.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Nome</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <span><?php echo $username_err; ?></span>
            </div>    
            <div>
                <label>Senha</label>
                <input type="password" name="password">
                <span><?php echo $password_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Submit">
            </div>
            <p>já tem uma conta? <a href="login.php">Entre aqui</a>.</p>
        </form>
    </div>    
</body>
</html>
