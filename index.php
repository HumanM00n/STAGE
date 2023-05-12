<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CCS/index.css">
    <script href="../TMAconnect/PHP/Log.php"></script>
    <title>Authentification - TMAconnect</title>
</head>
<header>
    <center><img class="logo" src="../TMAconnect/img/NLogo.png"></center>
</header>

<body>
    <div class="container">
        <h2>
            <center>Connexion à votre compte</center>
        </h2>
        <!-- CHAMPS DE FORMULAIRE -->
        <form action="" method="post">
            <section class="bloc_id">
                <div class="identifiant">
                    <p>Identifiant</p>
                    <input class="champs_txt" type="text" name="username" required minlength="5" max="5">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                </div>
            </section>

            <div class="lmdp">
                <a href="mdp.php" class="tma-btn">Mot de passe oublié</a>
            </div>

            <section class="bloc_mdp">
                <div class="mdp">
                    <label>
                        <p>Mot de passe</p>
                        <input class="champs_txt" type="password" name="password" required minlength="4" maxlength="30">

                        <!-- ICONES -->
                        <div class="password-icon">
                            <i data-feather="eye"></i>
                            <i data-feather="eye-off"></i>
                        </div>
                    </label>

                    <script src="https://unpkg.com/feather-icons"></script>
                    <script>
                    feather.replace();
                    </script>

                    <script>
                    const eye = document.querySelector('.feather-eye');
                    const eyeoff = document.querySelector(' .feather-eye-off');
                    const passwordField = document.querySelector('input[type=password]');

                    eye.addEventListener('click', () => {
                        eye.style.display = "none";
                        eyeoff.style.display = "block";
                        passwordField.type = "text";
                    });

                    eyeoff.addEventListener('click', () => {
                        eyeoff.style.display = "none";
                        eye.style.display = "block";
                        passwordField.type = "password";
                    });
                    </script>
                </div>
                <a href="../TMAconnect/home.php"><input class="tma-btn" type="submit" value="Se Connecter"></a>
            </section>
        </form>
        <label class="remember"><input type="checkbox">Se souvenir de moi</label>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>



</body>

</html>