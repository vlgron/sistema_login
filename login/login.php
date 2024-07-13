<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

require_once 'config.php';

$username = $password = "";
$username_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["nome"]))) {
        $username_err = "Por favor digite seu nome de usuario.";
    } else {
        $username = trim($_POST["nome"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor digite sua senha.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, nome, password FROM usuario WHERE nome = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_username);

            $param_username = $username;

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["nome"] = $username;

                            header("location: welcome.php");
                        } else {
                            $login_err = "Senha ou Nome de usuário inválido!.";
                        }
                    }
                } else {
                    $login_err = "Senha ou Nome de usuário inválido!";
                }
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
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
    <title>Login</title>
</head>
<body>
    <div>
        <h2>Login</h2>
        <p>Por favor, preencha suas credenciais para fazer login.</p>
        <?php 
        if (!empty($login_err)) {
            echo '<div>' . $login_err . '</div>';
        }        
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <span><?php echo $username_err; ?></span>
            </div>    
            <div>
                <label>Password</label>
                <input type="password" name="password">
                <span><?php echo $password_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Login">
            </div>
            <p>Não tem uma conta? <a href="registro.php">Inscreva-se agora</a>.</p>
        </form>
    </div>    
</body>
</html>
