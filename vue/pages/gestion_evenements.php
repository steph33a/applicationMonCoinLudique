<?php
session_start();
 var_dump($_SESSION);
// echo"rentre dans gestion_evenements";
// sleep(3000);
$role = $_SESSION['role'] ?? null;
$page_contexte = 'gestion_evenements';
$eventsVisible = "eventPersonnel";
if ($role == "admin") {
    if (!isset($_SESSION['affichage'])) {
        $eventsVisible= "eventPersonnel";
        // Ton code ici
    } else {
        $eventsVisible = $_SESSION['affichage'];
    }
}
  $refreshConditions=false;
// echo "session id :".$_SESSION['id_utilisateur'];
// echo"session role :".$_SESSION['role'];
//  echo $_GET['refresh'];

$actionEnCours=false;
if (!empty($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $actionEnCours=true;
}
$list_evenements = [];

// Si on a une liste valide en session, on la récupère (temporairement)
if (isset($_SESSION['list_evenements']) && ($_SESSION['list_evenements']!=null)) {
    $list_evenements = $_SESSION['list_evenements'];
}
if (!isset($_SESSION['list_evenements']) || ($_SESSION['list_evenements']=null)) {
   $refreshConditions=true;
}

// Si ce n'est pas une action POST ET qu'on ne veut pas rafraîchir la session,
// alors on vide la session pour éviter de stocker inutilement
if ((!$actionEnCours)&&((!isset($_SESSION["refresh"])||(isset($_SESSION["refresh"])&& $_SESSION["refresh"] !=="gestion_evenements")))) {

    unset($_SESSION['$list_evenements']);
    $refreshContitions=true;

} 


// $evenements = $_SESSION['evenements'] ?? [];
$estConnecte = isset($_SESSION['id_utilisateur']); // ou autre variable qui dit si connecté
if (!$estConnecte) { 
    header('Location: accueil.php');
    exit();
} 
else {
include('../composants/includes/header.php') ;
}
?>

<main  style="display:flex; flex-direction:column; justify-content:space-between, align-items:center; gap:20px;" id="gestionEvenements"class="gestion_evenements">
     <?php
    if ($refreshConditions) { ?>
     
        <div id="formulaire_invisible">
            <form id="autoSubmitForm" action="../../controller/controller.php" method="post" style="display:none;">
                
                <?php if ($eventsVisible == "eventPersonnel") {?> 
                <input type="hidden" name="page_contexte" value="gestion_evenements">
                <input type="hidden" name="id_utilisateur" value="<?php echo htmlspecialchars($_SESSION['id_utilisateur']); ?>">
                <input type="hidden" name="researchAllEventForThisUser" value="alleventForThisUser">
                <?php } else { ?>
                <input type="hidden" name="researchAllEvent" value="allevent">
                <?php } ?>
            </form>
        </div>

    <?php ;
    } 
    // else{
    //         $_SESSION['refresh'] = false;
    //     }
   ?>
    <div>
        <form action="../../controller/controller.php" method="post">
                <input type="hidden" name="page_contexte" value="gestion_evenements">
                <button class="btn" style="display:block;margin: 45px auto 0 auto;" name="researchAllEvent" id="btn_rechercheAllEvent32">gérer tous les événements</button>
        </form>
    </div>
    <div>
        <form action="../../controller/controller.php" method="post">
                <input type="hidden" name="page_contexte" value="gestion_evenements">
                 <input type="hidden" name="id_utilisateur" value="<?php echo htmlspecialchars($_SESSION['id_utilisateur']); ?>">
                <button class="btn" style="display:block;margin: 45px auto 0 auto;" name="researchAllEventForThisUser" id="btn_rechercheAllEvent34">gérer ses événements d'admin</button>
        </form>
    </div>
    <div style="margin-top:75px;margin-left: 75px;" id="gestion_evenements_title" class="gestion_evenements_title"><h2>Gestion des Evenements</h2></div>
    <div style="dislay:flex; flex-direction:column; justify-content:space-between, gap:20px;" class="" id="creation_evenement">

        <button class="btn" style="display:block;margin: 45px auto 0 auto;" onclick="afficherFormulaireCreationEvenement()" id="btn_creation_evenement">créer un nouvel evenement</button>
        <div style="display:block; display:flex; flex-direction:column; justify-content:space-between, gap:20px;" id="content_modalFormCreationEvenemen">
           
            <?php  $mode="creationEvenement";
              include '../composants/includes/creation_evenement.php'; ?>


        </div>

    </div>
    <hr>
    <div style="margin-top:75px;margin-left: 75px;" class="gestion_evenements_title"><h2>Evenements approuvés</h2></div>
    <div style="display:block; margin: 45px auto 45px auto;"class="miniEventToActionsContent">
        <?php  if (empty($list_evenements)){  echo "non";?>
        <p  style="display:block; margin: 45px auto 0 auto; text-align:center;">Aucun événement approuvé pour le moment.</p>
        <?php }else{ ?>
    <div style="display:block;" class="miniEventToActionsContent" id="miniEventToActionsContent">
        
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
        <?php } ?>

    </div>


</main>  

    <?php
    include('../composants/includes/footer.php');

?>