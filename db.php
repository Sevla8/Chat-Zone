<?php
	global $db;

	try {
		$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
	}
	catch(Exception $exception) {
		die('Erreur : '.$exception->getMessage());
	}

	function getListMessage() {
		global $db;
		$query = $db->prepare('SELECT pseudo, room, message, DATE_FORMAT(date_creation, "%d/%m/%Y %T") AS date_creation FROM chat_zone WHERE room = ?');
		$query->execute(array($_SESSION['salon']));
		$fetch = $query->fetchAll();
		return $fetch;
	}

	function postMessage($message, $pseudo, $salon) {
		global $db;
		$query = $db->prepare('INSERT INTO chat_zone(pseudo, room, message, date_creation) VALUES (?, ?, ?, NOW())');
		$query->execute(array($_SESSION['pseudo'], $_SESSION['salon'], $_POST['message']));
	}
?>
