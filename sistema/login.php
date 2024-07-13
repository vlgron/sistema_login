<?php
include ('../conn/conexao.php');

$login = $_POST['login'];
$senha = $_POST['senha'];

//echo "Login: ".$login."senha: ".$senha;

$sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";

$verifica = mysqli_query($conn,$sql);
	
if(mysqli_num_rows($verifica) <= 0){
	echo "Usuario ou senha invalida";
	echo "<a href=../index.php>retornar</a>";
}else{
	echo "Bem vindo!";
}

?>