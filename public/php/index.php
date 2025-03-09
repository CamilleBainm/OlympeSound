<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Streaming</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- En-tête du site -->
    <header>
        <h1>Bienvenue sur OlympeSound</h1>
        <nav>
            <a href="#">Accueil</a>
            <a href="#">Chansons</a>
            <a href="#">Connexion</a>
        </nav>
    </header>

    <!-- Section de connexion -->
    <section id="login-section">
        <h2>Connexion</h2>
        <form action="login.php" method="post">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Se connecter</button>
        </form>
    </section>

    <!-- Liste des chansons -->
    <section id="songs-list">
        <h2>Chansons disponibles</h2>
        <ul>
            <li>
                <div class="song">
                    <h3>Nom de la chanson 1</h3>
                    <p>Artiste 1</p>
                    <audio controls>
                        <source src="chanson1.mp3" type="audio/mp3">
                        Votre navigateur ne prend pas en charge la balise audio.
                    </audio>
                </div>
            </li>
            <li>
                <div class="song">
                    <h3>Nom de la chanson 2</h3>
                    <p>Artiste 2</p>
                    <audio controls>
                        <source src="chanson2.mp3" type="audio/mp3">
                        Votre navigateur ne prend pas en charge la balise audio.
                    </audio>
                </div>
            </li>
            <!-- Ajoutez d'autres chansons ici -->
        </ul>
    </section>

    <!-- Pied de page -->
    <footer>
        <p>&copy; 2025 OlympeSound. Tous droits réservés.</p>
    </footer>
</body>
</html>
