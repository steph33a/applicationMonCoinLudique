<?php
session_start();

// Exemple de rôles possibles : 'admin', 'utilisateur', null si non connecté
$role = $_SESSION['role'] ?? null;
$estConnecte = isset($_SESSION['user_id']); // ou autre variable qui dit si connecté
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MonCoinLudique</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../styles/styles.css" />
    <script src="../js/fichier.js" defer></script>
    <script src="../js/form_validations.js" defer></script>
    
</head>
<body class="accueilWithoutModalAndResearch" style="position:relative;">

<header style="display:flex; flex-direction:row; justify-content:space-between;">
    <div style="position:relative;" id="divLogo">
        <img style="position:absolute;" src="../images/logo.png" alt="recherche évenement jeux" />
        <h1 style="position:absolute">MonCoinLudique</h1>
    </div>
    <!-- c’est le bouton burger (trois barres), visible uniquement sur petits écrans. -->
    
    <nav>
            <div class="menu-toggle" id="menu-toggle">&#9776;</div>
            <?php if (!$estConnecte){?>
            <ul class="menu no_role">
                <!-- Visible uniquement quand on n’est PAS connecté -->
                 <li><a href="accueil.php">Accueil</a></li>
                <li><a href="#" class="openModalLink openModalLinkInscription" >Inscription</a></li>
               
                <li><a href="#" class="openModalLink openModalLinkConnexion">Connexion</a></li>
                
            </ul>
            <?php }else if (($role === 'utilisateur') || ($role === 'groupe')) {?>
                <ul class="menu utilisateur">
                    <li><a href="accueil.php">Accueil</a></li>
                    <!-- Visible uniquement quand on est connecté -->
                    <li><a href="monCompte.php">Mon compte</a></li>
                    <li><a href="gestion_evenements.php">Gestion<br>des événements</a></li>
                    <li><a href="..composants/modal/deconnexion.php">Déconnexion</a></li>
                </ul>
        
            <?php } 

            else if ($role === 'admin') {?>
                <ul class="menu admin">
                    <li><a href="accueil.php">Accueil</a></li>
                    <li><a class="openModalLink openModalLinkInscription" href="#" >Inscription</a></li>
                    <li><a class="openModalLink openModalLinkConnexion" href="#" >Connexion</a></li>
                    <li><a href="monCompte.php">Mon compte</a></li>
                    <li><a href="gestion_evenements.php">Gestion<br>des événements</a></li>
                    <li><a href="gestion_utilisateurs.php">Gestion<br>des utilisateurs</a></li>
                    <li><a href="../composants/modal/deconnexion.php">Déconnexion</a></li>
                </ul>
            
            <?php } ?>
        </ul>
    </nav>
</header>

<main style="position:relative; " id="mainAccueil" class="accueil mainWithoutModal">
    <div id="modal_content">
         <div style=" padding-bottom:50px; padding-top:50px;" class="modal" id="modalFormInscription" > <?php if ((!$estConnecte) || ($role === 'admin')) {include '../composants/modal/inscription.php';} ?> </div>
        <div style=" padding-bottom:50px; padding-top:50px;" class="modal" id="modalFormConnexion" >
            <?php if ((!$estConnecte) || ($role === 'admin')) {include '../composants/modal/connexion.php';} ?>
        </div>
        <div  style=" padding-bottom:50px; padding-top:50px;" class="modal" id="modalFormMotDePasseOublie">
        
        <?php if ((!$estConnecte) || ($role === 'admin')) { include '../composants/modal/motDePasseOublie.php'; }?>
        </div>
        <div style=" padding-bottom:50px; padding-top:50px;" class="modal" id="modalFormRedefinitionMotDePasse">
            <?php if ((!$estConnecte) || ($role === 'admin'))
            {
            include '../composants/modal/redefinition_motDePasse.php';} ?>
        </div>
        <div style=" padding-bottom:50px; padding-top:50px;" class="modal" id="modalConditionsUtilisation">
         <?php if ((!$estConnecte) || ($role === 'admin')) include '../composants/modal/conditionsUtilisation.php'; ?>
        </div>
        <div style=" padding-bottom:50px; padding-top:50px;" class="modal"id="modalFormRechercheAvancee">
            <?php include '../composants/modal/recherche_evenement.php'; ?>
        </div>
        <div style=" padding-bottom:50px; padding-top:50px;" class="modal" id="modalDetailsEvenement">
             <?php include '../composants/modal/detailsEvenement.php'; ?> 
        </div>
    </div>
     

    <div class="image-wrapper">
        <img src="../images/imagePresentation.png" alt="Image de couverture">
        <div class="textAndResearch">
            <h2 style="font-size: 36px;font-weight: 700;font-family:'nunito-sans', sans-serif;color: #F8F3EB">Rejoignez, créez et partagez des événements ludiques</h1>
            <h3 style="font-size: 24px;font-weight: 700;font-family:'nunito-sans', sans-serif;color: #F8F3EB">Une plateforme pour réunir les passionnés de jeux de société </h3>
            <form action="../controller/controller.php" method="post" id="rechercheEvenement">
                <h4 style="font-size:18px;">recherche</h4>
                <input style="font-size:18px;color:#6EBA46; height:40px:" type="text" name="recherche" id="inputrecherche" placeholder="Rechercher un événement">
                
                <input type="button" value="Rechercher" name="btnRecherche" id="btnRecherche">


            </form>
        </div>
        
      
    
    </div>
 
</main>

<?php include('../composants/includes/footer.php'); ?>
 

