

   

    
        <form style="background-color: #FFFFFF; display:flex; flex-direction:column; justify-content:space-between; align-items:center;" class="formulaire" id="formulaireInscription" action="register.php" method="POST">
            <h2 style=" font-size: 36px; font-weight: 700; margin-left: auto; margin-right: auto; margin-top: 28px; font-family: 'Nunito Sans', sans-serif;">Inscription</h2>

            <div style="display:flex; flex-direction:row; justify-content:space-between;align-items:center; width:305px;" id="choixProfil">
                <input style="font-size:20px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" type="radio" name="profil" value="particulier" id="profilParticulier" checked><label style=""for="profilParticulier">particulier</label>
                <input style="font-size:20px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" type="radio" name="profil" value="groupe" id="profilGroupe"><label for="profilGroupe">groupe</label>
            </div>
            <label style="margin-top: 25px; cursor:pointer; display:inline-block;" for="photoInput" class="photo-label">
                <div class="photo-container">
                    <img style="" src="../images/avatar.png" alt="Photo" class="photo-preview" />
                    <div class="photo-add-icon">+</div>
                    <input type="file" id="photoInput" accept="image/*" class="photo-input" />
                </div>
            </label>

              <!-- Section Particulier -->
            <div style="margin-top:25px; display:flex; flex-direction:column; justify-content:space-between;   width:305px"id="formParticulier" class="formulaire-section" style=" margin-top: 20px;">
                <?php if ($role === 'admin') { ?>
                    <label for="jeux">Choisissez un role</label>
                    <select name="role[]" id="jeux" multiple>
                    <option value="particulier">particulier</option>
                    <option value="groupe">groupe</option>
                    <option value="modérateur">modérateur</option>
                    <option value="administrateur">administrateur</option>
                    </select>
                <?php } ?>

                <label style="text-align: left;margin-top: 25px;" for="pseudo">Pseudo :</label>
                <input class="formElement" type="text" name="pseudo" id="pseudo">
                <!-- <br> -->
                <p class="commentaire displayNone" id="pseudoCommentaire"></p>
    
        
                <label style="text-align: left;margin-top: 25px;" for="emailPart">Email :</label>
                <input class="formElement" type="email" name="email" id="mail">
                <!-- <br> -->
                <p class="commentaire displayNone" id="mailCommentaire"></p>

                <label style="text-align: left;margin-top: 25px;" for="passwordPart">Mot de passe :</label>
                <input class="formElement" type="password" name="passwordPart" id="passwordPart">
                <div style="display:flex; flex-direction:row; justify-content:flex-start;gap:10px;">
                    <input style="width:25px; height:25px;background-color:#D9D9D9;" type="checkbox" id="togglePasswordCheckbox" class="formElement" onclick="togglePassword('passwordPart')">
                    <label for="togglePasswordCheckbox">Voir le mot de passe</label>
                </div>
             

                <label style="text-align: left;margin-top: 25px;" for="confirmPasswordPart">Confirmation du mot de passe :</label>
                <input class="formElement" type="password" name="confirmPasswordPart" id="confirmPasswordPart">
                <div style="display:flex; flex-direction:row; justify-content:flex-start;gap:10px;">
                    <input style="width:25px; height:25px;background-color:#D9D9D9;"type="checkbox" id="toggleConfirmPasswordCheckbox" class="formElement" onclick="togglePassword('passwordPart')">
                    <label for="toggleConfirmPasswordCheckbox">Voir le mot de passe</label>
                </div>
             

                <label style="text-align: left;margin-top: 25px;" for="username">Nom :</label>
                <input  class="formElement" type="text" id="username" name="username" min="2" placeholder="nom" required autofocus>
                <!-- <br> -->
                <p class="commentaire displayNone" id="usernameCommentaire"></p>

        
                <label style="text-align: left;margin-top: 25px;" for="prenom">Prénom :</label>
                <input  class="formElement" type="text" name="prenom" id="prenom">
                 <p class="commentaire displayNone" id="prenomCommentaire"></p>

                <label style="text-align: left;margin-top: 25px;" for="dateNaissance">Date de naissance :</label>
                <input class="formElement" type="date" name="dateNaissance" id="dateNaissance">
            </div>

            <div style="margin-top:25px; display:flex; flex-direction:column; justify-content:space-between;   width:305px" id="formGroupe" class="formulaire-section" style=" margin-top: 20px;">

                <label style="text-align: left;margin-top: 25px;"  for="pseudoGrp">Pseudo :</label>
                <input class="formElement" type="text" name="pseudoGrp" id="pseudoGrp">
                <p class="commentaire displayNone" id="pseudoGrpCommentaire"></p>

                <label style="text-align: left;margin-top: 25px;" for="emailPart"for="mailGrp">Email :</label>
                <input class="formElement" type="email" name="emailGrp" id="mailGrp">
                <p class="commentaire displayNone" id="mailGrpCommentaire"></p>

                <label style="text-align: left;margin-top: 25px;" for="passwordGrp">Mot de passe :</label>
                <input class="formElement" type="password" name="passwordGrp" id="passwordGrp">
                <div style="display:flex; flex-direction:row; justify-content:space-between;gap:10px;">
                    <input  style="width:25px; height:25px;background-color:#D9D9D9;" type="checkbox" id="togglemPasswordCheckbox" class="formElement" onclick="togglePassword('passwordPart')">
                    <label for="togglePasswordCheckbox">Voir le mot de passe</label>
                </div>
                
               

                <label for="confirmPasswordGrp">Confirmation du mot de passe :</label>
                <input class="formElement" type="password" name="confirmPasswordGrp" id="confirmPasswordGrp">
                <div style="display:flex; flex-direction:row; justify-content:space-between;gap:10px;">
                    <input  style="width:25px; height:25px;background-color:#D9D9D9;" type="checkbox" id="toggleConfirmPasswordCheckbox" class="formElement" onclick="togglePassword('passwordPart')">
                    <label for="toggleConfirmPasswordCheckbox">Voir le mot de passe</label>
                </div>


                <label style="text-align: left;margin-top: 25px;" for="usernameGroupe">Nom du groupe:</label>
                <input  class="formElement" type="text" id="usernameGroupe" name="usernameGroupe" min="2" placeholder="nom" required autofocus>
                <!-- <br> -->
                <p class="commentaire displayNone" id="usernameCommentaire"></p>


            </div>
            <div>
                
            </div>
            <a href="#" id="openModalConditionsUtilisation">Conditions d'utilisation</a>
             <div style="display:flex; flex-direction:row; justify-content:space-between;align-items:center;"><input style="font-size:20px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" type="radio" name="profil" value="professionnel" id="profilProfessionnel"><label for="profilProfessionnel">J’ai lu et j’appouvre les conditions d’utilisations </label></div>
            
            
             <div style="display:flex; flex-direction:row; justify-content:space-between;width:305px; margin-bottom:75px;">
                <button style="width:114px; height:40px;background-color: #6EBA46; color: #FFFFFF; font-size:18px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;"type="submit">valider</button>
                <!-- réinitialise tous les champs du formulaire à leurs valeurs initiales (celles présentes au chargement de la page ou par défaut dans l'attribut value). -->


                <button style="width:114px; height:40px; background-color: #6EBA46; color: #FFFFFF; font-size:18px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" type="reset">annuler</button>
                
            </div>
        </form>

 
