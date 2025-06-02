<?php


session_start();
// session_destroy();
//   var_dump($_SESSION);
//   $_SESSION["email"] ="stephaniemarquant87@gmail.com";
// echo "accueil ligne8";
// var_dump($_SESSION);

// echo "accueil ligne10"; 
// echo "session id :".$_SESSION['user_id'];
// echo"session role :".$_SESSION['role'];
// Exemple de rôles possibles : 'admin', 'utilisateur', null si non connecté

// var_dump($role);
// 
// echo "affichageFormulaireRedefinitionMotDePasse:" . $affichageFormulaireRedefinitionMotDePasse;



$affichageFormulaireRedefinitionMotDePasse = (isset($_SESSION["redefinitionMotDePasse"]) && $_SESSION["redefinitionMotDePasse"]) ? true : false;
unset($_SESSION['redefinitionMotDePasse']);
$estConnecte = isset($_SESSION['id_utilisateur']); // ou autre variable qui dit si connecté
 $role = $_SESSION['role'] ?? null;
 $page_contexte = 'accueil';
include('../composants/includes/header.php');

$list_evenements = $_SESSION["list_evenements"] ?? null;
if ($list_evenements) {
    unset($_SESSION["list_evenements"]); // on vide la session pour forcer un refresh au prochain chargement
}
?>

<main style="display:flex; flex-direction:column;gap:20px;">
    <div style="display:flex;height:60vh; position:relative; " id="mainAccueil" class="accueil mainWithoutModal">
        <?php if (!$list_evenements) {?>
        <div id="formulaire_invisible">
            <form id="autoSubmitForm" action="../../controller/controller.php" method="post" style="display:none;">
                <!-- Tu peux ajouter des champs cachés ici -->
                <input type="hidden" name="id_utilisateur" value="<?php echo $_SESSION['id_utilisateur']; ?>">
            
                <input type="hidden" name="researchAllEvent" value="lister_evenements"><!-- Exemple d'action -->
            </form>
        </div>
        <?php
        } 
    ?>
        <div id="modal_content">
            <div style=" position:relative;" class="modal-wrapper">

                <div style=" padding-bottom:50px; padding-top:50px;" class="modal" id="modalFormInscription" > 
                    <span class="closeModal" data-target="modalFormInscription">&times;</span>
                <?php if ((!$estConnecte) || ($role === 'admin')) {include '../composants/modal/inscription.php';} ?>
                </div>
                <div style="display:block;" class="modal-spacer"></div>
            </div>
            
            <div style=" position:relative;" class="modal-wrapper">
                <div style=" padding-bottom:50px; padding-top:50px;" class="modal" id="modalFormConnexion" >
                    <span class="closeModal" data-target="modalFormConnexion">&times;</span>
                <?php if ((!$estConnecte) || ($role === 'admin')) {include '../composants/modal/connexion.php';} ?>
                </div>
                <div style="display:block;" class="modal-spacer"></div> 
            </div> 


        
        
            
            <div style=" position:relative;" class="modal-wrapper">
                <div  style=" padding-bottom:30px; padding-top:30px;" class="modal" id="modalFormMotDePasseOublie">
                    <span class="closeModal" data-target="modalFormMotDePasseOublie">&times;</span>
                <?php if ((!$estConnecte) || ($role === 'admin')) { include '../composants/modal/motDePasseOublie.php';}?>
                </div>
                <div style="display:block;" class="modal-spacer"></div>

            </div>
            <div style=" position:relative;" class="modal-wrapper">
                <div style=" padding-bottom:50px; padding-top:50px;" class="modal" id="modalFormConditionsUtilisation">
                    <span class="closeModal" data-target="modalFormConditionsUtilisation">&times;</span>
                <?php if ((!$estConnecte) || ($role === 'admin'))
                {
                include '../composants/modal/conditionsUtilisation.php';} ?>
                </div>
                <div style=" position:relative;"class="modal-spacer"></div>
        </div>
        <div style=" position:relative;" class="modal-wrapper">

                    <div style=" padding-bottom:50px; padding-top:50px;" class="modal <?php echo (!$affichageFormulaireRedefinitionMotDePasse) ? 'displayNone':'displayBlock'; ?>" id="modalFormRedefinitionMotDePasse">
                    <span class="closeModal" data-target="modalFormRedefinitionMotDePasse">&times;</span>
                    <?php if ((!$estConnecte) || ($role === 'admin')) include '../composants/modal/redefinition_motDePasse.php'; ?>
                    </div>
                    <div style="display:block;" class="modal-spacer"></div>
        </div>
        <div style=" position:relative;" class="modal-wrapper">
            
            <div style=" padding-bottom:50px; padding-top:50px;" class="modal"id="modalFormRechercheAvancee">
                <span class="closeModal" data-target="modalFormRechercheAvancee">&times;</span>
                <?php include '../composants/modal/recherche_evenement.php'; ?>
                </div>
                <div  style="display:block;"class="modal-spacer"></div>

        </div>
            <div class="modal-wrapper">

                <div style=" padding-bottom:50px; padding-top:50px;" class="modal" id="modalDetailsEvenement">
                        <span class="closeModal" data-target="modalDetailsEvenement">&times;</span>
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
        <?php foreach ($list_evenements as $evenementSelected) {
             include '../composants/includes/mini_event.php';} 
             ?>



    </div>
     
</main>

<?php include('../composants/includes/footer.php'); ?>
 

