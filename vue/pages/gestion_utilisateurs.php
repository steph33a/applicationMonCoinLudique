<?php
session_start();


// Exemple de rôles possibles : 'admin', 'utilisateur', null si non connecté
$role = $_SESSION['role'] ?? null;
$estConnecte = isset($_SESSION['id_utilisateur']); // ou autre variable qui dit si connecté
if (!$estConnecte) { 
    header('Location: accueil.php');
    exit();
} else if ($role !== 'admin') {
    header('Location: accueil.php');
    exit();
}
else {


include('../composants/includes/header.php') 

?>

<main class="gestion_utilisateurs">
    <div class="gestion_utilisateurs_title"><h1>Gestion des Utilisateurs</h1></div>
</main>  

    <?php
    include('../composants/includes/footer.php');
}
?>