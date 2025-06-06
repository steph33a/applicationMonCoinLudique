
<?php
session_start();
if (isset($_SESSION["phraseEchec"] )){
        ?>
        <p> <?php echo $_SESSION["phraseEchec"]; ?></p>
        <?php
    }
$refreshConditions=false;
$actionEnCours=false;
  var_dump($_SESSION);
if (isset($_SESSION["refresh"])) {

   $actionEnCours=true;
}
$list_evenements = [];
// var_dump($_SESSION);
// Si on a une liste valide en session, on la récupère (temporairement)
if (isset($_SESSION['list_evenements']) && is_array($_SESSION['list_evenements'])) {
    $list_evenements = $_SESSION['list_evenements'];
}
if (!isset($_SESSION['list_evenements']) || ($_SESSION['list_evenements']==null)) {

     $refreshConditions=true;
}

if (isset($_SESSION['evenementSelectedSpecial']))
{
    $evenementSelectedSpecial = $_SESSION['evenementSelectedSpecial'];
    
    $refreshConditions=false;
    // var_dump($evenementSelected);
} 
if (isset($_SESSION['evenementSelected'])&&($_SESSION['evenementSelected']==false))
{
    $refreshConditions=true;
    // var_dump($evenementSelected);
}


if ((!$actionEnCours)&&((!isset($_SESSION["data_transferred_from_controller"]))||(isset($_SESSION["data_transferred_from_controller"])&& $_SESSION["data_transferred_from_controller"] === false))) {
    $list_evenements = [];
    unset($_SESSION['evenementSelected']);

    unset($_SESSION['list_evenements']);
     $refreshConditions=true;

} 
     $_SESSION["data_transferred_from_controller"] = false;
// if  ($refreshConditions==true)
// {
//     echo "refresh conditions true";
    
// }else {
//      echo "refresh conditions false";
// }

$estConnecte = isset($_SESSION['id_utilisateur']); // ou autre variable qui dit si connecté
 $role = $_SESSION['role'] ?? null;
 $page_contexte = 'accueil';
include('../composants/includes/header.php');

?>

<main style="display:flex; flex-direction:column;gap:20px; width:100%; justify-content:center; align-items:center">
    <?php
    if (isset($_SESSION["phraseEchec"] )){
        ?>
        <p> <?php echo $_SESSION["phraseEchec"]; ?></p>
        <?php
    }
    ?>
    <div style="display:flex;min_height:337px; position:relative; " id="mainAccueil" class="accueil mainWithoutModal">
      
   
        <div class="overlay displayNone" id="globalOverlay">
            <!-- Modal INSCRIPTION -->
            <div class="modal displayNone" id="modalFormInscription">
                <span class="closeModal" data-target="modalFormInscription">&times;</span>
                <?php if (!$estConnecte || $role === 'admin') include '../composants/modal/inscription.php'; ?>
            </div>

            <!-- Modal CONNEXION -->
            <div class="modal displayNone" id="modalFormConnexion">
                <span class="closeModal" data-target="modalFormConnexion">&times;</span>
                <?php if (!$estConnecte || $role === 'admin') include '../composants/modal/connexion.php'; ?>
            </div>
            <!-- Modal CONNEXION -->
            <div class="modal displayNone" id="modalFormVisionEvenementAndInscription">
                <span class="closeModal" data-target="modalFormVisionEvenementAndInscription">&times;</span>
                <?php if (!$estConnecte || $role === 'admin') include '../composants/modal/detailsEvenement.php'; ?>
            </div>
            

            <!-- Modal MOT DE PASSE OUBLIÉ -->
            <div class="modal displayNone" id="modalFormMotDePasseOublie">
                <span class="closeModal" data-target="modalFormMotDePasseOublie">&times;</span>
                <?php if (!$estConnecte || $role === 'admin') include '../composants/modal/motDePasseOublie.php'; ?>
            </div>

            <!-- Modal CONDITIONS -->
            <div class="modal displayNone" id="modalFormConditionsUtilisation">
                <span class="closeModal" data-target="modalFormConditionsUtilisation">&times;</span>
                <?php if (!$estConnecte || $role === 'admin') include '../composants/modal/conditionsUtilisation.php'; ?>
            </div>

            <!-- Modal RÉINITIALISATION DE MOT DE PASSE -->
            <div class="modal  <?php echo empty($affichageFormulaireRedefinitionMotDePasse) ? 'displayNone' : 'displayBlock'; ?>" id="modalFormRedefinitionMotDePasse">
                <span class="closeModal" data-target="modalFormRedefinitionMotDePasse">&times;</span>
                <?php if (!$estConnecte || $role === 'admin') include '../composants/modal/redefinition_motDePasse.php'; ?>
            </div>

            <!-- Modal RECHERCHE AVANCÉE -->
            <div class="modal displayNone" id="modalFormRechercheAvancee">
                <span class="closeModal" data-target="modalFormRechercheAvancee">&times;</span>
                <?php include '../composants/modal/recherche_evenement.php'; ?>
            </div>
        </div>
        <div style="height:337px,position:absolute;" id="presentation">
            <div  style="position:relative;" class="image-wrapper">
                <img src="../images/imagePresentation.png" alt="Image de couverture">
                <div class="textAndResearch">
                    <h2 style="font-size: 36px;font-weight: 700;font-family:'nunito-sans', sans-serif;color: #F8F3EB">Rejoignez, créez et partagez des événements ludiques</h2>
                    <h3 style="font-size: 24px;font-weight: 700;font-family:'nunito-sans', sans-serif;color: #F8F3EB">Une plateforme pour réunir les passionnés de jeux de société </h3>
                    <form action="../controller/controller.php" method="post" id="rechercheEvenement">
                        <h4 style="font-size:18px;">recherche</h4>
                        <input style="font-size:18px;color:#6EBA46; height:40px:" type="text" name="recherche" id="inputrecherche" placeholder="Rechercher un événement">
                        
                        <input type="button" value="Rechercher" name="btnRecherche" id="btnRecherche">


                    </form>
                </div>

            </div>
        </div>  
    


        <?php if (($estConnecte) && ($role=="particulier" || $role=="groupe")) {   ?>
        <div style="display:block;" id="btnInsciptionEvent">
             <form id="formulaireGoInscription" action="../../controller/controller.php" method="post" style="display:block;">
            <!-- Tu peux ajouter des champs cachés ici -->
             <input type="hidden" name="id_utilisateur" value="<?php echo $_SESSION['id_utilisateur']; ?>">
          
            <button style="margin:25px auto 0 auto; display:block;" class="btn" type="submit" name="researchAllInscriptionsForThisUser" value="voir inscriptions">
             Voir inscriptions
            </button> <!-- Exemple d'action -->
            </form>
        </div>

        <?php } ?>
       

        <div style="display:block;" id="miniEventsContainers">
        <?php 
        if (is_array($list_evenements)) {
            foreach ($list_evenements as $evenementSelected) {
                if (is_array($evenementSelected)) {
                    
                    include '../composants/includes/mini_event.php';
                } else {
                        
                    echo  "<p>" . htmlspecialchars($evenementSelected) . "</p>";
                }
                
            }
            
        } else {
            echo  "<p>" . htmlspecialchars($list_evenements) . "</p>";
        }
    
        ?>
        


        </div>
    </div>
    <?php  if ($refreshConditions) { ; ?>
        <div id="formulaire_invisible">
            <form id="autoSubmitForm" action="../../controller/controller.php" method="post" style="display:none;">
                <!-- Tu peux ajouter des champs cachés ici -->
                <?php if (isset($evenementSelectedSpecial['id_evenement'])) { ?>
                <input id="id_evenementParticulier" type="hidden" name="id_evenement" value="<?php echo $evenementSelectedSpecial['id_evenement']; ?>">
                <?php } ?>
               
                <input type="hidden" name="page_contexte" value="accueil">
                <input type="hidden" name="refresh" value="done">
            
                <input type="hidden" name="refreshAllEvents" value="researchAllEvent"><!-- Exemple d'action -->
            </form>
        </div>
        <?php 
        } 
    ?>
        
</main>


<?php  include('../composants/includes/footer.php'); ?>
 

