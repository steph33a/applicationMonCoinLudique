<?php
session_start();
var_dump($_SESSION);

// Exemple de rôles possibles : 'admin', 'utilisateur', null si non connecté
$role = $_SESSION['role'] ?? null;
$estConnecte = isset($_SESSION['id_utilisateur']); // ou autre variable qui dit si connecté
if (!$estConnecte) { 
    header('Location: accueil.php');
    exit();
} 
else {


include('../composants/includes/header.php') 

?>

<main class="gestion_utilisateurs">
    <div class="gestion_utilisateurs_title"><h2>Profil</h2></div>
    <h3>Paramètre du compte</h3>
    <form action="../controller/controller.php" method="post">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" value="<?php echo $_SESSION['pseudo']; ?>">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo $_SESSION['email']; ?>">
        <label for="motDePasse">Mot de passe</label>
        <input type="password" name="motDePasse" id="password" placeholder="Modifier le mot de passe">
        <label for="confirmationMotDePasse">confirmation mot de passe</label>
        <input type="password" name="confirmationMotDePasse" id="password" placeholder="confirmerlenouveaumotdepasse">
        <h3>Informations à donner pour la récupération de compte</h3>
        <label for="question1">Répondre à la question1 quel est votre jeu préféré ?</label>
        <input class="jeuPrefereUser" type="text" name="question1" id="question1" value="<?php echo $_SESSION['question1']; ?>">
            <label for="question2">Répondre à la question2 quel est votre chanteur préféré ?</label>
        <input class="chanteurPrefereUser" type="text" name="question2" id="question1" value="<?php echo $_SESSION['question1']; ?>">
        <input type="hidden" name="id_utilisateur" value="<?php echo $_SESSION['id_utilisateur']; ?>">
        <btn type="submit" name="action" value="modifierCompte">Modifier le compte</btn>
    </form>
</main>  

    <?php
    include('../composants/includes/footer.php');
}
?>