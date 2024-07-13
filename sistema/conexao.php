<?php 
$servidor = "localhost";
$usuario = "root";
$senha = "";
$db = "sistema";

$conn = new mysqli($servidor,$usuario,$senha,$db);

if($conn->connect_error){
	die("Conexão falhou". $con->connect_error);
}else{
	echo "<img src=https://img.freepik.com/premium-vector/check-mark-icon-flat-style-ok-accept-vector-illustration-white-isolated-background-tick-business-concept_157943-544.jpg height='42' width='42'>";
}

?>