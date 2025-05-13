
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
    <div id="contentPageInscription">

    
        <form class="formulaire" id="formulaireInscription" action="register.php" method="POST">
            <h3>Formulaire d'inscription</h3>
           <!-- Nom de famille -->
            <input  class="formElement"type="text" id="username" name="username" min="2" placeholder="nom" required autofocus>
            <br>
             <p class="commentaire displayNone" id="usernameCommentaire"></p>
            <!-- prénom -->
            <input  class="formElement" type="text" id="userPrenom" name="userPrenom" min="2" placeholder="prénom" required>
            <br>
            <p class="commentaire displayNone" id="userPrenomCommentaire"></p>
            <br>
             
            <input class="formElement"type="text" id="mail" name="mail" placeholder="mail" required>
        
            <br>
            <p class="commentaire displayNone" id="mailCommentaire"></p>

            <input class="formElement"type="text" id="motDePasse" name="motDePasse" placeholder="mot de passe" required>
            <br>
            <p class="commentaire displayNone" id="motDePasseCommentaire"></p>
            <br>
            <div>
                <input type="checkbox" name="voirMDP" id="voirMDP">
                <label for="voirMDP">Afficher le mot de passe</label><br>
            </div>
            <input class="btnFormulaire" type="submit" id="btn" name="btnInscription" class="btn" value="S'inscrire">
            <div>
                <div id="formCommentaire"></div>
                <a id="formLien" href="index.php">se connecter</a>
            </div>
            

        </form>
    </div>
   

</main>
</body>
</html>
