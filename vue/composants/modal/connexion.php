

    
    <form class="formulaire" style="background-color: #FFFFFF ; display: flex; flex-direction: column;justify-content:space-between; align-items:center; " id="formulaireConnexion" action="../controller/controller.php" method="POST">
        <h2 style="width: 305px; font-size: 36px; font-weight: 700; margin-left: auto; margin-right: auto; margin-top: 28px; font-family: 'Nunito Sans', sans-serif;">Connexion</h2>
    
        <!-- <label for="username">Nom d'utilisateur:</label>
        <input  class="formElement"type="text" id="username" name="username" min="2"  required autofocus>
        <br> -->
        <label style=" width: 305px;text-align: left; font-size: 18px; font-family: 'Nunito Sans', sans-serif; color: #000000; margin-top:20px;" for="mail">Email</label>
       
        <input style="width: 305px; font-weight:600; margin-top:10px; padding-right: 25px; text-align: left; font-size: 18px; font-family: 'Nunito Sans', sans-serif; color: #4c4c4c; margin-top:20px;" class="formElement" type="text" id="mail" name="mail" placeholder="Email" autofocus required>

         <p style="width: 305px;" class="commentaire displayNone" id="mailCommentaire"></p>

        <label style="width: 305px; text-align: left; font-size: 18px; font-family: 'Nunito Sans', sans-serif; color: #000000; margin-top:20px;" for="motDePasse">Mot de passe</label>  
        <input style="width: 305px;font-weight:600; margin-top:10px; padding-right: 25px; text-align: left; font-size: 18px; font-family: 'Nunito Sans', sans-serif; color: #4c4c4c; margin-top:20px;" class="formElement"type="text" id="motDePasse" name="motDePasse" placeholder="Mot de passe"  required>
       
        <p style="width: 305px;" class="commentaire displayNone" id="motDePasseCommentaire"></p>
        <div style="display: flex; flex-direction: row; width: 305px;">
            <input type="checkbox" name="voirMDP" id="voirMDP">
            <label for="voirMDP">Afficher le mot de passe</label><br>
        </div>
         
        
        <ul style="width: 305px;margin-top:28px; list-style-type:none; display: flex; flex-direction: row; justify-content: space-between;">
            
            <li><a class="openModalLink" href="#" id="openModalLinkMotDePasseOublie">Mot de passe oublié</a></li>
            <li><a class="openModalLink openModalLinkInscription" href="#" id="openModalLinkInscription">Inscription</a></li>

        </ul>
        
        <button style="width:114px; height:40px;background-color: #6EBA46; color: #FFFFFF; font-size:18px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;"type="submit" class="btnFormulaire" type="submit" id="btnConnexion" name="btnConnexion" class="">connexion</button>
        
        <div id="formulaireConnexionCommentaire"></div>
    </form>  

