   <?php if (isset($evenementSelectedSpecial)and $evenementSelectedSpecial !== null) {
      $eventTypePublic = !empty($evenementSelectedSpecial['prenom-utilisateur']); ?>

    <!-- Colonne gauche : Image événement + Liens -->
    <div class="left-column">
        <!-- Image de l'événement -->
        <div class="photo-container">
            <img src="<?php echo cleanImagePath($evenementSelectedSpecial['image_evenement']); ?>" alt="Photo de l'événement" class="photoEvent" />
        </div>

        <!-- Lien 1 s'il existe -->
        <?php if (!empty($evenementSelectedSpecial['url'])) {?>
            <div class="event-link">
                <a href="<?php echo $evenementSelectedSpecial['url']; ?>" target="_blank">Lien 1</a>
            </div>
        <?php }; ?>

        <!-- Lien 2 s'il existe -->
        <?php if (!empty($evenementSelectedSpecial['url2'])){ ?>
            <div class="event-link">
                <a href="<?php echo $evenementSelectedSpecial['url2']; ?>" target="_blank">Lien 2</a>
            </div>
        <?php } ?>
    </div>

    <!-- Colonne droite : Infos événement -->
    <div class="right-column">
        <!-- Type d'événement -->
        <div class="event-info">
            <h3><?php echo $eventTypePublic ? "Événement Public" : "Événement Privé"; ?></h3>
            <h4><?php echo $evenementSelectedSpecial['type_soiree']; ?></h4>
        </div>

        <!-- Infos Hôte -->
        <div class="host-section">
            <div class="host-info">
                <h3><?php echo $evenementSelectedSpecial['pseudo']; ?></h3>
                <h4>alias <?php echo $evenementSelectedSpecial['prenom_utilisateur'] . " " . $evenementSelectedSpecial['nom_utilisateur']; ?></h4>
            </div>
            <div class="photoProfil-container">
                <img src="<?php echo cleanImagePath($evenementSelectedSpecial['imageProfil']); ?>" alt="Photo de profil" class="photoProfil" />
            </div>
        </div>

        <!-- Coordonnées événement -->
        <div class="event-info">
            <div class="info-row">
                <span class="info-label">Date & Heure :</span>
                <span class="info-value"><?php echo $evenementSelectedSpecial['date_evenement'] . " à " . $evenementSelectedSpecial['heure']; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Adresse :</span>
                <span class="info-value"><?php echo $evenementSelectedSpecial['numRue'] . ", " . $evenementSelectedSpecial['rue']; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Ville :</span>
                <span class="info-value"><?php echo $evenementSelectedSpecial['adresse_ville'] . " (" . $evenementSelectedSpecial['codepostal'] . ")"; ?></span>
            </div>
        </div>

        <!-- Infos complémentaires -->
        <div class="event-info">
            <div class="info-row">
                <span class="info-label">Jeux :</span>
                <span class="info-value"><?php echo $evenementSelectedSpecial['jeux']; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Thèmes :</span>
                <span class="info-value"><?php echo $evenementSelectedSpecial['themes']; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Places restantes :</span>
                <span class="info-value">
                    <?php
                        $nbInscrits = intval($evenementSelectedSpecial['nbInscrits']);
                        $nbParticipantsMax = intval($evenementSelectedSpecial['nbParticipants_max']);
                        $placesRestantes = $nbParticipantsMax - $nbInscrits;
                        echo $placesRestantes > 0 ? $placesRestantes : 'Complet';
                    ?>
                    / <?php echo $nbParticipantsMax; ?>
                </span>
            </div>

            <?php if (!empty($evenementSelectedSpecial['numberPhoneEvent'])){?>
                <div class="info-row">
                    <span class="info-label">Téléphone :</span>
                    <span class="info-value"><?php echo $evenementSelectedSpecial['numberPhoneEvent']; ?></span>
                </div>
            <?php } ?>

            <?php if (!empty($evenementSelectedSpecial['emailEvent'])){ ?>
                <div class="info-row">
                    <span class="info-label">Email :</span>
                    <span class="info-value"><?php echo $evenementSelectedSpecial['emailEvent']; ?></span>
                </div>
            <?php } ?>

            <?php if (!empty($evenementSelectedSpecial['recurrenceEvent'])){ ?>
                <div class="info-row">
                    <span class="info-label">Groupe de discussion :</span>
                    <span class="info-value"><?php echo $evenementSelectedSpecial['recurrenceEvent']; ?></span>
                </div>
            <?php } ?>
        </div>

        <!-- Bouton inscription -->
        <div class="boutonContainer">
            <form action="../../controller/controller.php" method="post" class="formActionInscription">
                <input type="hidden" name="id_evenement" value="<?php echo $evenementSelectedSpecial['id_evenement']; ?>">
                <input type="number" name="nbInscrits" placeholder="0" min="0" max="5">
                <input type="hidden" name="id_utilisateur" value="<?php echo $_SESSION['id_utilisateur']; ?>">

                <button type="submit" name="btninscriptionEvent" class="btn-inscription">
                    S'inscrire
                </button>
            </form>
        </div>
    </div>
    <?php
    } else {
        ?>
        <p>Aucun événement disponible</p> <?php
    } 
    ?>

#eventSelected .event-card {
    width: 620px;
    background-color: #F8F3EB;
    opacity: 0.7;
    border: 1px solid #704405;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
}

#eventSelected .left-column {
    width: 190px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

#eventSelected .photo-label {
    margin-top: 0px;
    cursor: pointer;
    display: inline-block;
}

#eventSelected .photo-container,
#eventSelected .photoProfil-container {
    position: relative;
}

#eventSelected .photoEvent,
#eventSelected .photoProfil {
    width: 100%;
    height: auto;
    max-width: 100%;
    object-fit: cover;
}

#eventSelected .right-column {
    width: 345px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

#eventSelected .host-section {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
}

#eventSelected .host-info h3,
#eventSelected .host-info h4 {
    margin: 0;
}

#eventSelected .event-info {
    margin-top: 10px;
}

#eventSelected .info-row {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    width: 305px;
    margin: 5px 0;
}

#eventSelected .info-label {
    font-weight: bold;
}

#eventSelected .info-value {
    text-align: right;
}

#eventSelected .boutonContainer {
    width: 320px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: center;
    margin: 0 10px;
}

#eventSelected .formActionInscription {
    display: flex;
    flex-direction: column;
    gap: 8px;
    align-items: center;
}

#eventSelected .btn-inscription {
    width: 114px;
    height: 40px;
    background-color: #6EBA46;
    color: #FFF;
    font-size: 18px;
    font-weight: 600;
    border: none;
    cursor: pointer;
}

