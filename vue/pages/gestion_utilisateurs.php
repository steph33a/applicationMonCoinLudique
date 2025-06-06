<?php
session_start();
$refreshConditions=false;
// if ($_SESSION){
// var_dump($_SESSION);
// }

$actionEnCours=false;
if (!empty($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $actionEnCours=true;
    echo "action en cours";
}


// Si on a une liste valide en session, on la récupère (temporairement)
if (isset($_SESSION['list_utilisateurs']) && is_array($_SESSION['list_utilisateurs'])) {
    $list_utilisateurs = $_SESSION['list_utilisateurs'];
    // unset($_SESSION['list_utilisateurs']);
    // echo "list_utilisateurs";
    // var_dump ($list_utilisateurs);
} else {
    $list_utilisateurs = [];
}

if ( isset($_SESSION["utilisateurSelected"])) {

        
        $utilisateurSelected=$_SESSION["utilisateurSelected"];
        
       
}else{
    
    $utilisateurSelected=null;
}
if (isset($_SESSION["action"]) ) {

        $action=$_SESSION["action"];
       
        
       
}else{
    $action=null;
   
}

// Si ce n'est pas une action POST ET qu'on ne veut pas rafraîchir la session,
// alors on vide la session pour éviter de stocker inutilement
if ((!$actionEnCours)&&((!isset($_SESSION["refresh"])||((isset($_SESSION["refresh"]))&& ($_SESSION["refresh"] !== "gestion_utilisateurs"))))) {
    
     $action=$_SESSION["action"];
        $utilisateurSelected=$_SESSION["utilisateurSelected"];
        unset($_SESSION["action"]);
         unset($_SESSION["utilisateurSelected"]);
$list_utilisateurs = $_SESSION['list_utilisateurs'];
    unset($_SESSION['list_utilisateurs']);
    $refreshConditions=true;

} 


if (!isset($list_utilisateurs) || ($list_utilisateurs==null)) {
   $refreshConditions=true;
}

$_SESSION["data_transferred_from_controller"] = false;

// Exemple de rôles possibles : 'admin', 'utilisateur', null si non connecté
$role = $_SESSION['role'] ?? null;
$estConnecte = isset($_SESSION['id_utilisateur']); // ou autre variable qui dit si connecté
if (!$estConnecte) { 
    header('Location: accueil.php');
    exit();
} else if ($role !== 'admin') {
    header('Location: accueil.php');
    exit();
}
else {


include('../composants/includes/header.php') 

?>

<main class="gestion_utilisateurs">
    <?php
    
    
   

    if ($refreshConditions) { ?>
     
        <div id="formulaire_invisible">
            <form id="autoSubmitForm" action="../../controller/controller.php" method="post" style="display:none;">
                <input type="hidden" name="page_contexte" value="gestion_utilisateurs">
                <input type="hidden" name="btnResearchAllInfosOfAllUsers" >
                
            </form>
        </div>

    <?php ;
    } 
   ?>
    <div class="gestion_utilisateurs_title"><h1>Gestion des Utilisateurs</h1></div>
    <section class="table-container">
    <table class="user-table">
        <thead>
            <th>👤 Pseudo</th>
            <th>📧 Email</th>
            <th>🎯 Rôle</th>
            <th>📅 Inscription</th>
            <th>🟢 Statut</th>
            <th>⚙️ Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align:center, height:50px">
            <?php foreach ($list_utilisateurs as $utilisateur) {
                ?> 
                <td><?php echo $utilisateur['pseudo']?></td>
                <td><?php echo $utilisateur['email']?></td>
                <td><?php echo $utilisateur['role']?></td>
                <td><?php echo $utilisateur['dateInscription']?></td>
                <td>Actif</td>
                <td class="actions">
                    
                    <form style="display:flex; flex-direction:row; gap:10px;" action="../../controller/controller.php" method="post">
                        
                        <input type="hidden" name="id_utilisateur" value="<?php echo $utilisateur['id_utilisateur'] ?>">
                        <input type="hidden" name="page_contexte" value="gestion_utilisateurs" readonly>
                        <button type="submit" name="btnGetFormulaireModificationUser" class="btnModifyUser" title="Modifier">✏️</button>
                        <button type="submit" name="btnGetSectionWithInformationUser" class="btnVoirUser" title="Voir">👁️</button>
                        <button type ="submit" name="btnDeleteUser" title="Supprimer">🗑️</button>
                       
                    </form>
                    

                    
                </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
        </table>
    </section>
    <div class="overlay displayNone" id="globalOverlay">
        <!-- Modal INSCRIPTION -->
         
    
        <div class="modal displayNone" id="modalFormGestionUtilisateurInformationsUtilisateur">
        
            <span class="closeModal" data-target="modalFormLectureInformationsUtilisateur">&times;</span>
            <?php if ($role === 'admin') include '../composants/modal/informationsUtilisateur.php'; ?>
        </div>
       
         
        
    </div>
</main>  

    <?php
    include('../composants/includes/footer.php');
}
?>