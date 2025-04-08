<?php
session_start();
if (isset($_SESSION['utilisateur_id'])) {
    header('Location: dashboard.php');
} else {
    header('Location: connexion.php');
}
exit;
?>