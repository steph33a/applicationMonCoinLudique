<?php


session_start();
// session_destroy();
//   var_dump($_SESSION);
//   $_SESSION["email"] ="stephaniemarquant87@gmail.com";
// echo "accueil ligne8";
//  var_dump($_SESSION);

// echo "accueil ligne10"; 
// echo "session id :".$_SESSION['user_id'];
// echo"session role :".$_SESSION['role'];
// Exemple de rôles possibles : 'admin', 'utilisateur', null si non connecté

// var_dump($role);
$list_evenements = [];
// var_dump($_SESSION['list_evenements']);
if (isset($_SESSION['list_evenements']) && is_array($_SESSION['list_evenements'])) {
    $list_evenements = $_SESSION['list_evenements'];
}
if ((isset($_SESSION["refresh"])&& $_SESSION["refresh"] === true)) {
    unset($_SESSION['list_evenements']);

    
}

//  var_dump($_SESSION['list_evenements']);




$estConnecte = isset($_SESSION['id_utilisateur']); // ou autre variable qui dit si connecté
 $role = $_SESSION['role'] ?? null;
 $page_contexte = 'accueil';
include('../composants/includes/header.php');



?>

<main style="display:flex; flex-direction:column;gap:20px; width:100%; justify-content:center; align-items:center">
    <div style="display:flex;min_height:337px; position:relative; " id="mainAccueil" class="accueil mainWithoutModal">
      <?php   $refreshCondition = empty($list_evenements) && (!isset($_SESSION['refresh']) || $_SESSION['refresh'] !== true);
    
   

    if ($refreshCondition) { ?>
        <div id="formulaire_invisible">
            <form id="autoSubmitForm" action="../../controller/controller.php" method="post" style="display:none;">
                <!-- Tu peux ajouter des champs cachés ici -->
                <input type="hidden" name="page_contexte" value="accueil">
                <input type="hidden" name="id_utilisateur" value="<?php echo $_SESSION['id_utilisateur']; ?>">
            
                <input type="hidden" name="researchAllEvent" value="researchAllEvent"><!-- Exemple d'action -->
            </form>
        </div>
        <?php 
        } else {
            $_SESSION['refresh'] = false;
        }
    ?>
    </div>
    
       
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
        <div class="modal <?php echo !$affichageFormulaireRedefinitionMotDePasse ? 'displayNone' : 'displayBlock'; ?>" id="modalFormRedefinitionMotDePasse">
            <span class="closeModal" data-target="modalFormRedefinitionMotDePasse">&times;</span>
            <?php if (!$estConnecte || $role === 'admin') include '../composants/modal/redefinition_motDePasse.php'; ?>
        </div>

        <!-- Modal RECHERCHE AVANCÉE -->
        <div class="modal displayNone" id="modalFormRechercheAvancee">
            <span class="closeModal" data-target="modalFormRechercheAvancee">&times;</span>
            <?php include '../composants/modal/recherche_evenement.php'; ?>
        </div>

        <!-- Modal DÉTAILS ÉVÉNEMENT -->
        <div class="modal displayNone" id="modalDetailsEvenement">
            <span class="closeModal" data-target="modalDetailsEvenement">&times;</span>
            <?php include '../composants/modal/detailsEvenement.php'; ?>
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


    <?php if (($estConnecte) && ($role=="particulier" || $role=="groupe")) { ?>
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
    }
    ?>
    


    </div>
     
</main>

<?php include('../composants/includes/footer.php'); ?>
 

