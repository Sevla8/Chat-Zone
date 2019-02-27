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
		<link rel="stylesheet" href="accueil.css">
	</head>
	<body>
		<h1>CHAT-ZONE - Home</h1>

		<div id="container">
			<p>
				<img src="chat.png" alt="imageInutile">
			</p>

			<form method="post" action="salon.php">
				<h2>Join a Chat-Zone !</h2>

				<div id="pseudo">
					<label for="pseudoInput">Pseudo</label>
					<input type="name" name="pseudo" id="pseudoInput" value="<?php if (isset($_COOKIE['pseudo'])) echo $_COOKIE['pseudo']; ?>">
				</div>

				<div id="salon">
					Room
					<select name="salon">
						<option <?php if(isset($_COOKIE['salon']) && $_COOKIE['salon'] == "WIM") echo "selected"; ?> value="WIM">WIM</option>
						<option <?php if(isset($_COOKIE['salon']) && $_COOKIE['salon'] == "APL") echo "selected"; ?> value="APL">APL</option>
						<option <?php if(isset($_COOKIE['salon']) && $_COOKIE['salon'] == "ASR") echo "selected"; ?> value="ASR">ASR</option>
						<option <?php if(isset($_COOKIE['salon']) && $_COOKIE['salon'] == "SGBD") echo "selected"; ?> value="SGBD">SGBD</option>
						<option <?php if(isset($_COOKIE['salon']) && $_COOKIE['salon'] == "PPP") echo "selected"; ?> value="PPP">PPP</option>
						<option <?php if(isset($_COOKIE['salon']) && $_COOKIE['salon'] == "EGOD") echo "selected"; ?> value="EGOD">EGOD</option>
						<option <?php if(isset($_COOKIE['salon']) && $_COOKIE['salon'] == "EC") echo "selected"; ?> value="EC">EC</option>
						<option <?php if(isset($_COOKIE['salon']) && $_COOKIE['salon'] == "ENG") echo "selected"; ?> value="ENG">ENG</option>
						<option <?php if(isset($_COOKIE['salon']) && $_COOKIE['salon'] == "ALG") echo "selected"; ?> value="ALG">ALG</option>
						<option <?php if(isset($_COOKIE['salon']) && $_COOKIE['salon'] == "GRAPH") echo "selected"; ?> value="GRAPH">GRAPH</option>
					</select>
				</div>

				<div id="rejoindre">
					<input type="submit" name="rejoindre" value="join" title="Join the room">
				</div>
			</form>
		</div>
	</body>
</html>
