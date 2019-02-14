<?php
	session_start();
	if (isset($_POST['quitter']))
		session_destroy();
?>
<!doctype html>
<html>
	<head lang="fr">
		<title>Accueil</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<h2>CHAT-ZONE - Home</h2>
		<form method="post" action="salon.php">
			<label for="pseudoInput">Pseudo</label>
			<input type="name" name="pseudo" id="pseudoInput"<?php if (isset($_COOKIE['pseudoSalon'])) echo 'value="' . $_COOKIE['pseudoSalon'] . '"'; ?>>
			Salon
			<select name="salon">
				<option value="WIM">WIM</option>
				<option value="APL">APL</option>
				<option value="ASR">ASR</option>
				<option value="SGBD">SGBD</option>
				<option value="PPP">PPP</option>
				<option value="EGOD">EGOD</option>
				<option value="EC">EC</option>
				<option value="ENG">ENG</option>
				<option value="ALG">ALG</option>
				<option value="GRAPH">GRAPH</option>
			</select>
			<input type="submit" name="rejoindre" value="rejoindre">
		</form>
		<script>
			<?php
				if (isset($_COOKIE['nomSalon'])) {
					echo '
						option = document.querySelectorAll("option");';
					echo '
						for (i = 0; i < x.length; i += 1) {
							if (option[i].value == ' . $_COOKIE['nomSalon'] .')
								option[i].selected = "selected";';
				}
			?>
		</script>
	</body>
</html>
