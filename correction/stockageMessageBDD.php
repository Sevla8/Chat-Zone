<?php
// Variable globale pour accéder à la BDD depuis les fonctions
global $link;
// À modifier suivant sa base de donnée et ses identifiants
$link = mysqli_connect("localhost","chat","chat","chatBDD");

function getListMessage($salon) {
    global $link; // On doit spécifier que $link  est globale et non locale
    // On crée la requête, en échappant le salon au cas où)
    $query = "SELECT * FROM chat WHERE room = \"".mysqli_real_escape_string($link, $salon)."\"";
    $res = mysqli_query($link, $query); // On execute la requete
    return mysqli_fetch_all($res, MYSQLI_ASSOC); // On retourne le tableau des résultats
}
    
function stockerMessage($message, $pseudo, $salon) {
    global $link;
    // On va faire une requête préparée
    $query = 'INSERT INTO chat(pseudo, room, message) VALUES (?, ?, ?)';
    $stmt = mysqli_prepare($link, $query);
    // Pas besoin d'échapper les strings car mysqli s'en occupe
    mysqli_stmt_bind_param($stmt, "sss", $pseudo, $salon, $message);
    // On execute le statement
    mysqli_execute($stmt);
}

?>
