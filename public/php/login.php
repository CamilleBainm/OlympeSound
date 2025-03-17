<?php

session_start();
require_once '../../database/db_connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = trim($_POST['mail']);
    $passwd = trim($_POST['password']);

    if (empty($passwd) || empty($mail)) {
        $message = "Veuillez remplir tous les champs.";
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $message = "Adresse e-mail invalide.";
    } else {
        $stmt = $pdo->prepare("SELECT id, email, password_hash, `role` FROM users WHERE email = :mail");
        $stmt->execute(["mail" => $mail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($passwd, $user["password_hash"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["mail"] = $user["email"];
            $_SESSION['role'] = $user["role"];

            // Redirection vers le tableau de bord selon le rôle
            if ($user['role'] == 'admin') {
                echo "test";
                header("Location: index_admin.php");
                exit;
            } else {
                echo "test2";
                header("Location: index_user.php");
                exit;
            }
        } else {
            $message = "Email ou mot de passe incorrect.";
        }
    }
}
?>

<?php if (!empty($message)): ?>
    <p class="error-message"><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/connection.css?v=1.1">
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form method="POST" action="login.php">
            <label for="mail">Mail</label>
            <input type="email" name="mail" required>
            
            <label for="password">Mot de passe</label>
            <input type="password" name="password" required>
            
            <button type="submit">Se connecter</button>
        </form>
        <p>Vous n'avez pas de compte ? <a href="register.php">Enregistrez-vous</a></p>
    </div>
</body>
</html>
