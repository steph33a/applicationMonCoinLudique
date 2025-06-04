<?php
session_start();
$list_utilisateurs = [];
var_dump($_SESSION);
// var_dump($_SESSION['list_evenements']);
if (isset($_SESSION['list_utilisateurs']) && is_array($_SESSION['list_utilisateurs'])) {
    $list_utilisateurs = $_SESSION['list_utilisateurs'];
}
if ((isset($_SESSION["refresh"])&& $_SESSION["refresh"] === true)) {
    unset($_SESSION['list_utilisateurs']);

    
}

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
    $refreshCondition = empty($list_evenements) && (!isset($_SESSION['refresh']) || $_SESSION['refresh'] !== true);
    
   

    if ($refreshCondition) { ?>
     
        <div id="formulaire_invisible">
            <form id="autoSubmitForm" action="../../controller/controller.php" method="post" style="display:none;">
                <input type="hidden" name="page_contexte" value="gestion_utilisateurs">
                <input type="hidden" name="btnResearchAllInfosOfAllUsers" >
                
            </form>
        </div>

    <?php ;
    } else{
            $_SESSION['refresh'] = false;
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
                <tr>
                <?php foreach ($list_utilisateurs as $utilisateur) {
                    ?> 
                    <td>$utilisateur['pseudo']</td>
                    <td>$utilisateur['email']</td>
                    <td>$utilisateur['role']</td>
                    <td>$utilisateur['dateInscription']</td>
                    <td>Actif</td>
                    <td class="actions">
                        <form action="../../controller/controller.php" method="post">
                            <input type="hidden" name="id_utilisateur" value="$utilisateur['id_utilisateur']">
                            <button type="submit" name="btnResearchAllProfilInfosForThisUser" title="Modifier">✏️</button>
                            <button type ="submit" name="btnDeleteUser" title="Supprimer">🗑️</button>
                            <button type="submit" name="btnResearchAllProfilInfosForThisUser" title="Voir">👁️</button>
                        </form>
                        
                    </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            </table>
        </section>
        </main>  

    <?php
    include('../composants/includes/footer.php');
}
?>