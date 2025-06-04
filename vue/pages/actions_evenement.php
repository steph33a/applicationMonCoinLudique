<?php
session_start();
$evenementSelected=[];
$page_contexte = 'actions_evenement';
// var_dump($_SESSION['list_evenements']);
if (isset($_SESSION["evenementSelectedSpecial"])) {

    $evenementSelected = $_SESSION['evenementSelectedSpecial'];
    var_dump($evenementSelected);
}
if ((isset($_SESSION["refresh"])&& $_SESSION["refresh"] === true)) {
    unset($_SESSION['evenementSelectedSpecial']);

    
}
var_dump($evenementSelected);
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
 <?php if ($evenementSelected) {
    ?>
      <div class="miniEvent">
      <?php 
          include '../composants/includes/mini_event.php';
      } ?>
    </div> 
    <?php
 } ?>
   
    <div class="actions_evenement"><h2>action sur votre événement</h2></div>
    <button onclick="afficherFormulaireModificationEvenement()">Modifier l'événement</button>

    

    <form onsubmit="return confirmerSuppression()" method="post" action="/supprimerEvenement">
        <input type="hidden" name="id_evenement" value="<?php echo $evenementSelected['id_evenement']; ?>"> <!-- ID de l'événement -->
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