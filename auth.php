<?php
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: connexion.php');
    exit;
}
?>