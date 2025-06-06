


  
     <form class="formulaire" id="formulaireRedefinitionMotDePasse" action="../../controller/controller.php" method="POST">
    <h2 class="titreFormulaire">Récupération du mot de passe</h2>

    <label for="motDePasseRedefinition" class="labelForm">Mot de passe</label>  
    <input class="formElement inputMDP" type="password" id="motDePasseRedefinition" name="motDePasse" placeholder="Mot de passe" required>
    <p class="commentaire motDePasseCommentaire displayNone" id="motDePasseCommentaire"></p>

    <input type="hidden" name="email" id="emailRedefinition" class="email formElement" value="<?php echo $_SESSION['email']; ?>" readonly>

    <div class="checkboxContainer">
        <input type="checkbox" name="voirMDP" id="voirMDPPremier" class="checkboxVoirMDP">
        <label for="voirMDPPremier">Afficher le mot de passe</label>
    </div>

    <label for="confirmationMotDePasseRedefinition" class="labelForm">Confirmation du mot de passe</label>  
    <input class="formElement inputMDP" type="password" id="confirmationMotDePasseRedefinition" name="confirmationMotDePasse" placeholder="Mot de passe" required>
    <p class="commentaire motDePasseConfirmationCommentaire displayNone" id="motDePasseConfirmationCommentaire"></p>

    <div class="checkboxContainer">
        <input type="checkbox" name="voirMDP" id="voirMDPSecond" class="checkboxVoirMDP">
        <label for="voirMDPSecond">Afficher le mot de passe</label>
    </div>

    <input class="btnEnvoyer" type="submit" value="Envoyer" name="btnRedefinitionMotDePasse" id="btnRedefinitionMotDePasse">
</form>
