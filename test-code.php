<?php
$servername = "localhost:3308";
$username = "root";
$password = "XVsikn92";
$dbname = "tmaconnect";   

  try {
      $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
    }

    $st = $bdd->query("SELECT COUNT(*) FROM tc_utilisateur WHERE matricule='".$_POST["username"]."' AND passwd='".$_POST["password"]."'")->fetch();


// Vérifier si le formulaire de connexion a été soumis
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  // Récupérer les informations de connexion soumises
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  // Vérifier les informations de connexion (exemple basique)
  if ($st['COUNT(*)'] == 1)
    {
    
    // Démarrer la session et stocker les informations de connexion
    session_start();
    $_SESSION['username'] = $username;
    
    // Rediriger l'utilisateur vers la page de destination
    header('http://localhost/TMAconnect/home.php');
    exit;
    
  } else {
    
    // Afficher un message d'erreur si les informations de connexion sont incorrectes
    echo "Nom d'utilisateur ou mot de passe incorrect";
    
  }
  
}
?>

<!-- Formulaire de connexion -->
<form action="test-code.php" method="POST">
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" type="text" name="username" required minlength="5" max="5">

    <label for="password">Mot de passe:</label>
    <input type="password" type="password" name="password" required minlength="4" maxlength="30">

    <button type="submit">Se connecter</button>
</form>