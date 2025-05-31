<?php
session_start();

$evenment = $_SESSION['evenementSelected'];
// Exemple de rôles possibles : 'admin', 'utilisateur', null si non connecté
$role = $_SESSION['role'] ?? null;
$estConnecte = isset($_SESSION['id_utilisateur']); // ou autre variable qui dit si connecté
if (!$estConnecte) { 
    header('Location: accueil.php');
    exit();
} 
else {


include('../composants/includes/header.php') 

?>

<main class="actions_evenement">
    <div class="actions_evenement_title"><h2>Votre evenement</h2></div>

    <div class="miniEvent">
      <?php 
          include '../composants/includes/miniEvent.php';
      } ?>
    </div>
    <div class="actions_evenement"><h2>action sur votre événement</h2></div>
    <button onclick="afficherFormulaireModificationEvenement()">Modifier l'événement</button>

    

    <form onsubmit="return confirmerSuppression()" method="post" action="/supprimerEvenement">
        <input type="hidden" name="evenement_id" value="<?php echo $evenment['id']; ?>"> <!-- ID de l'événement -->
        <button type="submit" style="color: red;">Supprimer l'événement</button>
    </form>
    <div style=" padding-bottom:50px; padding-top:50px; " class="modal display_none"id="modificationEvenementContent">
            <?php $mode="modificationEvenement";
            include '../composants/includes/creation_evenement.php'; ?>
    </div>
</main>  

    <?php
    include('../composants/includes/footer.php');

?>