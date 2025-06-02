<?php
session_start();
var_dump($_SESSION);
// echo"rentre dans gestion_evenements";
// sleep(3000);
$page_contexte = 'gestion_evenements';
// Exemple de rôles possibles : 'admin', 'utilisateur', null si non connecté
$role = $_SESSION['role'] ?? null;
$evenements = $_SESSION['evenements'] ?? [];
$estConnecte = isset($_SESSION['id_utilisateur']); // ou autre variable qui dit si connecté
if (!$estConnecte) { 
    header('Location: accueil.php');
    exit();
} 
else {
include('../composants/includes/header.php') ;

?>

<main id="gestionEvenements"class="gestion_evenements">
   <?php if ((!isset($_SESSION["list_evenements"]))&& (($_SESSION['role']=== 'groupe')|| ($_SESSION['role']=== 'particulier'))){?>
        
    <div id="formulaire_invisible">
        <form id="autoSubmitForm" action="../../controller/controller.php" method="post" style="display:none;">
            <!-- Tu peux ajouter des champs cachés ici -->
         <input type="hidden" name="id_utilisateur" value="<?php echo $_SESSION['id_utilisateur']; ?>">
        <input type="hidden" name="researchAllEventForThisUser" value="allevent"> <!-- Exemple d'action -->
        </form>
    </div>
    <?php }
   else {
        $list_evenements=$_SESSION["list_evenements"];
         unset($_SESSION["list_evenements"]);
    }
   ?>
    <div style="margin-top:75px;margin-left: 75px;" id="gestion_evenements_title" class="gestion_evenements_title"><h2>Gestion des Evenements</h2></div>
    <div style="dislay:flex; flex-direction:column; justify-content:space-between, gap:20px;" class="" id="creation_evenement">

        <button class="btn" style="display:block;margin: 45px auto 0 auto;" onclick="afficherFormulaireCreationEvenement()" id="btn_creation_evenement">créer un nouvel evenement</button>
        <div style="display:block;" id="content_modalFormCreationEvenemen">
           
            <?php  $mode="creationEvenement";
              include '../composants/includes/creation_evenement.php'; ?>


        </div>

    </div>
    <hr>
    <div style="margin-top:75px;margin-left: 75px;" class="gestion_evenements_title"><h2>Evenements approuvés</h2></div>
    <div style="display:block; margin: 45px auto 45px auto;"class="miniEventToActionsContent">
        <?php if (empty($evenements)): ?>
        <p  style="display:block; margin: 45px auto 0 auto; text-align:center;">Aucun événement approuvé pour le moment.</p>
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