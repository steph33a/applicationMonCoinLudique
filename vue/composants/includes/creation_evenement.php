 <form style="width:700px; background-color: #F8F3EB; opacity: 0.7; border: #704405 solid 1px; display:flex; flex-direction:column; justify-content:space-between; align-items:center;margin:25px auto;" class="formulaire" id="formulaireCreationEvenement" action="../controller/controller.php" method="POST">
    <div style="display:flex; flex-direction:column; justify-content:space-between;   width:700px">
        <div style="margin-top:25px; display:flex; flex-direction:row; justify-content:space-between; gap:20px;  width:700px" id="suppDetailsEvenement" class="" style=" margin-top: 20px;">
            <div style ="display:flex; flex-direction:column; justify-content:space-between; gap:20px;align-items:center; width:305px;" id="choixProfil">
                <label for="photoInput" class="photo-label">
                    <div class="imageEvenement-container">
                    <img src="../images/avatar.png" alt="Photo" class="imageEvent-preview" />
                    <div class="photo-add-icon">+</div>
                    <input type="file" name="imageEvenement" accept="image/*" class="photo-input imageEvent" id="photoInput" />
                    </div>
                </label>

                <div class="field-group">
                    <label for="nbParticipantsCreateEvent">Nombre de places</label>
                    <input
                    class="nbParticipants formElement" value="<?php if ($mode=='modificationEvenement') {echo $evenement['nbParticipants'];} ?>" type="text" name="nbParticipants"
                    id="nbParticipantsCreateEvent" placeholder="Nb"
                    />
                </div>

                <div class="field-group">
                    <label for="ageRequisCreateEvent">Âge requis</label>
                    <input
                    class="ageRequis formElement"
                    value="<?php if ($mode=='modificationEvenement') {echo $evenement['ageRequis'];} ?>"
                    type="text"
                    name="ageRequis"
                    id="ageRequisCreateEvent"
                    placeholder="nb"
                    />
                </div>
            </div>
        <div class="details-evenement" id="formulaireContent">
            <div class="form-group">
                <label for="recurrenceCreateEvent">Récurrence</label>
                <input class="recurrence formElement" type="text" name="recurrence" id="recurrenceCreateEvent" placeholder="x fois/mois"
                    value="<?php if ($mode=='modificationEvenement') echo $evenement['recurrence']; ?>">
            </div>

            <div class="form-group">
                <label for="typeSoireeCreateEvent">Type de soirée</label>
                <select class="typeSoiree formElement" id="typeSoireeCreateEvent" name="typesoiree[]" multiple>
                    <option value="createur">Soirée créateur</option>
                    <option value="classique">Soirée jeu classique</option>
                    <option value="thematique">Soirée Thématique</option>
                </select>
            </div>

            <div class="form-group">
                <label for="dateEventCreateEvent">Date</label>
                <input class="dateEvent formElement" type="date" id="dateEventCreateEvent" placeholder="jj/mm/aaaa" autofocus
                    value="<?php if ($mode=='modificationEvenement') echo $evenement['dateEvenement']; ?>">
            </div>

            <div class="form-group">
                <label for="heureEventCreateEvent">Heure</label>
                <input class="heureEvent formElement" type="time" id="heureEventCreateEvent"
                    value="<?php if ($mode=='modificationEvenement') echo $evenement['heureEvenement']; ?>" placeholder="hh:mm">
            </div>

            <div class="form-group">
                <label for="titreEventCreateEvent">Titre</label>
                <input class="titreEvent formElement" type="text" id="titreEventCreateEvent"
                    value="<?php if ($mode=='modificationEvenement') echo $evenement['titreEvenement']; ?>" placeholder="titre de la soirée">
            </div>

            <div class="form-group">
                <label for="jeuxThemesEventCreateEvent">Jeux et thèmes</label>
                <input class="jeuxThemesEvent formElement" type="text" id="jeuxThemesEventCreateEvent" placeholder="nom jeu1,nom jeu2,nom jeu3..."  
                    value="<?php if ($mode=='modificationEvenement') echo $evenement['jeuxThemesEvent']; ?>">
            </div>
        </div>
    
    </div>
    <div style="width:500px;margin:25px auto ; "id="informationsProfilOrganisateur">
        <h2>Informations du profil Organisateur</h2>
        <hr>
        
        <div style="display:flex; flex-direction:row; justify-content:flex-end; gap:20px;">
            <div style="display:flex; flex-direction:row; justify-content:space-between; ">
            <label style=" width:50px;" for="rueCreateEvent">Rue</label>
            <input style=" width:200px;" type="text" id="rueCreateEvent" class="formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["rueEvenement"];}?>">
            </div>
            <div style="display:flex; flex-direction:row; justify-content:flex-end;gap:20px;">
            <label style=" width:50px;"for="numCreateEvent">N°</label>
            <input style=" width:100px;"type="text" id="numCreateEvent" class="formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["numAdresse"];}?>">
            </div>
        </div>

        <div style="display:flex; flex-direction:row; justify-content:flex-end; gap:20px; margin-top:15px;">
            <div style="display:flex; flex-direction:row; justify-content:space-between;">
            <label style=" width:50px;"for="villeCreateEvent">Ville</label>
            <input style=" width:200px;" type="text" id="villeCreateEvent" class="formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["ville"];}?>">
            </div>
            <div style="display:flex; flex-direction:row; justify-content:flex-end;gap:20px;">
            <label style="width:50px;" for="codePostalCreateEvent">Code postal</label>
            <input style="width:100px;"type="text" id="codePostalCreateEvent" class="formElement" value="<?php if ($mode=="modificationEvenement") {echo $evenement["codePostal"];}?>">
            </div>
        </div>

        <div style="display:flex; flex-direction:row; justify-content:flex-end;margin-top:15px;">
            <label for="numberPhoneCreateEvent">Tel</label>
            <input type="text" id="numberPhoneCreateEvent" class="formElement" placeholder="numéro de GSM ou téléphone" value="<?php if ($mode=="modificationEvenement") {echo $evenement["numberPhone"];}?>">
        </div>

        <div style="display:flex; flex-direction:row; justify-content:flex-end; margin-top:15px;">
            <label for="mailCreateEvent">Mail</label>
            <input type="email" id="mailCreateEvent" class="formElement" placeholder="mail de l'organisateur" value="<?php if ($mode=="modificationEvenement") {echo $evenement["mail"];}?>">
        </div>

        <div style="display:flex; flex-direction:row; justify-content:flex-end; margin-top:15px;">
            <label>URLs</label>
            <div style="display:flex; flex-direction:column;justify-content:space-between; gap:20px;">
                 <input type="text" id="url1CreateEvent" class="formElement" placeholder="url1 de l'organisateur" value="<?php if ($mode=="modificationEvenement") {echo $evenement["url1"];}?>">
                 <input type="text" id="url2CreateEvent" class="formElement" placeholder="url2 de l'organisateur" value="<?php if ($mode=="modificationEvenement") {echo $evenement["url2"];}?>">

            </div>
           
        </div>
    </div>  
    <button class="btn" style="width:114px; height:40px;background-color: #6EBA46; color: #FFFFFF; font-size:18px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;"type="submit" id="btnSendEvenement">valider l'événement</button>
    
</form>

        
        