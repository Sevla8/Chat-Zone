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
			$_SESSION['pseudo'] = filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING);
			$_SESSION['salon'] = filter_var($_POST['salon'], FILTER_SANITIZE_STRING);
			setcookie('pseudo', $_SESSION['pseudo']);
			setcookie('salon', $_SESSION['salon']);
	}
	try {
		$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
	}
	catch(Exception $exception) {
		die('Erreur : '.$exception->getMessage());
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

					$query = $db->prepare('INSERT INTO chat_zone(pseudo, room, message) VALUES (?, ?, ?)');
					$query->execute(array($_SESSION['pseudo'], $_SESSION['salon'], $_POST['message']));

					$_POST['message'] = null; // pour qu'il ne reprenne pas ce qu'on a deja posté
				}
			}
			if (!isset($_SESSION['salon']) || !isset($_SESSION['pseudo'])) {
				echo '<h1>ACCES RESTRICTED</h1>';
				echo '<a href="accueil.php"><== HOME</a>';
			}
			else {
				echo '<h1>CHAT-ZONE - ' . $_SESSION['salon'] . '</h1>';
				echo '<div id="chat">';

				$query = $db->query('SELECT * FROM chat_zone');
				
				while ($fetch = $query->fetch()) {
					?> <p class="<?php echo $fetch['pseudo']; ?>"> <?php
					for ($i = 0; $i < strlen($fetch['message']); $i += 1) {
						if ($fetch['message'][$i] == "\n")
							echo '<br>';
						else
							echo $fetch['message'][$i];
					}
					?> <span>by <?php echo $fetch['pseudo']; ?></span></p> <?php
				}
				$query->closeCursor();
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