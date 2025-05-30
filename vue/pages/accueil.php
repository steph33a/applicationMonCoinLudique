<?php

session_start();
// session_destroy();
 var_dump($_SESSION);
// echo "session id :".$_SESSION['user_id'];
// echo"session role :".$_SESSION['role'];
// Exemple de rôles possibles : 'admin', 'utilisateur', null si non connecté
$role = $_SESSION['role'] ?? null;
var_dump($role);
$affichageFormulaireRedefinitionMotDePasse = (isset($_SESSION["affichageFormulaireRedefinitionMotDePasse"]) && $_SESSION["affichageFormulaireRedefinitionMotDePasse"]) ? true : false;
echo "affichageFormulaireRedefinitionMotDePasse:" . $affichageFormulaireRedefinitionMotDePasse;
$estConnecte = isset($_SESSION['id_utilisateur']); // ou autre variable qui dit si connecté
$page_contexte = 'accueil';
include('../composants/includes/header.php');
?>

<main style="position:relative; " id="mainAccueil" class="accueil mainWithoutModal">
    <div id="modal_content">
        <div style=" position:relative;" class="modal-wrapper">
            <div style=" padding-bottom:50px; padding-top:50px;" class="modal" id="modalFormInscription" > 
            <?php if ((!$estConnecte) || ($role === 'admin')) {include '../composants/modal/inscription.php';} ?>
            </div>
            <div style="display:block;" class="modal-spacer"></div>
        </div>
        
        <div style=" position:relative;" class="modal-wrapper">
            <div style=" padding-bottom:50px; padding-top:50px;" class="modal" id="modalFormConnexion" >
            <?php if ((!$estConnecte) || ($role === 'admin')) {include '../composants/modal/connexion.php';} ?>
            </div>
            <div style="display:block;" class="modal-spacer"></div> 
        </div> 


       
       
        
        <div style=" position:relative;" class="modal-wrapper">
            <div  style=" padding-bottom:30px; padding-top:30px;" class="modal" id="modalFormMotDePasseOublie">
            <?php if ((!$estConnecte) || ($role === 'admin')) { include '../composants/modal/motDePasseOublie.php';}?>
            </div>
            <div style="display:block;" class="modal-spacer"></div>

         </div>
        <div style=" position:relative;" class="modal-wrapper">
            <div style=" padding-bottom:50px; padding-top:50px;" class="modal" id="modalFormRedefinitionMotDePasse">
            <?php if ((!$estConnecte) || ($role === 'admin'))
            {
            include '../composants/modal/redefinition_motDePasse.php';} ?>
            </div>
            <div style=" position:relative;"class="modal-spacer"></div>
       </div>
       <div style=" position:relative;" class="modal-wrapper">
                <div style=" padding-bottom:50px; padding-top:50px;" class="modal <?php if (!$affichageFormulaireRedefinitionMotDePasse) echo 'displayNone'; ?>" id="modalConditionsUtilisation">
                <?php if ((!$estConnecte) || ($role === 'admin')) include '../composants/modal/conditionsUtilisation.php'; ?>
                </div>
                 <div style="display:block;" class="modal-spacer"></div>
       </div>
       <div style=" position:relative;" class="modal-wrapper">
           <div style=" padding-bottom:50px; padding-top:50px;" class="modal"id="modalFormRechercheAvancee">
            <?php include '../composants/modal/recherche_evenement.php'; ?>
            </div>
            <div  style="display:block;"class="modal-spacer"></div>

       </div>
        <div class="modal-wrapper">
            <div style=" padding-bottom:50px; padding-top:50px;" class="modal" id="modalDetailsEvenement">
                <?php include '../composants/modal/detailsEvenement.php'; ?> 
            </div>
            <div  style="display:block;"class="modal-spacer"></div>
        </div>
       
    </div>
    <div style="position:absolute;" id="presentation">
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
     
</main>

<?php include('../composants/includes/footer.php'); ?>
 

