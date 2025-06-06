<?php
session_start();
var_dump($_SESSION);
$evenementSelected=[];
$page_contexte = 'actions_evenement';
// var_dump($_SESSION);
// var_dump($_SESSION['list_evenements']);
if (isset($_SESSION["evenementSelected"])) {

    $evenementSelected = $_SESSION['evenementSelected'];
    // var_dump($evenementSelected);
}

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

<main class="actions_evenement" id="actions_evenement">
 
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
    <div style="display:flex; flex-direction:column; justify-content:center; align-items:center; gap:20px;">

        <div style="display:flex; gap:20px; justify-content:center; flex-wrap:wrap;">
            <button class="btn" onclick="afficherFormulaireModificationEvenement()">Modifier l'événement</button>

            <form onsubmit="return confirmerSuppression()"  action="../../controller/controller.php" method="post">
                <input type="hidden" name="id_evenement" value="<?php echo $evenementSelected['id_evenement']; ?>">
                <button name="btnSuppressionEvenement" value="supprimer" class="btn" type="submit">Supprimer l'événement</button>
            </form>
        </div>

    </div>

    
   
    <div style="display:none;    padding-bottom:50px; padding-top:50px; " id="modificationEvenementContent">
            <?php $mode="modificationEvenement";
            include '../composants/includes/creation_evenement.php'; ?>
    </div>
</main>  

    <?php
    include('../composants/includes/footer.php');

?>