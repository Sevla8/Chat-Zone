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
			setcookie('pseudo', $_POST['pseudo']);
			setcookie('salon', $_POST['salon']);
	}
?>
<!doctype html>
<html>
	<head lang="fr">
		<title>Salon</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="salon.css">
	</head>
	<body>
		<?php
			if (isset($_POST['poster']) && isset($_POST['message'])) {
				if (strlen($_POST['message']) > 0) {
					$_POST['message'] = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
					$nom = $_SESSION['salon'] . '.txt';
					$fichier = fopen($nom, 'a');
					fseek($fichier, SEEK_END);
					$messageW = array('pseudo' => $_SESSION['pseudo'], 'message' => $_POST['message']);
					if (file_exists($nom))
						fputs($fichier, "\n" . json_encode($messageW));
					else
						fputs($fichier, json_encode($messageW));
					fclose($fichier);
					$_POST['message'] = null; // pour qu'il ne reprenne pas ce qu'on a deja posté
				}
			}
			if (!isset($_SESSION['salon']) || !isset($_SESSION['pseudo']) || strlen($_SESSION['pseudo']) == 0) {
				echo '<h2>ACCES RESTRICTED</h2>';
				echo '<a href="accueil.php">HOME</a>';
			}
			else {
				echo '<h1>CHAT-ZONE - ' . $_SESSION['salon'] . '</h1>';
				echo '<div id="chat">';
				$nom = $_SESSION['salon'] . '.txt';
				if (file_exists($nom)) {
					$fichier = fopen($nom, 'r');
					while (!feof($fichier)) {
						$x = fgets($fichier);
						$messageR = json_decode($x, true); /*
						json_decode ( string $json [, bool $assoc = FALSE [, int $depth = 512 [, int $options = 0 ]]] ) : mixed
						assoc : Lorsque ce paramètre vaut TRUE, l'objet retourné sera converti en un tableau associatif.
						*/
						if ($messageR != null) { // bug : affiche un p vide au début
							echo '<p class="' . $messageR['pseudo'] .'">';
							for ($i = 0; $i < strlen($messageR['message']); $i += 1) {
								if ($messageR['message'][$i] == "\n")
									echo '<br>';
								else
									echo $messageR['message'][$i];
							}
							echo '<br><span> by ' . $messageR['pseudo'] .'</span></p>';
						}
					}
					fclose($fichier);
				}
				echo '</div>';
				echo '<div id="message">
					<form name="formulaire" method="post" action="salon.php">
						<textarea autofocus name="message" placeholder="Type your message here" rows="5">';
						if (isset($_POST['message']))
							echo $_POST['message'];
						echo '</textarea>
						<input type="submit" name="poster" value="Send" title="Send your message">
					</form>';
				echo '
					<form method="post" action="accueil.php">
						<input type="submit" name="quitter" value="Quit" title="Quit the room">
					</form>';
				echo '</div>';
			}
		?>
		<script>
			textarea = document.querySelector('textarea');
			// textarea.focus();
			textarea.setSelectionRange(textarea.value.length, textarea.value.length); // inputElement.setSelectionRange(selectionStart, selectionEnd, [optional] selectionDirection);
			function fct() {
				document.forms['formulaire'].submit();
			}
			setTimeout(fct, 60000);

			<?php echo 'own = document.querySelectorAll(".' . $_SESSION['pseudo'] .'");'; ?>
			for (i = 0; i < own.length; i += 1) 
				own[i].style.textAlign = "right";

			chat = document.querySelector('#chat'); // mettre le scroll à la fin automatiquement
			chat.scrollTop = chat.scrollHeight;
 		</script>
	</body>
</html>