<?php
	include('control.php');
?>
<html>
	<head lang="fr">
		<title>Salon</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="salon.css">
	</head>
	<body>
		<h1>CHAT-ZONE - <?php echo $_SESSION['salon'] ?></h1>
		<div id="chat">
			<?php
			foreach($messageList as $message) {
				echo '<p class="'.$message['pseudo'].'">';
				echo nl2br($message['message']);
				echo '<br><span>'.$message['pseudo'].', '.$message['date_creation'].'</span></p>';
			}
	    	?>
		</div>
		<div id="message">
			<form name="formulaire" method="post" action="salon.php">
				<textarea autofocus name="message" placeholder="Type your message here" rows="5"></textarea>
				<input type="submit" name="poster" value="Send" title="Send your message">
			</form>
			<form method="post" action="accueil.php">
				<input type="submit" name="quitter" value="Quit" title="Quit the room">
			</form>
		</div>
		<script>
			function align() {
				let textarea = document.querySelector('textarea');
				let own = document.querySelectorAll(".<?php echo $_SESSION['pseudo'] ?>");
				for (i = 0; i < own.length; i += 1) 
					own[i].style.textAlign = "right";
			}

			align();

			function scroll() {
				let chat = document.querySelector('#chat');
				chat.scrollTop = chat.scrollHeight;
			}
			
			scroll();

			function get() {
				var xhr = new XMLHttpRequest();
				xhr.open('POST', 'ajax.php', true);
				xhr.addEventListener('readystatechange', function() {
					if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
						document.querySelector("#chat").innerHTML=xhr.responseText;
						align();
						scroll();
					}
				});
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send();
			}

			setInterval(get, 5000);
 		</script>
	</body>
</html>
