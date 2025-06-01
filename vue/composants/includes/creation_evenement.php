 <form style="width:700px; background-color: #F8F3EB; opacity: 0.7; border: #704405 solid 1px; display:flex; flex-direction:column; justify-content:space-between; align-items:center;margin:25px auto;" class="formulaire" id="formulaireCreationEvenement" enctype="multipart/form-data" action="../../controller/controller.php" method="POST">
    <div style="display:flex; flex-direction:column; justify-content:space-between;   width:700px">
        <div style="margin-top:25px; display:flex; flex-direction:row; justify-content:space-between; gap:20px;  width:700px" id="suppDetailsEvenement" class="" style=" margin-top: 20px;">
            <div style ="display:flex; flex-direction:column; justify-content:space-between; gap:20px;align-items:center; width:305px;" id="choixProfil">
                <label for="imageEventInput" class="photo-label">
                    <div class="imageEvenement-container">
                        <img src="../images/avatar.png" alt="Photo" class="imageEvent-preview" />
                        <div class="photo-add-icon">+</div>
                        <input type="file" name="imageEvent" accept="image/*" class="photo-input imageEvent" id="imageEventInput" required/>
                    
                    </div>
                    <p class="imageEventCommentaire"></p>

                </label>

                <div class="field-group">
                    <label for="nbParticipantsCreateEvent">Nombre de places *</label>
                    <input type="number" min="0" max="50"
                    class="nbParticipants formElement" value="<?php if ($mode=='modificationEvenement') {echo $evenement['nbParticipants'];} ?>" type="text" name="nbParticipants" required
                    id="nbParticipantsCreateEvent" placeholder="Nb"
                    />
                    <p class="nbParticipantsCommentaire"></p>
                </div>

                <div class="field-group">
                    <label for="ageRequisCreateEvent">Âge requis</label>
                    <input type="number" min="0" max="100"
                    class="ageRequis formElement"
                    value="<?php if ($mode=='modificationEvenement') {echo $evenement['ageRequis'];} ?>"
                    type="text"
                    name="ageRequis"
                    id="ageRequisCreateEvent"
                    placeholder="nb" 
                    />
                      <p class="ageRequisCommentaire"></p>
                </div>
            </div>
        <div class="details-evenement" id="formulaireContent">
            <div class="form-group">
                <label for="recurrenceCreateEvent">Récurrence </label>
                <input class="recurrenceEvent formElement" type="text" name="recurrence" id="recurrenceCreateEvent" placeholder="x fois/mois"
                    value="<?php if ($mode=='modificationEvenement') echo $evenement['recurrence']; ?>">
                 <p class="recurrenceEventCommentaire"></p>
            </div>

            <div class="form-group">
                <label for="typeSoireeCreateEvent">Type de soirée *</label>
                <select class="typeSoiree formElement" id="typeSoireeCreateEvent" name="typeSoiree[]" required>
                    <option value="createur">Soirée créateur</option>
                    <option value="classique">Soirée jeu classique</option>
                    <option value="thematique">Soirée Thématique</option>
                </select>
            </div>

            <div class="form-group">
                <label for="dateEventCreateEvent">Date *</label>
                <input type="date" name="dateEvent"class="dateEvent formElement" id="dateEventCreateEvent" placeholder="jj/mm/aaaa" autofocus required
                    value="<?php if ($mode=='modificationEvenement') echo $evenement['dateEvenement']; ?>">
                <p class="dateCommentaire"></p>
            </div>

            <div class="form-group">
                <label for="heureEventCreateEvent">Heure *</label>
                <input class="heureEvent formElement" name="heureEvent" type="time" id="heureEventCreateEvent"
                    value="<?php if ($mode=='modificationEvenement') echo $evenement['heureEvenement']; ?>" placeholder="hh:mm" required>
                 <p class="heureEventCommentaire"></p>
            </div>

            <div class="form-group">
                <label for="titreEventCreateEvent">Titre<span><?php if ($role=="groupe") {echo " * ";}?></span></label>
                <input class="titreEvent formElement" name="titreEvent" type="text" id="titreEventCreateEvent"
                    value="<?php if ($mode=='modificationEvenement') echo $evenement['titreEvenement']; ?>" placeholder="titre de la soirée">
                 <p class="titreEventCommentaire"></p>
            </div>

            <div class="form-group">
                <label for="jeuxThemesEventCreateEvent">Jeux et thèmes</label>
                <input class="jeuxThemesEvent formElement" name="jeuxThemesEvent" type="textarea" id="jeuxThemesEventCreateEvent" placeholder="nom jeu1,nom jeu2,nom jeu3..."  
                    value="<?php if ($mode=='modificationEvenement') echo $evenement['jeuxThemesEvent']; ?>">
                <p class="jeuxThemesEventCommentaire"></p>
            </div>
        </div>
    
    </div>
    <div class="<?php if ($role=="groupe") {echo "divCreateEventForGroupe";}?>" style="width:500px;margin:25px auto ; "id="informationsProfilOrganisateur">
        <h2>Informations du profil Organisateur</h2>
        <hr>
        
        <div style="display:flex; flex-direction:row; justify-content:flex-end; gap:20px;">
            <div style="display:flex; flex-direction:row; justify-content:space-between; ">
            <label style=" width:50px;" for="rueCreateEvent">Rue<span><?php if ($role=="groupe") {echo " * ";}?></span></label>
            <input style=" width:200px;" type="text" id="rueCreateEvent" name="rueEvent" class="rueEvent formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["rueEvenement"];}?>">
             <p class="rueEventCommentaire"></p>
        </div>
            <div style="display:flex; flex-direction:row; justify-content:flex-end;gap:20px;">
                <label style=" width:50px;"for="numCreateEvent">N°<span><?php if ($role=="groupe") {echo " * ";}?></span></label>
                <input style=" width:100px;"type="text" id="numCreateEvent" name="numRueEvent"class="numRueEvent formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["numAdresse"];}?>">
                <p class="numRueEventCommentaire"></p>
            </div>
        </div>

        <div style="display:flex; flex-direction:row; justify-content:flex-end; gap:20px; margin-top:15px;">
            <div style="display:flex; flex-direction:row; justify-content:space-between;">
                <label style=" width:50px;"for="villeCreateEvent">Ville<span><?php if ($role=="groupe") {echo " * ";}?></span></label>
                <input style=" width:200px;" type="text" id="villeCreateEvent" name="villeEvent" class="villeEvent formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["ville"];}?>">
                <p class="villeEventCommentaire"></p>
            </div>
            <div style="display:flex; flex-direction:row; justify-content:flex-end;gap:20px;">
                <label style="width:50px;" for="codePostalCreateEvent">Code postal<span><?php if ($role=="groupe") {echo " * ";}?></span></label>
                <input style="width:100px;"type="" id="codePostalCreateEvent" name="codePostalEvent" class="codePostalEvent formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["codePostal"];}?>">
                <p class="codePostalEventCommentaire"></p>
            </div>
        </div>

        <div style="display:flex; flex-direction:row; justify-content:flex-end; margin-top:15px;">
            <label for="mailCreateEvent">Mail *</label>
            <input type="email" id="mailCreateEvent" class="emailEvent formElement" name="emailEvent" placeholder="mail de l'organisateur" value="<?php if ($mode=="modificationEvenement") {echo $evenement["mail"];} ?> required">
              <p class="mailEventCommentaire"></p>
        </div>

        <div style="display:flex; flex-direction:row; justify-content:flex-end;margin-top:15px;">
            <label for="numberPhoneCreateEvent">Tel<span><?php if ($role=="groupe") {echo " * ";}?></span></label>
            <input type="" id="numberPhoneCreateEvent" class="numberPhoneEvent formElement" name="numberPhoneEvent" placeholder="numéro de GSM ou téléphone" value="<?php if ($mode=="modificationEvenement") {echo $evenement["numberPhone"];}?>">
            <p class="numberPhoneEventCommentaire"></p>
        </div>

       

        <div style="display:flex; flex-direction:row; justify-content:flex-end; margin-top:15px;">
            <label>URLs</label>
            <div style="width:240px; display:flex; flex-direction:column;justify-content:space-between;gap:10px;">
                 <input type="text" id="url1CreateEvent" class="url1 formElement" name="url1" placeholder="url1 de l'organisateur" value="<?php if ($mode=="modificationEvenement") {echo $evenement["url1"];}?>">
                 <p class="url1Commentaire"></p>
                 <input type="text" id="url2CreateEvent" class="url2 formElement" name="url2" placeholder="url2 de l'organisateur" value="<?php if ($mode=="modificationEvenement") {echo $evenement["url2"];}?>">
                 <p class="url2Commentaire"></p>
            </div>
           
        </div>
         <div style="display:flex; flex-direction:row; justify-content:flex-end; margin-top:15px;">
            <label for="discussionGroupName">Groupe de discussion</label>
            <input type="text" id="discussionGroupName" name="discussionGroupName" class="discussionGroupEvent formElement" placeholder="nom du groupe de discussion" value="<?php if ($mode == 'modificationEvenement') { echo $evenement['groupe_discussion']; } ?>">
            <p class="discussionGroupEventCommentaire"></p>
        </div>
    </div>  
    <?php
    if ($mode=="modificationEvenement") {?>
        <button style="margin:25px auto 0 auto; display:block;" class="btn" type="submit" id="btnModificationEvenement" name="btnModificationEvenement">modifier l'événement</button>
   <?php } else {?>
         <button style="margin:25px auto 0 auto; display:block;" class="btn" type="submit" id="btnCreationEvenement" name="btnCreationEvenement">valider l'événement</button>
   <?php }
    ?>
   
    
</form>

        
        <!-- url1,url2,emailEvent,numberPhoneEvent,codePostalEvent,villeEvent,numRueEvent,rueEvent,jeuxThemesEvent,titreEvent,typeSoiree,reccurenceEvent,nbParticipants,ageRequis,imageEvent -->