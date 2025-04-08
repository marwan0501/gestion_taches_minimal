<?php
require 'db.php';
require 'auth.php';

$utilisateur_id = $_SESSION['utilisateur_id'];
$stmt = $pdo->prepare("SELECT * FROM taches WHERE utilisateur_id = ? ORDER BY date_limite ASC");
$stmt->execute([$utilisateur_id]);
$taches = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mes tâches</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Mes Tâches</h2>
<a href="ajout_tache.php">Ajouter une tâche</a> | <a href="deconnexion.php">Déconnexion</a>
<table border="1" cellpadding="10">
    <tr><th>Titre</th><th>Description</th><th>Date limite</th><th>Statut</th><th>Actions</th></tr>
    <?php foreach ($taches as $tache): ?>
        <tr>
            <td><?= htmlspecialchars($tache['titre']) ?></td>
            <td><?= htmlspecialchars($tache['description']) ?></td>
            <td><?= htmlspecialchars($tache['date_limite']) ?></td>
            <td><?= htmlspecialchars($tache['statut']) ?></td>
            <td>
                <?php if ($tache['statut'] != 'Terminée'): ?>
                    <a href="terminer_tache.php?id=<?= $tache['id'] ?>">Terminer</a> |
                <?php endif; ?>
                <a href="modifier_tache.php?id=<?= $tache['id'] ?>">Modifier</a> |
                <a href="supprimer_tache.php?id=<?= $tache['id'] ?>" onclick="return confirm('Supprimer cette tâche ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
