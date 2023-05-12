<?php
session_start(); // Démarrer la session PHP

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['id'])) {
    // Rediriger vers la page d'accueil ou le tableau de bord
    header("Location: dashboard.php");
    exit();
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure le fichier de configuration de la base de données
    require_once "config.php";

    // Récupérer les valeurs du formulaire
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Valider les valeurs du formulaire (vérification côté serveur)
    $errors = array();
    if (empty($email)) {
        $errors[] = "Veuillez entrer votre adresse e-mail.";
    }
    if (empty($password)) {
        $errors[] = "Veuillez entrer votre mot de passe.";
    }

    // Vérifier si les valeurs du formulaire sont valides
    if (empty($errors)) {
        // Requête SQL pour vérifier si l'utilisateur existe dans la base de données
        $query = "SELECT idutil, email, passwd FROM tc_utilisateur WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        
        // Vérifier si l'utilisateur existe dans la base de données
        if ($stmt->num_rows == 1) {
            // echo "- " . $stmt . "<br>";
            // L'utilisateur existe, vérifier le mot de passe
            $stmt->bind_result($id, $dbEmail, $dbPassword);
            $abc = $stmt->fetch();
            if (password_verify($password, $dbPassword)) {
                // Le mot de passe est correct, connecter l'utilisateur
                $_SESSION['id'] = $id;
                $_SESSION['email'] = $dbEmail;
                // Rediriger vers la page d'accueil ou le tableau de bord
                header("Location: dashboard.php");
                exit();
            } else {
                $errors[] = "Mot de passe incorrect.";
            }
        } else {
            $errors[] = "Adresse e-mail non trouvée.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
</head>

<body>
    <h1>Connexion</h1>
    <?php
    // Afficher les erreurs s'il y en a
    if (!empty($errors)) {
        echo "<div style='color: red;'>";
        foreach ($errors as $error) {
            echo "- " . $error . "<br>";
        }
        echo "</div>";
    }
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="email">Adresse e-mail:</label><br>
        <input type="email" name="email" required><br><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Se connecter">
    </form>
</body>

</html>