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
    
</head>
<body>

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
                <li><a href="../modal/inscription.php">Inscription</a></li>
                <li><a href="../modal/connexion.php">Connexion</a></li>
            </ul>
            <?php }else if ($role === 'utilisateur') {?>
                <ul class="menu utilisateur">
                    <li><a href="accueil.php">Accueil</a></li>
                    <!-- Visible uniquement quand on est connecté -->
                    <li><a href="monCompte.php">Mon compte</a></li>
                    <li><a href="gestion_evenements.php">Gestion<br>des événements</a></li>
                    <li><a href="inscriptionsEvenements.php">Gestion<br>des inscriptions</a></li>
                    <li><a href="../modal/deconnexion.php">Déconnexion</a></li>
                </ul>
        
            <?php } else if ($role === 'groupe') {
                ?>
                <ul class="menu groupe">
                    <li><a href="accueil.php">Accueil</a></li>
                    <!-- Visible uniquement quand on est connecté -->
                    <li><a href="monCompte.php">Mon compte</a></li>
                    <li><a href="gestion_evenements.php">Gestion<br>des événements</a></li>
                    <li><a href="../modal/deconnexion.php">Déconnexion</a></li>
                </ul> <?php
            }

            else if ($role === 'admin') {?>
                <ul class="menu admin">
                    <li><a href="accueil.php">Accueil</a></li>
                    <li><a href="monCompte.php">Mon compte</a></li>
                    <li><a href="gestion_evenements.php">Gestion<br>des événements</a></li>
                    <li><a href="inscriptionsEvenements.php">Gestion<br>des inscriptions</a></li>
                    <li><a href="gestion_utilisateurs.php">Gestion<br>des utilisateurs</a></li>
                    <li><a href="../modal/deconnexion.php">Déconnexion</a></li>
                </ul>
            
            <?php } ?>
        </ul>
    </nav>
</header>

<main>
    <!-- contenu -->
</main>

<footer>
    <!-- pied de page -->
</footer>

</body>
</html>
