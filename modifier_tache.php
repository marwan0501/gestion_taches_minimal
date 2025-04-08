<?php
require 'db.php';
require 'auth.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM taches WHERE id = ? AND utilisateur_id = ?");
$stmt->execute([$id, $_SESSION['utilisateur_id']]);
$tache = $stmt->fetch();

if (!$tache) {
    die("Tâche introuvable.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_limite = $_POST['date_limite'];
    $stmt = $pdo->prepare("UPDATE taches SET titre = ?, description = ?, date_limite = ? WHERE id = ?");
    $stmt->execute([$titre, $description, $date_limite, $id]);
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Modifier une tâche</title></head>
<body>
<h2>Modifier une tâche</h2>
<form method="POST">
    Titre: <input type="text" name="titre" value="<?= htmlspecialchars($tache['titre']) ?>" required><br>
    Description: <textarea name="description" required><?= htmlspecialchars($tache['description']) ?></textarea><br>
    Date limite: <input type="date" name="date_limite" value="<?= $tache['date_limite'] ?>" required><br>
    <button type="submit">Enregistrer</button>
</form>
<a href="dashboard.php">Retour</a>
</body>
</html>