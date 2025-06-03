    <!-- enctype pour encoder les données du fichier joint en binaire -->
        
        <form style="background-color: #FFFFFF; display:flex; flex-direction:column; justify-content:space-between; align-items:center;" class="formulaire" id="formulaireInscription" action="../../controller/controller.php" enctype="multipart/form-data" method="POST">
            <h2 style=" font-size: 36px; font-weight: 700; margin-left: auto; margin-right: auto; margin-top: 28px; font-family: 'Nunito Sans', sans-serif;">Inscription</h2>
      <!-- Section Particulier -->
            <div style="margin-top:25px; display:flex; flex-direction:column; justify-content:space-between;   width:305px" id="choix" class="" style=" margin-top: 20px;">
                <?php if ($role === 'admin') { ?>

                <div style="display:flex; flex-direction:column; justify-content:space-between;align-items:center; width:305px;" id="choixProfil">
                    <input style="font-size:20px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" type="radio" name="role" value="particulier" id="profilParticulier" checked><label style=""for="profilParticulier">particulier</label>
                    <input style="font-size:20px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" type="radio" name="role" value="groupe" id="profilGroupe"><label for="profilGroupe">groupe</label>
                    <input style="font-size:20px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" type="radio" name="role" value="moderateur" id="profilModerateur"><label style=""for="profilModerateur">modérateur</label>
                    <input style="font-size:20px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" type="radio" name="role" value="administrateur" id="profilAdministrateur"><label for="profilAdministrateur">administrateur</label>
                 </div>
                <?php } else {?>
                <div style="display:flex; flex-direction:row; justify-content:space-between;align-items:center; width:305px;" id="choixProfil">
                    <input style="font-size:20px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" type="radio" name="role" value="particulier" id="profilParticulier" checked><label style=""for="profilParticulier">particulier</label>
                    <input style="font-size:20px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" type="radio" name="role" value="groupe" id="profilGroupe"><label for="profilGroupe">groupe</label>
                </div>
                <?php } ?>
                <label style="margin-top: 25px; cursor:pointer; display:inline-block;" for="photoInput" class="photo-label">
                    <div class="photo-container">
                        <img style="" src="../images/avatar.png" alt="Photo" class="photo-preview" />
                        <div class="photo-add-icon">+</div>
                        <input type="file" name="imageProfil" id="photoInput" accept="image/*" class="photo-input" />
                    </div>
                </label>
                <div style="margin-top:25px; display:flex; flex-direction:column; justify-content:space-between;   width:305px" id="formulaireContent" class="formulaire-section" style=" margin-top: 20px;">
                
                    <label style="text-align: left;margin-top: 25px;" for="pseudoInscription">Pseudo :</label>
                    <input class="pseudo pseudoformElement" type="text" name="pseudo" id="pseudoInscription">
                    <!-- <br> -->
                    <p class="pseudoCommentaire displayNone" id="pseudoCommentaireInscription"></p>
        
            
                    <label style="text-align: left;margin-top: 25px;" for="emailInscription">Email :</label>
                    <input class="email formElement" type="email" name="email" id="emailInscription">
                    <!-- <br> -->
                    <p class=" emailCommentaire commentaire displayNone" id="emailCommentaireInscription"></p>

                    <label style="text-align: left;margin-top: 25px;" for="motDePasseInscription">Mot de passe :</label>
                    <input class="motDePasse formElement" type="password" name="motDePasse" id="motDePasseInscription" >
                    <p class=" motDePasseCommentaire commentaire displayNone" id="motDePasseCommentaireInscription"></p>

                    <div style="display:flex; flex-direction:row; justify-content:flex-start;gap:10px;">
                        <input  style="width:25px; height:25px;background-color:#D9D9D9;" type="checkbox" id="voirMDPInscription" class="formElement" >
                        <label for="voirMDPInscription">Voir le mot de passe</label>
                    </div>
                

                    <label style="text-align: left;margin-top: 25px;" for="confirmationMotDePasseInscription">Confirmation du mot de passe :</label>
                    <input class="confirmationMotDePasse formElement" type="password" name="confirmationMotDePasse" id="confirmationMotDePasseInscription">
                    <p class=" confirmationMotDePasseCommentaire commentaire displayNone" id="confirmationMotDePasseCommentaireInscription"></p>
                    <div style="display:flex; flex-direction:row; justify-content:flex-start;gap:10px;">
                        <input style="width:25px; height:25px;background-color:#D9D9D9;"type="checkbox" id="voirConfMPDInscription" class="formElement">
                        <label for="voirConfMDPInscription">Voir le mot de passe</label>
                    </div>
                

                    <label style="text-align: left;margin-top: 25px;" for="nomUtilisateurInscription">Nom :</label>
                    <input  class="nomUtilisateur formElement" type="text" id="nomUtilisateurInscription" name="nomUtilisateur" min="2" placeholder="nom" required autofocus>
                    <!-- <br> -->
                    <p class="nomUtilisateurCommentaire commentaire displayNone" ></p>

                    <div style="margin-top:25px; display:flex; flex-direction:column; justify-content:space-between;   width:305px"id="formParticulier" class="formulaire-section" style=" margin-top: 20px;">
                        <label style="text-align: left;margin-top: 25px;" for="prenomUtilisateurInscription">Prénom :</label>
                        <input  class="prenomUtilisateur formElement" type="text" name="prenomUtilisateur" id="prenomUtilisateurInscription">
                        <p class="prenomUtilisateurCommentaire commentaire displayNone" id="prenomUtilisateurCommentaireInscription"></p>

                        <label style="text-align: left;margin-top: 25px;" for="dateNaissance">Date de naissance :</label>
                        <input class="dateNaissance formElement" type="date" name="dateNaissance" id="dateNaissance">
                        <p class="dateNaissanceCommentaire commentaire displayNone" id="dateNaissanceCommentaire"></p>

                    </div>
            

                    <div style="margin-top:25px; display:flex; flex-direction:column; justify-content:space-between;   width:305px" id="formGroupe" class="formulaire-section" style=" margin-top: 20px;">

                    </div>
                </div>
                <div>
                    
                </div>
                <a href="#" id="openModalConditionsUtilisation">Conditions d'utilisation</a>
                <div style="display:flex; flex-direction:row; justify-content:space-between;align-items:center;">
                    <input style="font-size:20px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" type="checkbox" name="conditionsUtilisation" value="1" id="cocherConditionsUtilisation">
                    <label for="conditionsUtilisation">J’ai lu et j’appouvre les conditions d’utilisations </label>
                </div>
                
                
                <div style="display:flex; flex-direction:row; justify-content:space-between;width:305px; margin-bottom:25px;">
                    <button style="width:114px; height:40px;background-color: #6EBA46; color: #FFFFFF; font-size:18px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;"type="submit" name="btnInscription" value="valider" id="btnInscription">valider</button>
                    <!-- réinitialise tous les champs du formulaire à leurs valeurs initiales (celles présentes au chargement de la page ou par défaut dans l'attribut value). -->


                    <button style="width:114px; height:40px; background-color: #6EBA46; color: #FFFFFF; font-size:18px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" type="reset">annuler</button>
                    
                </div>
                
            </div>
        </form>
<!-- Shift + Alt + F pour formater le document  -->
