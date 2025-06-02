
<?php if (!$estConnecte ||!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {?>
   
    <form class="formulaire" style="background-color: #FFFFFF ; display: flex; flex-direction: column;justify-content:space-between; align-items:center; " id="formulaireConnexion" action="../../controller/controller.php" method="POST">
        <h2 style="width: 305px; font-size: 36px; font-weight: 700; margin-left: auto; margin-right: auto; margin-top: 28px; font-family: 'Nunito Sans', sans-serif;">Connexion</h2>
    
        <!-- <label for="username">Nom d'utilisateur:</label>
        <input  class="formElement"type="text" id="username" name="username" min="2"  required autofocus>
        <br> -->
        <label style=" width: 305px;text-align: left; font-size: 18px; font-family: 'Nunito Sans', sans-serif; color: #000000; margin-top:20px;" for="mailConnexion">Email</label>
       
        <input style="width: 305px; font-weight:600; margin-top:10px; padding-right: 25px; text-align: left; font-size: 18px; font-family: 'Nunito Sans', sans-serif; color: #4c4c4c; margin-top:20px;" class="email formElement" type="email" id="mailConnexion" name="email" placeholder="Email" autofocus required>

         <p style="width: 305px;" class="mailCommentaire displayNone" id="mailCommentaireConnexion"></p>

        <label style="width: 305px; text-align: left; font-size: 18px; font-family: 'Nunito Sans', sans-serif; color: #000000; margin-top:20px;" for="motDePasseConnexion">Mot de passe</label>  
        <input style="width: 305px;font-weight:600; margin-top:10px; padding-right: 25px; text-align: left; font-size: 18px; font-family: 'Nunito Sans', sans-serif; color: #4c4c4c; margin-top:20px;" class="motDePasse formElement"type="password" id="motDePasseConnexion"  name="motDePasse" placeholder="Mot de passe"  required>
       
        <p style="width: 305px;" class="motDePasseCommentaire displayNone" ></p>
        <div style="display: flex; flex-direction: row; width: 305px;">
            <input type="checkbox" name="voirMDP" id="voirMDPConnexion">
            <label for="voirMDP">Afficher le mot de passe</label><br>
        </div>
         
        
        <ul style="width: 305px;margin-top:28px; list-style-type:none; display: flex; flex-direction: row; justify-content: space-between;">
            
            <li><a class="openModalLink" href="#" id="openModalLinkMotDePasseOublie">Mot de passe oublié</a></li>
            <li><a class="openModalLink openModalLinkInscription" href="#" id="openModalLinkInscription">Inscription</a></li>

        </ul>
        
        <button style="width:114px; height:40px;background-color: #6EBA46; color: #FFFFFF; font-size:18px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" class="btnFormulaire" type="submit" id="btnConnexion" name="btnConnexion" id='btnConnexion' class="">connexion</button>
        
        <div id="formulaireConnexionCommentaire"></div>
    </form>  

<?php } else if ($_SESSION['role'] == 'admin') {?>
     <form class="formulaire" style="background-color: #FFFFFF ; display: flex; flex-direction: column;justify-content:space-between; align-items:center; " id="formulaireLoginAsUser" action="../../controller/controller.php" method="POST">
        <h2 style="width: 305px; font-size: 36px; font-weight: 700; margin-left: auto; margin-right: auto; margin-top: 28px; font-family: 'Nunito Sans', sans-serif;">Mode administrateur : Connexion en tant qu'un autre utilisateur </h2>
    
        <!-- <label for="username">Nom d'utilisateur:</label>
        <input  class="formElement"type="text" id="username" name="username" min="2"  required autofocus>
        <br> -->
        <label style=" width: 305px;text-align: left; font-size: 18px; font-family: 'Nunito Sans', sans-serif; color: #000000; margin-top:20px;" for="pseudoConnexion">pseudo</label>
       
        <input style="width: 305px; font-weight:600; margin-top:10px; padding-right: 25px; text-align: left; font-size: 18px; font-family: 'Nunito Sans', sans-serif; color: #4c4c4c; margin-top:20px;" class="pseudo formElement" type="text" id="pseudoConnexion" name="pseudo" placeholder="pseudo" autofocus required>

         <p style="width: 305px;" class="pseudoCommentaire displayNone" id="pseudoCommentaireConnexion"></p>

        
         
        
        <ul style="width: 305px;margin-top:28px; list-style-type:none; display: flex; flex-direction: row; justify-content: space-between;">
            
            <!-- <li><a class="openModalLink" href="#" id="openModalLinkMotDePasseOublie">Mot de passe oublié</a></li> -->
            <li><a class="openModalLink openModalLinkInscription" href="#" id="openModalLinkInscription">Inscription</a></li>

        </ul>
        
        <button style="width:114px; height:40px;background-color: #6EBA46; color: #FFFFFF; font-size:18px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" class="btnFormulaire" type="submit" id="btnAdminLoginAsUser" name="btnAdminLoginAsUser" id="btnAdminLoginAsUser" class="btn">Se Connecter en tant que cet utilisateur</button>
        
        <div id="formulaireConnexionCommentaire"></div>
    </form>  
<?php } ?>


    