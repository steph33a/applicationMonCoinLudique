<?php
$affichageFormulaireRedefinitionMotDePasse = (isset($_SESSION["redefinitionMotDePasse"]) && $_SESSION["redefinitionMotDePasse"]) ? true : false;
if ($affichageFormulaireRedefinitionMotDePasse==true) {
    unset($_SESSION['redefinitionMotDePasse']);
}


// echo "modal4:" . $_SESSION['modal'] ;
if ($affichageFormulaireRedefinitionMotDePasse==true) {
    $_SESSION['modal'] = 'redefinitionMotDePasse';
    // echo "ligne6";
} else {
// echo "affichageFormulaireRedefinitionMotDePasse:" . $affichageFormulaireRedefinitionMotDePasse;

}

$modal=null;
if ($modal="visionEvenementAndInscription" && (!isset($evenementSelectedSpecial)|| $evenementSelectedSpecial == null)) {
    $modal="";
}
//  var_dump($_SESSION['modal']);
if (isset($_SESSION['modal'])) {
$modal = $_SESSION['modal'];
//  echo"modal:" . $modal ;

}

if (isset($_GET['modal'])) {
    $modal = $_GET['modal'];
    //  echo "modal: " . htmlspecialchars($modal);
}
// echo $modal;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MonCoinLudique</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../styles/styles.css" />
    <script>
    
     let modalToOpen = <?php echo json_encode($modal); ?>;
    </script>
    <script src="../js/fichier.js" defer></script>
    
</head>
<body class="accueilWithoutModalAndResearch" style="display:flex; flex-direction:column;">
<header style="height:100px;">
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
            <?php }else if (($_SESSION['role'] === 'particulier') || ($_SESSION['role'] === 'groupe')|| ($_SESSION['role'] === 'moderateur')) {?>
                <ul class="menu utilisateur">
                    <li><a href="accueil.php">Accueil</a></li>
                    <!-- Visible uniquement quand on est connecté -->
                    <li><a href="monCompte.php">Mon compte</a></li>
                    <li><a href="gestion_evenements.php">Gestion<br>des événements</a></li>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                </ul>
        
            <?php } 

            else if ($_SESSION['role'] === 'admin') {?>
                <ul class="menu admin">
                    <li><a href="accueil.php?modal=">Accueil</a></li>
                    <li><a class="" href="accueil.php?modal=inscription" >Inscription</a></li>
                    <li><a class="" href="accueil.php?modal=connexion" >Connexion</a></li>
                    <li><a href="monCompte.php">Mon compte</a></li>
                    <li><a href="gestion_evenements.php">Gestion<br>des événements</a></li>
                    <li><a href="gestion_utilisateurs.php">Gestion<br>des utilisateurs</a></li>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                </ul>
            
            <?php } ?>
        </ul>
    </nav>
</header>