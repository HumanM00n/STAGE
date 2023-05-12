<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../TMAconnect/CCS/change-mdp.css">
    <title>Changement de mot de passe</title>
</head>
<header>
    <center><img class="logo" src="../TMAconnect/img/NLogo.png"></center>
</header>

<!-- Mettre l'oeil sur les champs de mot de passe -->

<!-- Mettre l'oeil sur les champs de mot de passe -->

<body>
    <div class="container">
        <h2>
            Mot de passe oublié ?
        </h2>
        <form action="" methode="POST"></form>
        <div class="lmpd-form">
            <section class="input-container">
                <p class="input--label">Nouveau mot de passe</p>
                <input class="input--value" type="password" required minlength="12" maxlength="30">
            </section>
            <section class="input-container">
                <p class="input--label">Confirmation mot de passe</p>
                <input class="input--value" type="password" required minlength="12" maxlength="30">
            </section>
        </div>
        <div>
            <button class="tma-btn">Enregistrer</button>
        </div>
    </div>
    <!-- Bloquer mdp oublié tant que l'id n'est pas renseigné ! -->


</body>

<?php
// On vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Vérification que les champs sont remplis
    if (empty($newPassword) || empty($confirmPassword)) {
        echo 'Tous les champs sont obligatoires.';
    } else {
        // Connexion à la base de données (à remplacer par vos identifiants)
        $dsn = 'mysql:host=localhost;dbname=nom_de_la_base_de_donnees;charset=utf8';                                         
        $user = 'nom_utilisateur';
        $password = 'mot_de_passe';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $pdo = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
            exit();
        }

        // Vérification que les nouveaux mots de passe correspondent
        if ($newPassword !== $confirmPassword) {
            echo 'Les nouveaux mots de passe ne correspondent pas.';
        } else {
            // Hashage du nouveau mot de passe
            $hash = password_hash($newPassword, PASSWORD_DEFAULT);

            // Mise à jour du mot de passe dans la base de données
            $query = 'UPDATE tc_utilisateur SET passwd = :password WHERE matricule = :matricule';
            $statement = $pdo->prepare($query);
            $statement->bindValue(':password', $hash);
            $statement->bindValue(':matricule', $_SESSION['user_id']);
            $statement->execute();

            echo 'Le mot de passe a été mis à jour.';
        }
    }
}
?>
<!-- Formulaire de changement de mot de passe -->