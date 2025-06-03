<?php
session_start();
// var_dump($_SESSION);
// echo"rentre dans gestion_evenements";
// sleep(3000);
$page_contexte = 'gestion_evenements';
// echo "session id :".$_SESSION['id_utilisateur'];
// echo"session role :".$_SESSION['role'];
//  echo $_GET['refresh'];
$list_evenements = [];
// var_dump($_SESSION['list_evenements']);
if (isset($_SESSION['list_evenements']) && is_array($_SESSION['list_evenements'])) {
    $list_evenements = $_SESSION['list_evenements'];
}
if ((isset($_SESSION["refresh"])&& $_SESSION["refresh"] === true)) {
    unset($_SESSION['list_evenements']);

    
}

// Exemple de rôles possibles : 'admin', 'utilisateur', null si non connecté
$role = $_SESSION['role'] ?? null;
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

<main id="gestionEvenements"class="gestion_evenements">
        
    <?php if (empty($list_evenements) && (isset($_SESSION['refresh']) ? $_SESSION['refresh'] : '') !== true) {    echo"refresh";?>
     
        <div id="formulaire_invisible">
            <form id="autoSubmitForm" action="../../controller/controller.php" method="post" style="display:none;">
                <input type="hidden" name="id_utilisateur" value="<?php echo htmlspecialchars($_SESSION['id_utilisateur']); ?>">
                <input type="hidden" name="researchAllEventForThisUser" value="allevent">
            </form>
        </div>

    <?php ;
    } else {
            $_SESSION['refresh'] = false;
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
        <?php if (empty($list_evenements)){ ?>
        <p  style="display:block; margin: 45px auto 0 auto; text-align:center;">Aucun événement approuvé pour le moment.</p>
        <?php }else{ ?>
    <div style="display:block;" class="miniEventToActionsContent">
        
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