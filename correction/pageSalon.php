<!doctype html>
<html>
    <head lang="fr">
	<title>Salon</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="salon.css">
    </head>
    <body>
	
	<h1>CHAT-ZONE - <?php echo $_SESSION['salon'] ?></h1>
	<div id="chat">
	    
	    <?php // On affiche tous les messages, avec comme classe le pseudo de celui qui l'a écrit.
	    foreach($messageList as $message) {
		echo '<p class="' . $message['pseudo'] .'">';
		echo nl2br($message['message']);
		echo '<br><span> by ' . $message['pseudo'] .'</span></p>';
	    }
	    ?>
	</div>
	<div id="message">
	    <form id="formMessage" method="post" action="salon.php">
		<textarea autofocus name="message" placeholder="Type your message here" rows="5"><?php
												 // En cas de message reçu sans clic sur le bouton, c'est qu'on est dans le cas d'un rafraichissement
												 if (isset($_POST['message']) && !isset($_POST['poster']))
												     echo $_POST['message'];
												 ?></textarea>
		<input type="submit" name="poster" value="Send" title="Send your message">
	    </form>
	    
	    <form method="post" action="accueil.php">
		<input type="submit" name="quitter" value="Quit" title="Quit the room">
	    </form>
	</div>
	<script>
	 textarea = document.querySelector('textarea');

	 textarea.setSelectionRange(textarea.value.length, textarea.value.length); // Pour focuser et mettre le curseur à la fin

	 // Dans 5 secondes on soumet le formulaire (sans cliquer sur le bouton)
	 // Cela permet de rafraichir la page pour récupérer les nouveaux messages
	 // tout en envoyant ce qui avait été écrit jusqu'à maintenant,
	 // Qui ne sera pas enregistré mais remis dans le textarea, car le bouton n'est pas appuyé.
	 setTimeout(() => {document.querySelector("#formMessage").submit();}, 5000);

	 // On met tous les messages écrit par notre pseudo à droite
	 own = document.querySelectorAll(".<?php echo $_SESSION['pseudo'] ?>");
	 own.forEach((message)=> {
	     message.style.textAlign = "right";
	 })
	 
	 // mettre le scroll à la fin
	 chat = document.querySelector('#chat'); 
	 chat.scrollTop = chat.scrollHeight;
 	</script>
    </body>
</html>

