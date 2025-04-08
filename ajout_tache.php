<?php
require 'db.php';
require 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_limite = $_POST['date_limite'];
    $stmt = $pdo->prepare("INSERT INTO taches (utilisateur_id, titre, description, date_limite) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_SESSION['utilisateur_id'], $titre, $description, $date_limite]);
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Ajouter une tâche</title></head>
<body>
<h2>Ajouter une tâche</h2>
<form method="POST">
    Titre: <input type="text" name="titre" required><br>
    Description: <textarea name="description" required></textarea><br>
    Date limite: <input type="date" name="date_limite" required><br>
    <button type="submit">Ajouter</button>
</form>
<a href="dashboard.php">Retour</a>
</body>
</html>