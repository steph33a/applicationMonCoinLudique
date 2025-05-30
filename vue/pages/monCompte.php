<?php
session_start();


// Exemple de rôles possibles : 'admin', 'utilisateur', null si non connecté
$role = $_SESSION['role'] ?? null;
$estConnecte = isset($_SESSION['user_id']); // ou autre variable qui dit si connecté
if (!$estConnecte) { 
    header('Location: accueil.php');
    exit();
} 
else {


include('../composants/includes/header.php') 

?>

<main class="gestion_utilisateurs">
    <div class="gestion_utilisateurs_title"><h2>Profil</h2></div>
</main>  

    <?php
    include('../composants/includes/footer.php');
}
?>