<?php

	session_start();

	include('db.php');

	$messageList = getListMessage($_SESSION['salon']);

	foreach($messageList as $message) {
		echo '<p class="'.$message['pseudo'].'">';
		echo nl2br($message['message']);
		echo '<br><span>'.$message['pseudo'].', '.$message['date_creation'].'</span></p>';
	}

?>