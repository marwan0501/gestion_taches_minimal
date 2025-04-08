<?php
require 'db.php';

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $stmt = $pdo->prepare("SELECT id, mot_de_passe FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        $_SESSION['utilisateur_id'] = $user['id'];
        header('Location: dashboard.php');
        exit;
    } else {
        $message = "Identifiants incorrects.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Connexion</title></head>
<body>
<h2>Connexion</h2>
<form method="POST">
    Email: <input type="email" name="email" required><br>
    Mot de passe: <input type="password" name="mot_de_passe" required><br>
    <button type="submit">Se connecter</button>
</form>
<p><?= $message ?></p>
<p><a href="inscription.php">Créer un compte</a></p>
</body>
</html>