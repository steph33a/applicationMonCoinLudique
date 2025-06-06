<form class="formulaire" id="formulaireInscription" action="../../controller/controller.php" method="POST" enctype="multipart/form-data">
  <h2>Inscription</h2>

  <div class="formulaire-section" id="choix">
    <?php if ($role === 'admin') { ?>
      <div id="choixProfil" class="admin">
        <input type="radio" name="role" value="particulier" id="profilParticulier" checked><label for="profilParticulier">particulier</label>
        <input type="radio" name="role" value="groupe" id="profilGroupe"><label for="profilGroupe">groupe</label>
        <input type="radio" name="role" value="moderateur" id="profilModerateur"><label for="profilModerateur">modérateur</label>
        <input type="radio" name="role" value="administrateur" id="profilAdministrateur"><label for="profilAdministrateur">administrateur</label>
      </div>
    <?php } else { ?>
      <div id="choixProfil">
        <input type="radio" name="role" value="particulier" id="profilParticulier" checked><label for="profilParticulier">particulier</label>
        <input type="radio" name="role" value="groupe" id="profilGroupe"><label for="profilGroupe">groupe</label>
      </div>
    <?php } ?>

    <label for="photoInput" class="photo-label">
      <div class="photo-container">
        <img src="../images/avatar.png" alt="Photo" class="photo-preview" />
        <div class="photo-add-icon">+</div>
        <input type="file" name="imageProfil" id="photoInput" accept="image/*" class="photo-input" />
      </div>
    </label>
  </div>

  <div class="formulaire-section" id="formulaireContent">
    <label for="pseudoInscription">Pseudo :</label>
    <input class="pseudo pseudoformElement" type="text" name="pseudo" id="pseudoInscription">
    <p class="pseudoCommentaire displayNone" id="pseudoCommentaireInscription"></p>

    <label for="emailInscription">Email :</label>
    <input class="email formElement" type="email" name="email" id="emailInscription">
    <p class="emailCommentaire commentaire displayNone" id="emailCommentaireInscription"></p>

    <label for="motDePasseInscription">Mot de passe :</label>
    <input class="motDePasse formElement" type="password" name="motDePasse" id="motDePasseInscription">
    <p class="motDePasseCommentaire commentaire displayNone" id="motDePasseCommentaireInscription"></p>

    <div class="checkbox-row">
      <input type="checkbox" id="voirMDPInscription" class="formElement">
      <label for="voirMDPInscription">Voir le mot de passe</label>
    </div>

    <label for="confirmationMotDePasseInscription">Confirmation du mot de passe :</label>
    <input class="confirmationMotDePasse formElement" type="password" name="confirmationMotDePasse" id="confirmationMotDePasseInscription">
    <p class="confirmationMotDePasseCommentaire commentaire displayNone" id="confirmationMotDePasseCommentaireInscription"></p>

    <div class="checkbox-row">
      <input type="checkbox" id="voirConfMDPInscription" class="formElement">
      <label for="voirConfMDPInscription">Voir le mot de passe</label>
    </div>

    <label for="nomUtilisateurInscription">Nom :</label>
    <input class="nomUtilisateur formElement" type="text" id="nomUtilisateurInscription" name="nomUtilisateur" min="2" placeholder="nom" required autofocus>
    <p class="nomUtilisateurCommentaire commentaire displayNone"></p>
  </div>

  <div class="formulaire-section" id="formParticulier">
    <label for="prenomUtilisateurInscription">Prénom :</label>
    <input class="prenomUtilisateur formElement" type="text" name="prenomUtilisateur" id="prenomUtilisateurInscription">
    <p class="prenomUtilisateurCommentaire commentaire displayNone" id="prenomUtilisateurCommentaireInscription"></p>

    <label for="dateNaissance">Date de naissance :</label>
    <input class="dateNaissance formElement" type="date" name="dateNaissance" id="dateNaissance">
    <p class="dateNaissanceCommentaire commentaire displayNone" id="dateNaissanceCommentaire"></p>
  </div>

  <div class="formulaire-section" id="formGroupe">
    <!-- Champs dynamiques si nécessaires -->
  </div>

  <a href="#" id="openModalConditionsUtilisation">Conditions d'utilisation</a>

  <div class="conditions-utilisation">
    <input type="checkbox" name="conditionsUtilisation" value="1" id="cocherConditionsUtilisation">
    <label for="cocherConditionsUtilisation">J’ai lu et j’approuve les conditions d’utilisations</label>
  </div>

  <div class="formulaire-buttons">
    <button type="submit" name="btnInscription" value="valider" id="btnInscription">valider</button>
    <button type="reset">annuler</button>
  </div>
</form>

<!-- Shift + Alt + F pour formater le document  -->
