
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
<main id="connexion">
    <div id="contentPageConnexion">
    
    <form class="formulaire" id="formulaireConnexion" action="index.php" method="POST">
        <h2>Connexion</h2>
        <!-- <label for="username">Nom d'utilisateur:</label>
        <input  class="formElement"type="text" id="username" name="username" min="2"  required autofocus>
        <br> -->
       
        <input class="formElement"type="text" id="mail" name="mail" placeholder="Email" autofocus required>
        <br>
         <p class="commentaire displayNone" id="mailCommentaire"></p>
         
        <input class="formElement"type="text" id="motDePasse" name="motDePasse" placeholder="Mot de passe"  required>
       <p class="commentaire displayNone" id="motDePasseCommentaire"></p>
        <div>
            <input type="checkbox" name="voirMDP" id="voirMDP">
            <label for="voirMDP">Afficher le mot de passe</label><br>
        </div>
         
        <br>
        
        <button  class="btnFormulaire" type="submit" id="btnConnexion" name="btnConnexion" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">connection</button>
        
        <div id="formulaireConnexionCommentaire"></div>
    </form>

    <form action="register.php" method="get">
    <input type="submit" id="btnGoToInscription" name="btnGoToInscription" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition" value="s'enregistrer">
    </form>
</div>
     </main>
     
</body>
</html>
