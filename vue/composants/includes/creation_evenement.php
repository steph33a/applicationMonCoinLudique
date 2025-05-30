 <form style="width=700px; background-color: #F8F3EB; opacity: 0.7; border: #704405 solid 1px; display:flex; flex-direction:column; justify-content:space-between; align-items:center;" class="formulaire" id="formulaireCreationEvenement" action="../controller/controller.php" method="POST">
           
            <div style="margin-top:25px; display:flex; flex-direction:row; justify-content:space-between;   width:305px" id="choix" class="" style=" margin-top: 20px;">
               
                <div style="display:flex; flex-direction:row; justify-content:space-between;align-items:center; width:305px;" id="choixProfil">
                     <label style="margin-top: 25px; cursor:pointer; display:inline-block;" for="photoInput" class="photo-label">
                        <div class="photo-container">
                            <img style="" src="../images/avatar.png" alt="Photo" class="photo-preview" />
                            <div class="photo-add-icon">+</div>
                            <input type="file" name="imageEvenement"  accept="image/*" class="photo-input imageEvent" />
                        </div>
                    </label>
                    <label style="text-align: left;margin-top: 25px;"  for="nbParticipantCreateEvent">nombre de places</label>
                    <input class="nbParticipants formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["nbParticipants"];}?>" type="text" name="nbParticipants" id="nbParticipantsCreateEvent">
                    <label style="text-align: left;margin-top: 25px;" for="ageRequisCreateEvent">age requis</label>
                    <input class="ageRequis formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["ageRequis"];}?>" type="text" name="ageRequis" id="ageRequisCreateEvent">
                </div>
                <div>
                    <div>
                        <label for="recurrenceCreateEvent">Récurrence</label>
                        <input class="recurrence formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["recurrence"];}?>" type="text" name="recurrence" id="recurrenceCreateEvent">
                    </div>
                   
                    <div>
                        <label for="typeSoireeCreateEvent">type de soirée</label>
                        <select class="typeSoiree formElement" id="typeSoireeCreateEvent" name="typesoiree[]" multiple>
                            <option value="createur">Soirée créateur</option>
                            <option value="classique">Soirée jeu classique</option>
                            <option value="thematique">Soirée Thématique</option>
                        </select>

                        
                    </div>
                    <div>
                        <label for="date dateEventCreateEvent">date</label>
                        <input class="dateEvent formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["dateEvenement"];}?>" type="date" id="dateEventCreateEvent">
                    </div>
                      <div>
                        <label for="heureEvent">heure</label>
                        <input class="heureEvent formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["heureEvenement"];}?>" type="heure" id="heureEventCreateEvent">
                    </div>
                    <div>
                        <label for="titreEvent">titre</label>
                        <input class="champLibre titreEvent titre formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["titreEvenement"];}?>" type="text" id="titreEventCreateEvent">
                    </div>
                    <div>
                        <label for="jeuxThemesEvent">Jeux et themes</label>
                        <input class="champLibre jeuxThemesEvent formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["jeuxThemesEvent"];}?>" type="text" id="jeuxThemesEventCreateEvent">
                    </div>

                  

                </div>
            </div>
            <!-- faire une ligne ici  -->
            <div>
                <h2 style="">Informations du profil Organisateur</h2>
                <hr>
                <div style="display:flex; flex-direction:row; justify-content:space-between;">
                    <div>
                        <label for="rueCreateEvent">rue</label>
                        <input class="rue formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["rueEvenement"];}?>"type="text" id="rueCreateEvent">
                    </div>
                    <div>
                        <label for="numCreateEvent">rue</label>
                        <input class="numAddresse formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["numAdresse"];}?>" type="text" id="numCreateEvent">
                    </div>
                    
                </div>
                
                <div style="display:flex; flex-direction:Column; justify-content:space-between;">
                    <div style="display:flex; flex-direction:row; justify-content:space-between;">
                        <label for="villeCreateEvent">ville</label>
                        <input class="ville formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["ville"];}?>" type="text" id="villeCreateEvent">
                    </div>
                    <div style="display:flex; flex-direction:row; justify-content:space-between;">
                         <label for="codePostalCreateEvent">code postal</label>
                         <input class="codePostal formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["codePostal"];}?>" type="text" id="codePostalCreateEvent">
                    </div>
                </div>
                <div style="display:flex; flex-direction:row; justify-content:space-between;">
                    <label for="numberPhoneCreateEvent">Tel</label>
                     <input type="text" id="numberPhoneCreateEvent" value="<?php if ($mode=="modificationEvenement") {echo $evenement["numberPhone"];}?>" class="numberPhone formElement" placeholder="numéro de GSM ou téléphone">
                </div>
                <div style="display:flex; flex-direction:row; justify-content:space-between;">
                    <label for="mailCreateEvent">Mail</label>
                     <input type="mail" id="mailCreateEvent" value="<?php if ($mode=="modificationEvenement") {echo $evenement["mail"];}?>" class="mail formElement" placeholder="mail de l'organisateur">
                </div>
                <div>
                    <label for="urlsEventCreateEvent">urls</label>
                    <div id="urlsEventCreateEvent">
                        <input value="<?php if ($mode=="modificationEvenement") {echo $evenement["url1"];}?>" type="text" id="url1CreateEvent" class="url1 formElement" placeholder="url1 de l'organisateur">
                        <input value="<?php if ($mode=="modificationEvenement") {echo $evenement["url2"];}?>" type="text" id="url2CreateEvent" class="url2 formElement" placeholder="url2 de l'organisateur">
                    </div>
                    
                </div>
            </div>
       
                <button style="width:114px; height:40px;background-color: #6EBA46; color: #FFFFFF; font-size:18px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;"type="submit" id="btnSendEvenement">valider l'événement</button>
  
            </div>
        </form>

      
    