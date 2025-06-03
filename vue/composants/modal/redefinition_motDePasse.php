


  
     
        <form class="formulaire" id="formulaireRedefinitionMotDePasse" action="../../controller/controller.php" method="POST">
             <h2 style=" font-size: 36px; font-weight: 700; margin-left: auto; margin-right: auto; margin-top: 28px; font-family: 'Nunito Sans', sans-serif;">Récupération du mot de passe</h2>
            
            
            <label style=" text-align: left; font-size: 18px; font-family: 'Nunito Sans', sans-serif; color: #000000; margin-top:20px;" for="motDePasseForRedefinition">Mot de passe</label>  
            
            <input style="font-weight:600; margin-top:10px; padding-right: 25px; text-align: left; font-size: 18px; font-family: 'Nunito Sans', sans-serif; color: #4c4c4c; margin-top:20px;" class="motDePasse formElement"type="text" id="motDePasseRedefinition" name="motDePasse" placeholder="Mot de passe"  required>
            <p class="motDePasseCommentaire displayNone" id="motDePasseCommentaire"></p>
            <div>
                <input type="hidden" name="email" id="emailRedefinition" class=" email formElement" value="<?php echo $_SESSION['email']; ?>" readonly >
            </div>
            <div>
                <input type="checkbox" name="voirMDP" id="voirMDPPremier">
                <label for="voirMDPPremier">Afficher le mot de passe</label><br>
            </div>
            <label style=" text-align: left; font-size: 18px; font-family: 'Nunito Sans', sans-serif; color: #000000; margin-top:20px;" for="confirmationMotDePasseSecond">confirmation du mot de passe</label>  
            
            <input style="font-weight:600; margin-top:10px; padding-right: 25px; text-align: left; font-size: 18px; font-family: 'Nunito Sans', sans-serif; color: #4c4c4c; margin-top:20px;" class="confirmationMotDePasse formElement"type="text" id="confirmationMotDePasseRedefinition" name="confirmationMotDePasse" placeholder="Mot de passe"  required>
            <p class="motDePasseConfirmationCommentaire displayNone" id="motDePasseConfirmationCommentaire"></p>
            <div>
                <input type="checkbox" name="voirMDP" id="voirMDPSecond">
                <label for="voirMDPSecond">Afficher le mot de passe</label><br>
            </div>
            <br>
            <input class="formElement" type="submit" value="Envoyer" name="btnRedefinitionMotDePasse" id="btnRedefinitionMotDePasse">
        </form>
    



        