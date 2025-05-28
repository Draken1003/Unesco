<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/color_var.css">
</head>
<body>
    <span class="background"></span>

    <form action="traitement_inscription.php" method="POST">
        <div class="sign-container">
            <img src="img/user.png" class="default-pfp">
            <p>Créer un compte</p>

            <div class="info-client">
                <div class="input">
                    <input type="text" name="nom" placeholder="Nom" required>
                </div>
                <div class="input">
                    <input type="text" name="prenom" placeholder="Prénom" required>
                </div>
                <div class="input">
                    <input type="number" name="age" placeholder="Âge" required min="1">
                </div>
                <div class="input">
                    <select name="sexe" required>
                        <option value="" disabled selected>Sexe</option>
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
                <div class="input">
                    <input type="email" name="email" placeholder="Adresse e-mail" required>
                </div>
                <div class="input">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                </div>

                <input type="submit" value="S'inscrire">

                <div class="infos">
                    <a href="login.php">Déjà un compte ? Connectez-vous ici</a>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
