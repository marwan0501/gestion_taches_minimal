<?php
require 'db.php';

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $message = "Cet email est déjà utilisé.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$nom, $prenom, $email, $mot_de_passe])) {
            $message = "Inscription réussie. <a href='connexion.php'>Connectez-vous</a>";
        } else {
            $message = "Erreur lors de l'inscription.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Inscription</title></head>
<body>
<h2>Inscription</h2>
<form method="POST">
    Nom: <input type="text" name="nom" required><br>
    Prénom: <input type="text" name="prenom" required><br>
    Email: <input type="email" name="email" required><br>
    Mot de passe: <input type="password" name="mot_de_passe" required><br>
    <button type="submit">S'inscrire</button>
</form>
<p><?= $message ?></p>
</body>
</html>