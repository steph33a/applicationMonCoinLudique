<?php
session_start();

$page_contexte = 'gestion_evenements';
// Exemple de rôles possibles : 'admin', 'utilisateur', null si non connecté
$role = $_SESSION['role'] ?? null;
$evenements = $_SESSION['evenements'] ?? [];
$estConnecte = isset($_SESSION['user_id']); // ou autre variable qui dit si connecté
if (!$estConnecte) { 
    header('Location: accueil.php');
    exit();
} 
else {


include('../composants/includes/header.php') 

?>

<main id="gestionEvenements"class="gestion_evenements">
    <div class="gestion_evenements_title"><h2>Gestion des Evenements</h2></div>
    <div class="" id="creation_evenement">

        <button onclick="afficherFormulaireCreationEvenement()" id="btn_creation_evenement">créer un nouvel evenement</button>
        <div style="display:block;" id="content_modalFormCreationEvenemen">
           
            <?php  $mode="creationEvenement";
              include '../composants/includes/creation_evenement.php'; ?>


        </div>

    </div>
    <hr>
    <div class="gestion_evenements_title"><h2>Evenements approuvés</h2></div>
    <div class="miniEventToActionsContent">
   <?php if (empty($evenements)): ?>
    <p>Aucun événement approuvé pour le moment.</p>
     <?php else: ?>
    <div class="miniEventToActionsContent">
      <?php foreach ($evenements as $evenementSelected) {
          include '../composants/includes/miniEventToActions.php';
      } ?>
    </div>
     <?php endif; ?>

    </div>


</main>  

    <?php
    include('../composants/includes/footer.php');
}
?>