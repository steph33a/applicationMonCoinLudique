
  <div class="modal-content">
    <h2>Détail de l'utilisateur</h2>
    <?php 
    
    if ($action=="lectureInformationsUtilisateur") {  ?>

   <div id="lectureUtilisateur">
        <p><strong>Pseudo :</strong> <?php echo htmlspecialchars($utilisateurSelected['pseudo'] ?? 'Non renseigné') ?></p>
        <p><strong>Nom :</strong> <?php echo htmlspecialchars($utilisateurSelected['nom_utilisateur'] ?? 'Non renseigné') ?></p>
        <p><strong>Prénom :</strong> <?php echo htmlspecialchars($utilisateurSelected['prenom_utilisateur'] ?? 'Non renseigné') ?></p>
        <p><strong>Email :</strong> <?php echo htmlspecialchars($utilisateurSelected['email'] ?? 'Non renseigné') ?></p>
        <p><strong>Date d'inscription :</strong> <?php echo $utilisateurSelected['dateInscription'] ?? 'Non renseignée' ?></p>
        <p><strong>Rôle :</strong> <?php echo htmlspecialchars($utilisateurSelected['role'] ?? 'Non renseigné') ?></p>
        <p><strong>Statut :</strong> <?php echo htmlspecialchars($utilisateurSelected['statut_utilisateur'] ?? 'Non renseigné') ?></p>
        <p><strong>Date de naissance :</strong> <?php echo $utilisateurSelected['dateNaissance'] ?? 'Non renseignée' ?></p>

        <p><strong>Jeu préféré :</strong> <?php echo htmlspecialchars($utilisateurSelected['reponse1'] ?? 'Non renseigné') ?></p>
        <p><strong>Chanteur préféré :</strong> <?php echo htmlspecialchars($utilisateurSelected['reponse2'] ?? 'Non renseigné') ?></p>

    </div>

    <?php } else if ($action=="modificationInformationsUtilisateur") { ;
         ?>

    <form id="formEditionUtilisateur" method="post" action="../../controller/controller.php">
    <input type="hidden" name="page_contexte" value="gestion_utilisateurs">
    <input type="hidden" name="id_utilisateur" value="<?php echo $utilisateurSelected['id_utilisateur']; ?>">

    <label>Pseudo :
        <input type="text" name="pseudo" value="<?php echo htmlspecialchars($utilisateurSelected['pseudo'] ?? '') ?>">
    </label><br>

    <label>Email :
        <input type="email" name="email" value="<?php echo htmlspecialchars($utilisateurSelected['email'] ?? '') ?>">
    </label><br>
    <label>Nom :
        <input type="text" name="nom_utilisateur" value="<?php echo htmlspecialchars($utilisateurSelected['nom_utilisateur'] ?? '') ?>">
    </label><br>
<?php if ($utilisateurSelected['role'] === 'particulier') { ?>
    <label>Prénom :
        <input type="text" name="prenom_utilisateur" value="<?php echo htmlspecialchars($utilisateurSelected['prenom_utilisateur'] ?? '') ?>">
    </label><br>

    

    <label>Date de naissance :
        <input type="date" name="dateNaissance" value="<?php echo $utilisateurSelected['dateNaissance'] ?? '' ?>">
    </label><br>
    <?php
} ?>
    <label>Date d'inscription :
        <input type="text" value="<?php echo htmlspecialchars($utilisateurSelected['dateInscription'] ?? '') ?>" readonly>
    </label><br>

  <label>Rôle :
    <select name="role">
        <option value="particulier" <?php if (($utilisateurSelected['role'] ?? '') === 'particulier') echo 'selected'; ?>>Particulier</option>
        <option value="groupe" <?php if (($utilisateurSelected['role'] ?? '') === 'groupe') echo 'selected'; ?>>Groupe</option>
        <option value="moderateur" <?php if (($utilisateurSelected['role'] ?? '') === 'moderateur') echo 'selected'; ?>>Modérateur</option>
        <option value="administrateur" <?php if (($utilisateurSelected['role'] ?? '') === 'administrateur') echo 'selected'; ?>>Administrateur</option>
    </select>
</label><br>

    <label>Statut utilisateur :
        <select name="statut_utilisateur">
            <option value="actif" <?php if (($utilisateurSelected['statut_utilisateur'] ?? '') === 'actif') echo 'selected'; ?>>Actif</option>
            <option value="inactif" <?php if (($utilisateurSelected['statut_utilisateur'] ?? '') === 'inactif') echo 'selected'; ?>>Inactif</option>
            <option value="suspendu" <?php if (($utilisateurSelected['statut_utilisateur'] ?? '') === 'suspendu') echo 'selected'; ?>>Suspendu</option>
        </select>
    </label><br>

    <label>Mot de passe :
        <input type="password" name="motDePasse" placeholder="Modifier le mot de passe">
    </label><br>

    <label>Confirmation du mot de passe :
        <input type="password" name="confirmationMotDePasse" placeholder="Confirmer le nouveau mot de passe">
    </label><br>

    <h3>Informations à donner pour la récupération de compte</h3>

    <label for="reponse1">Quel est votre jeu préféré ?</label>
    <input type="text" name="jeuPrefereUser" id="reponse1" value="<?php echo htmlspecialchars($utilisateurSelected['reponse1'] ?? '') ?>"><br>

    <label for="reponse2">Quel est votre chanteur préféré ?</label>
    <input type="text" name="chanteurPrefereUser" id="reponse2" value="<?php echo htmlspecialchars($utilisateurSelected['reponse2'] ?? '') ?>"><br>

    <button type="submit" name="actionAdminModifierParametresCompteUtilisateur" value="modifierCompte">Enregistrer</button>
   
</form>


        <?php   } ?>

        
  </div>
