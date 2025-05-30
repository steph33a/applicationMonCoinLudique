<div style="width:700px; background-color: #F8F3EB; opacity: 0.7; border: #704405 solid 1px; display:flex; flex-direction:column; justify-content:space-between; align-items:center;" class="affichage" id="affichageEvenement">

    <div style="margin-top:25px; display:flex; flex-direction:row; justify-content:space-between; width:305px;" id="choix">
       
        <div style="display:flex; flex-direction:row; justify-content:space-between; align-items:center; width:305px;" id="choixProfil">
            <div style="margin-top:25px; cursor:default; display:inline-block;" class="photo-container">
                <img src="../images/avatar.png" alt="Photo de l'événement" class="photo-preview" style="max-width:100px; max-height:100px;" />
            </div>

            <div style="margin-top: 25px; text-align:left;">
                <strong>Nombre de places :</strong>
                <p id="affNbParticipants" style="margin:0;">[Nombre de places]</p>
            </div>

            <div style="margin-top: 25px; text-align:left;">
                <strong>Âge requis :</strong>
                <p id="affAgeRequis" style="margin:0;">[Âge requis]</p>
            </div>
        </div>

        <div>
            <div>
                <strong>Récurrence :</strong>
                <p id="affRecurrence">[Récurrence]</p>
            </div>
           
            <div>
                <strong>Type de soirée :</strong>
                <ul id="affTypesSoiree" style="margin:0; padding-left: 20px;">
                    <li>Soirée créateur</li>
                    <li>Soirée jeu classique</li>
                    <li>Soirée Thématique</li>
                    <!-- Remplacer ou filtrer selon les types sélectionnés -->
                </ul>
            </div>

            <div>
                <strong>Date :</strong>
                <p id="affDateEvent">[Date]</p>
            </div>

            <div>
                <strong>Heure :</strong>
                <p id="affHeureEvent">[Heure]</p>
            </div>

            <div>
                <strong>Titre :</strong>
                <p id="affTitreEvent">[Titre]</p>
            </div>

            <div>
                <strong>Jeux et thèmes :</strong>
                <p id="affJeuxThemesEvent">[Jeux et thèmes]</p>
            </div>
        </div>
    </div>

    <div style="margin-top: 20px; width: 100%;">
        <h2>Informations du profil Organisateur</h2>
        <hr>

        <div style="display:flex; flex-direction:row; justify-content:space-between;">
            <strong>Rue et n° :</strong>
            <p id="affAdresse" style="margin:0;">[Adresse]</p>
        </div>
        
        <div style="display:flex; flex-direction:column; justify-content:space-between;">
            <div style="display:flex; flex-direction:row; justify-content:space-between;">
                <strong>Ville :</strong>
                <p id="affVille" style="margin:0;">[Ville]</p>
            </div>
            <div style="display:flex; flex-direction:row; justify-content:space-between;">
                 <strong>Code postal :</strong>
                 <p id="affCodePostal" style="margin:0;">[Code postal]</p>
            </div>
        </div>

        <div style="display:flex; flex-direction:row; justify-content:space-between;">
            <strong>Téléphone :</strong>
            <p id="affTel" style="margin:0;">[Numéro de téléphone]</p>
        </div>

        <div style="display:flex; flex-direction:row; justify-content:space-between;">
            <strong>Mail :</strong>
            <p id="affMail" style="margin:0;">[Adresse email]</p>
        </div>

        <div>
            <strong>URLs :</strong>
            <ul id="affUrls" style="margin:0; padding-left:20px;">
                <li><a href="[url1]" target="_blank" rel="noopener noreferrer">[url1]</a></li>
                <li><a href="[url2]" target="_blank" rel="noopener noreferrer">[url2]</a></li>
            </ul>
        </div>
    </div>

</div>