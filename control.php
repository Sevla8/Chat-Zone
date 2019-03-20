<?php 
	session_start();

	include('db.php');

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
			$_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
			$_SESSION['salon'] = htmlspecialchars($_POST['salon']);
			setcookie('pseudo', $_SESSION['pseudo']);
			setcookie('salon', $_SESSION['salon']);
	}
	
	if (!isset($_SESSION['pseudo']) || !isset($_SESSION['salon'])) {
		header('Location: accueil.php');
		exit();
	}

	if (isset($_POST['poster']) && isset($_POST['message'])) {
		if (strlen($_POST['message']) > 0) {
			$_POST['message'] = htmlspecialchars($_POST['message']);
			postMessage($_POST['message'], $_SESSION['pseudo'], $_SESSION['salon']);
		}
	}

	$messageList = getListMessage($_SESSION['salon']);

?>
