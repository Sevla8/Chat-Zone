<?php 

       /*************************************************************/
       // Tout d'abord, on prépare tout ce dont
       // on a besoin pour l'affichage de la page
       /*************************************************************/

session_start();

/*************************************************************/
// Choix de la manière de stocker et récupérer des fichiers : soit dans des fichiers, soit dans une base de donnée.
// Inclure le fichier correspondant à ce que l'on veut.

//include("stockageMessageFichier.php");
include("stockageMessageBDD.php");

/*************************************************************/
// On stocke le pseudo et le salon uniquement si ceux-là ont le bon format :
if (isset($_POST['rejoindre']) &&
    isset($_POST['salon']) &&  isset($_POST['pseudo']) && 
    strlen($_POST['pseudo']) != 0 &&
    in_array($_POST['salon'], ['GRAPH','ALG','ENG','EC','EGOD','PPP','SGBD','ASR','APL','WIM'])) // in_array permet de vérifier que $_POST["salon"] est parmi la liste des salons autorisé
{
    // On stocke dans la variable session une version sans risque (injections)
    $_SESSION['pseudo'] = htmlentities($_POST['pseudo']);
    $_SESSION['salon'] = htmlentities($_POST['salon']);
    // On stocke aussi dans des cookies pour proposer par défaut le dernier pseudo/salon visité
    setcookie('pseudo', $_SESSION['pseudo']);
    setcookie('salon', $_SESSION['salon']);
}

/*************************************************************/
// Si la session ne contient pas les deux variables, on s'arrête là et redirige.
if (!isset($_SESSION['salon']) || !isset($_SESSION['pseudo'])) {
    header("Location: accueil.php");
    exit();
}

/*************************************************************/
// Si un message est posté, on appelle la fonction pour le stocker (cf stockageMessageFichier.php ou stockageMessageBDD.php)
if (isset($_POST['poster']) && isset($_POST['message'])) { //$_POST['poster'] indique que l'utilisateur a appuyé sur le bouton
    if (strlen($_POST['message']) > 0) {
	$_POST['message'] = htmlentities($_POST['message']); // On elève les risques d'injection
	stockerMessage($_POST['message'], $_SESSION["pseudo"], $_SESSION["salon"]);
    }
}

/*************************************************************/
// On récupère la liste des messages du salon
$messageList = getListMessage($_SESSION["salon"]);

       /*************************************************************/
       // Affichage de la page ! (qui aura toutes les variables définies ici)
       /*************************************************************/

include("pageSalon.php")

?>
