<?php
require 'db.php';
require 'auth.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM taches WHERE id = ? AND utilisateur_id = ?");
$stmt->execute([$id, $_SESSION['utilisateur_id']]);
header('Location: dashboard.php');
exit;
?>