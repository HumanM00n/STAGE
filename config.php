<?php
// Informations d'identification
define('DB_SERVER', 'localhost:3308');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'XVsikn92');
define('DB_NAME', 'tmaconnect');
 
// Connexion à la base de données MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
?>