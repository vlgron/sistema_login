<?php include('conn/conexao.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Funcionarios</title>
</head>
<body>
<h1>Cadastro de Funcionarios</h1>


<form method="POST" action="funcionarios/cadastro.php" >
	<label>Nome:</label>
	<input type="text" name="nome">
	<label>Email:</label>
	<input type="texte" name="email"><br><br>
	<label>Data de Nascimento:</label>
	<input type="text" name="data_nascimento">
	<label>CPF:</label>
	<input type="text" name="cpf"><br><br>
	<label>Endereço:</label>
	<input type="text" name="endereco">
	<label>Bairro:</label>
	<input type="text" name="bairro"><br><br>
	<label>Estado:</label>
	
	<select name="estados" id="estados">
		<option>SELECIONE</option>
		<?php
		$sql = "SELECT * FROM estado";
		$resultado = $conn->query($sql);
		while ($linha = $resultado->fetch_assoc()) {
			echo "<option value='".$linha['id'].">".$linha['uf']."</option>";
		}

		?>		
	</select>

	<label>Cargo:</label>
	<select name="cargo" id="cargo">
		<option>SELECIONE</option>
		<?php
		$sql = "SELECT * FROM cargo";
		$resultado = $conn->query($sql);
		while ($linha = $resultado->fetch_assoc()) {
			echo "<option value='".$linha['id'].">".$linha['nome']."</option>";
		}

		?>		
	</select>

	<label>Ativo:</label>
	<input type="checkbox" name="ativo" value="S" checked>
	<br><br>
	<input type="submit" name="cadastrar" value="Cadastrar">
</form>
</body>
</html>