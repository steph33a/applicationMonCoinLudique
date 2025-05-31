
<?php
session_start();
// Supprime toutes les variables de session actuelles (vide la session).
session_unset();
// Détruit la session en supprimant toutes les données associées côté serveur.
session_destroy();
header('Location: accueil.php');
exit();
?>