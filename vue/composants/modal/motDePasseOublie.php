

 
        
      
       
        <form class="formulaire" id="formulaireRecuperationDeMotDePasse" action="../controller/controller.php" method="POST">
              <h2 style=" font-size: 36px; font-weight: 700; margin-left: auto; margin-right: auto; margin-top: 28px; font-family: 'Nunito Sans', sans-serif;"> Mot de passe Oublié</h2>
            
           <!-- Nom de famille -->
            <label>Quel est </label>
            <input  class="formElement"type="text" id="username" name="username" min="2" placeholder="nom" required autofocus>
            
             <p class="commentaire displayNone" id="usernameCommentaire"></p>
            <!-- prénom -->
            <input  class="formElement" type="text" id="userPrenom" name="userPrenom" min="2" placeholder="prénom" required>
            <br>
            <p class="commentaire displayNone" id="userPrenomCommentaire"></p>
           
             
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
