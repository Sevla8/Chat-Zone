<?php 
	session_start();
	if (isset($_POST['rejoindre']) && 
		isset($_POST['salon']) && 
		isset($_POST['pseudo']) && 
		strlen($_POST['pseudo']) != 0 &&
		($_POST['salon'] == 'WIM' || 
		$_POST['salon'] == 'APL' || 
		$_POST['salon'] == 'ASR' || 
		$_POST['salon'] == 'SGBD' ||
		$_POST['salon'] == 'PPP' || 
		$_POST['salon'] == 'EGOD' ||
		$_POST['salon'] == 'EC' ||
		$_POST['salon'] == 'ENG' || 
		$_POST['salon'] == 'ALG' || 
		$_POST['salon'] == 'GRAPH')) {
			$_POST['pseudo'] = filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING);
			$_POST['salon'] = filter_var($_POST['salon'], FILTER_SANITIZE_STRING);
			$_SESSION['pseudo'] = $_POST['pseudo'];
			$_SESSION['salon'] = $_POST['salon'];
			setcookie('pseudoSalon', $_POST['pseudo']);	
	}
?>
<!doctype html>
<html>
	<head lang="fr">
		<title>Salon</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<?php
			if (isset($_POST['poster']) && isset($_POST['message'])) {
				$_POST['message'] = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
				$nom = $_SESSION['salon'] . '.txt';
				$fichier = fopen($nom, 'a');
				fseek($fichier, SEEK_END);
				$messageW = array('pseudo' => $_SESSION['pseudo'], 'message' => $_POST['message']);
				fputs($fichier, JSON_encode($messageW) . "\n");
				fclose($fichier);
			}
			if (!isset($_SESSION['salon']) || !isset($_SESSION['pseudo']) || strlen($_SESSION['pseudo']) == 0) {
				echo '<h2>ACCES RESTRICTED</h2>';
				echo '<a href="accueil.php">HOME</a>';
			}
			else {
				echo '<h2>CHAT-ZONE - ' . $_SESSION['salon'] . '</h2>';
				$nom = $_SESSION['salon'] . '.txt';
				if (file_exists($nom)) {
					$fichier = fopen($nom, 'r');
					while (!feof($fichier)) {
						// $messageR = JSON_decode(fgets($fichier));
						// echo $messageR['pseudo'];
						// echo ' : ';
						// echo $messageR['message'];
						echo '<br>';
					}
					fclose($fichier);
				}
				echo '
					<form method="post" action="salon.php">
						<textarea name="message" placeholder="Tapez votre message" cols="100" rows="5"></textarea>
						<input type="submit" name="poster" value="poster">
					</form>';
				echo '
					<form method="post" action="accueil.php">
						<input type="submit" name="quitter" value="quitter">
					</form>';
			}
		?>
	</body>
</html>