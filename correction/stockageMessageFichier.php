<?php

function getListMessage($salon) {
    // Nom du fichier dans lequel on va récupérer les données
    $nom = $salon . '.txt';
    // On commence avec un tableau vide
    $messageList = array();
    if (file_exists($nom)) { // Si le fichier existe :
        $fichier = fopen($nom, 'r');
        while (!feof($fichier)) { // Tant qu'il y a des lignes à lire
            $x = fgets($fichier); // On lit la ligne
            $message = json_decode($x, true); // On décode les données en un tableau associatf
            array_push($messageList, $message); // On rajoute les données décodées au tableau $messageList
        }
    }
    return $messageList; // On retourne la liste des messages récupérés
}

function stockerMessage($message, $pseudo, $salon) {
    // Nom du fichier dans lequel on va stocker
    $nom = $salon . '.txt';
    // Si le fichier est vide on ne veut pas rajouter de saut de ligne...
    $sautDeLigne = "";
    if (file_exists($nom))
        $sautDeLigne = "\n";
    // On met les info sous la forme d'un tableau associatif
    $messageTableau = array('pseudo' => $pseudo, 'message' => $message);
    // On encode le tableau associatif en une chaîne de caractère
    $messageEncode = json_encode($messageTableau);
    // On ouvre/crée le fichier
    $fichier = fopen($nom, 'a');
    // On met le curseur à la fin
    fseek($fichier, SEEK_END);
    // On écrit dans le fichier
    fputs($fichier, $sautDeLigne . $messageEncode);
    // On ferme le fichier
    fclose($fichier);
}


?>
