<?php
session_start();
if (!isset($_SESSION["id_utilisateur"] )){
 
    header('Location: accueil.php');
    exit();
} 
// var_dump($_SESSION);
$utilisateur = [];
// var_dump($_SESSION['list_evenements']);
if (isset($_SESSION['utilisateur'])) {
    $utilisateur = $_SESSION['utilisateur'];
}
if ((isset($_SESSION["refresh"])&& $_SESSION["refresh"] === true)) {
    unset($_SESSION['utilisateur']);

    
}

$id_utilisateur = '';
$image_profil="";
$pseudo = '';
$email = '';
$prenom_utilisateur = '';
$nom_utilisateur="";
$reponse1 = '';
$reponse2 = '';
$role="";

    if (!empty($utilisateur)) {
        $estConnecte=true;
        $id_utilisateur = $utilisateur['id_utilisateur'];
        $image_profil = $utilisateur['imageProfil'];
        $pseudo = $utilisateur['pseudo'];
        $email = $utilisateur['email'];
        $prenom_utilisateur = $utilisateur['prenom_utilisateur'];
        $nom_utilisateur = $utilisateur['nom_utilisateur'];
       
        $reponse1 = $utilisateur['reponse1'];
        $reponse2 = $utilisateur['reponse2'];
        $role = $utilisateur['role'];
    }
// Exemple de rôles possibles : 'admin', 'utilisateur', null si non connecté
$role = $_SESSION['role'] ?? null;



include('../composants/includes/header.php') 

?>

<main class="gestion_utilisateurs">
     <div style="display:flex;min_height:337px; position:relative; " id="mainAccueil" class="accueil mainWithoutModal">
        <?php if (empty($utilisateur) && (isset($_SESSION['refresh']) ? $_SESSION['refresh'] : '') !== true) {?>
        <div id="formulaire_invisible">
            <form id="autoSubmitForm" action="../../controller/controller.php" method="post" style="display:none;">
                <!-- Tu peux ajouter des champs cachés ici -->
                <input type="hidden" name="id_utilisateur" value="<?php echo $_SESSION['id_utilisateur']; ?>">
                <input type="hidden" name="page_contexte" value="monCompte">
            
                <input type="hidden" name="btnResearchAllProfilInfosForThisUser" value="lister_evenements"><!-- Exemple d'action -->
            </form>
        </div>
        <?php 
        } else {
            $_SESSION['refresh'] = false;
        }
    ?>
    </div>
    
    <div class="gestion_utilisateurs_title"><h2>Profil</h2></div>
    <h3>Paramètre du compte</h3>

    <form action="../../controller/controller.php" method="post">
        <input type="hidden" name="page_contexte" value="monCompte">
        
        <label for="pseudo">Pseudo</label>
        
        <input type="text" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>">
       
        <label for="email">Email</label>
       
        <input type="email" name="email" id="email" value="<?php echo $email; ?>">
         
        <label for="prenom_utilisateur">prenom utilisateur</label>
        <input type="text" name="prenomUtilisateur" id="prenom_utilisateur" value="<?php echo $prenom_utilisateur; ?>">
         
        <label for="nom_utilisateur">nom utilisateur</label>
        <input type="text" name="nomUtilisateur" id="nom_utilisateur" value="<?php echo $nom_utilisateur; ?>">
         
        <label for="motDePasse">Mot de passe</label>
        <input type="password" name="motDePasse" id="password" placeholder="Modifier le mot de passe">
         
        <label for="confirmationMotDePasse">confirmation mot de passe</label>
        <input type="password" name="confirmationMotDePasse" id="password" placeholder="confirmerlenouveaumotdepasse">
        
        <h3>Informations à donner pour la récupération de compte</h3>
         
        <label for="question1">Répondre à la question1 quel est votre jeu préféré ?</label>
        <input class="jeuPrefereUser" type="text" name="jeuPrefereUser" id="reponse1" value="<?php echo $reponse1; ?>">
        
        <label for="question2">Répondre à la question2 quel est votre chanteur préféré ?</label>
        <input class="chanteurPrefereUser" type="text" name="chanteurPrefereUser" id="reponse2" value="<?php echo $reponse2; ?>">
        
        <input type="hidden" name="id_utilisateur" value="<?php echo $_SESSION['id_utilisateur']; ?>">
        <button class="btn" type="submit" name="actionModifierParametresCompte" value="modifierCompte">Modifier le compte</button>
    </form>
</main>  

    <?php
    include('../composants/includes/footer.php');

?>

