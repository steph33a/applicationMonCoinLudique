<?php

include_once 'db.php';

global $connexion_bd;

//vérification si on a une variable de session car on s'est connecté
if (isset($_SESSION['id'])) {
   
    // Mélange aléatoirement les lettres
    if (isset($_POST["btnSubmit"])) {
       
        $proposition=$_POST["proposition"];
        if ($proposition == $_SESSION['wordMelange']) {
            $_SESSION['score']+=1;
            getWordMelange();
           
            
        } else{
            include_once 'save_score.php';
            $jeu="mot_melange";
            sendScoreInBD($_SESSION['id'],$jeu,$_SESSION['score']);
             $_SESSION['score']=0;
             getWordMelange();
        }

        

    } else {
        echo "pas de submit";
           $_SESSION['score']=0;
         getWordMelange();
    }
    
    // echo "Bonjour " . $_SESSION['pseudo'] . ", nous sommes ravis de vous voir à nouveau.";
    $i=0;
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <script src="form_validations.js" defer></script>
 <link rel="stylesheet" href="styles.css">
    
</head>
<body>

<main>
    <div>
        <p>Jeu du mot mélangé</p>
            <p><?php echo $_SESSION['wordMelange']; ?> </p>
    </div>

    <div id="divBody">
        <form action="mot_melange.php" method="POST">
            <input type="text" name="proposition" id="proposition" placeholder="votre proposition">
            <input type="submit" value="valider" name="btnSubmit">
        </form>
<p>votre score actuel:<?php echo $_SESSION['score']; ?></p>

          <a href="controller.php?page=dashboard">retour au jeux </a>
    </div>
  

</main>
<footer>
    <p>Footer</p>
</footer>
</body>
</html>

<?php
} else if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    exit();
}
?>

<a href="controller.php?page=dashboard">Aller à l'accueil</a>
<!-- Ici :

L'URL complète est : controller.php?page=dashboard

La query string est : page=dashboard

🧠 Que fait PHP avec ça ?
PHP va automatiquement lire cette query string et la mettre dans la variable spéciale $_GET.

Résultat :
php
Copier
Modifier
$_GET = [
  "page" => "dashboard"
];
Donc, dans ton code, tu peux utiliser :

php
Copier
Modifier
$_GET['page']
pour accéder à la valeur "dashboard".

❌ Pourquoi on dit que ce n’est "pas directement accessible" ?
Parce que page n’est pas une variable normale que tu déclares.
Elle n'existe que si l'URL contient une query string comme ?page=quelquechose.

Autrement dit, PHP ne crée $_GET['page'] que si la requête contient ?page=....

✅ Ce qu’il faut retenir
La query string vient dans l’URL, après ? :
Exemple : controller.php?page=dashboard&autre=valeur

PHP met automatiquement ces infos dans $_GET :

php
Copier
Modifier
$_GET['page'] // vaut "dashboard"
$_GET['autre'] // vaut "valeur"
Tu dois tester si elle existe avant de l’utiliser :

php
Copier
Modifier
if (isset($_GET['page'])) {
    // sécuriser ton code ici
}
Souhaites-tu que je te montre comment gérer plusieurs paramètres dans une query string ? -->