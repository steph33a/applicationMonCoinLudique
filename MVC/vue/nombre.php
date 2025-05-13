<?php

    if (!isset($_POST["btnValider"])) {
        $_SESSION['borneInf'] = 1;
         $_SESSION['borneSup'] = 100;
        //  $_SESSION['firstGame'] = false;
         $_SESSION['message'] = "";
         $_SESSION['win'] = false;
         $_SESSION['nbAleatoire'] = rand($_SESSION['borneInf'], $_SESSION['borneSup']);
         $_SESSION["nbEssai"]=0;
         $_SESSION['messageNbEssai'] = "";
         $_SESSION["message"]="";
        

        }
    if (isset($_POST["btnValider"])) {
        // $borneInf = $_SESSION["borneInf"];
        // $borneSup = $_SESSION["borneSup"];
        // $nbAleatoire = $_SESSION["nbAleatoire"];
        $_SESSION["nbChoisi"]= $_POST["nbChoisi"];
        // $firstGame = $_SESSION["firstGame"];
        // $_SESSION["nbEssai"]
        $_SESSION["nbEssai"] += 1;
       
        $_SESSION["messageNbEssai"]="nombre de coups: ".$_SESSION["nbEssai"];
        if ($_SESSION["nbAleatoire"] != $_SESSION["nbChoisi"]) {
           
            
            $_SESSION["win"] = false;
    
            if ($_SESSION["nbChoisi"] > $_SESSION["nbAleatoire"]) {
                $_SESSION["message"]  = " plus petit.";
                if ($_SESSION["nbChoisi"] < $_SESSION["borneSup"]) {
                    $_SESSION["borneSup"] = $_SESSION["nbChoisi"];
                }
            } else {
                $_SESSION["message"]= " plus grand";
                if ($_SESSION["nbChoisi"]  > $_SESSION["borneInf"]) {
                    $_SESSION["borneInf"] = $_SESSION["nbChoisi"] ;
                }
            }
        }
        $i=0;
    }

    // echo "Bonjour " . $_SESSION['pseudo'] . ", nous sommes ravis de vous voir à nouveau.";
    
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
      <script src="form_validations.js" defer></script>

    <link rel="stylesheet" href="styles.css">

</head>
<body>
 
<main>
     <div id="divBody">
  
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-6" id="divBody">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
        <h1 class="text-2xl font-bold text-center text-gray-800">Devine le Nombre</h1>

            <form action="nombre.php" method="POST" class="flex flex-col gap-4 mt-4">
                
                <div class="flex flex-col">
                    <label class="text-gray-600">Choisissez un nombre entre 1 et 100:</label>
                   
                </div>
                <input type="number" name="nbChoisi" class="w-full p-2 border rounded-lg" required placeholder="Entrez votre choix">
                <button type="submit" name="btnValider" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">Valider</button>
            </form>
            
          </div>
          <div>
            
            <?php
            if ($_SESSION["nbAleatoire"] == $_SESSION["nbChoisi"]) {
            $_SESSION["message"] = "🎉Félicitation! Vous avez le nombre mystère en". $_SESSION["nbEssai"]."nombre d'essais";
            $jeu="nombre";
            include_once 'save_score.php';
            sendScoreInBD($_SESSION['id'],$jeu,$_SESSION['score']);
        }
            ?>
             <p class="text-center text-gray-700 font-medium mt-4"> <?php echo $_SESSION["message"]; ?> </p>
          </div>
           <a href="controller.php?page=dashboard">retour au jeux </a>
    </div>
</div>
</main>
</body>
</html>


           
 