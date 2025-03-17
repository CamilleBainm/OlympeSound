<?php
session_start();
require_once '../../database/db_connection.php';



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$message = '';
$message_type = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validation de l'adresse e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "L'adresse e-mail n'est pas valide.";
        $message_type = 'error-message';
    } else {
        // Vérifier si l'e-mail existe déjà
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            $message = "Cet e-mail est déjà utilisé.";
            $message_type = 'error-message';    
        } else {
            // Hachage sécurisé du mot de passe
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Insérer l'utilisateur dans la base de données
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, `role`) VALUES (:username, :email, :password_hash, 'user')");
            $success = $stmt->execute([
                'username' => $username,
                'email' => $email,
                'password_hash' => $passwordHash
            ]);

            if ($success) {
                $message = "Inscription réussie !";
                $message_type = 'success-message';
                // Rediriger vers la page de connexion ou une autre page appropriée
                //header("Location: login.php");
                
            } else {
                $message = "Erreur lors de l'inscription.";
                $message_type = 'error-message';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/connection.css">
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <?php if (!empty($message)): ?>
            <p class="<?php echo $message_type; ?>"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" required>
            
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required>
            
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            
            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà un compte ? <a href="login.php">Connectez-vous</a></p>
    </div>
</body>
</html>
