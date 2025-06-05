<div id="eventSelected" class="eventSelectedSpecial event-card">
    <?php $eventTypePublic = !empty($evenementSelectedSpecial['prenom-utilisateur']); ?>

    <!-- Colonne gauche : Image événement + Liens -->
    <div class="left-column">
        <!-- Image de l'événement -->
        <div class="photo-container">
            <img src="<?php echo cleanImagePath($evenementSelectedSpecial['image_evenement']); ?>" alt="Photo de l'événement" class="photoEvent" />
        </div>

        <!-- Lien 1 s'il existe -->
        <?php if (!empty($evenementSelectedSpecial['url'])): ?>
            <div class="event-link">
                <a href="<?php echo $evenementSelectedSpecial['url']; ?>" target="_blank">Lien 1</a>
            </div>
        <?php endif; ?>

        <!-- Lien 2 s'il existe -->
        <?php if (!empty($evenementSelectedSpecial['url2'])): ?>
            <div class="event-link">
                <a href="<?php echo $evenementSelectedSpecial['url2']; ?>" target="_blank">Lien 2</a>
            </div>
        <?php endif; ?>
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
                <span class="info-value"><?php echo $evenementSelectedSpecial['date_evenement'] . " à " . $evenementSelected['heure']; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Adresse :</span>
                <span class="info-value"><?php echo $evenementSelected['numRue'] . ", " . $evenementSelected['rue']; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Ville :</span>
                <span class="info-value"><?php echo $evenementSelected['adresse_ville'] . " (" . $evenementSelected['codepostal'] . ")"; ?></span>
            </div>
        </div>

        <!-- Infos complémentaires -->
        <div class="event-info">
            <div class="info-row">
                <span class="info-label">Jeux :</span>
                <span class="info-value"><?php echo $evenementSelected['jeux']; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Thèmes :</span>
                <span class="info-value"><?php echo $evenementSelected['themes']; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Places restantes :</span>
                <span class="info-value">
                    <?php
                        $nbInscrits = intval($evenementSelected['nbInscrits']);
                        $nbParticipantsMax = intval($evenementSelected['nbParticipants_max']);
                        $placesRestantes = $nbParticipantsMax - $nbInscrits;
                        echo $placesRestantes > 0 ? $placesRestantes : 'Complet';
                    ?>
                    / <?php echo $nbParticipantsMax; ?>
                </span>
            </div>

            <?php if (!empty($evenementSelected['numberPhoneEvent'])): ?>
                <div class="info-row">
                    <span class="info-label">Téléphone :</span>
                    <span class="info-value"><?php echo $evenementSelected['numberPhoneEvent']; ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($evenementSelected['emailEvent'])): ?>
                <div class="info-row">
                    <span class="info-label">Email :</span>
                    <span class="info-value"><?php echo $evenementSelected['emailEvent']; ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($evenementSelected['recurrenceEvent'])): ?>
                <div class="info-row">
                    <span class="info-label">Groupe de discussion :</span>
                    <span class="info-value"><?php echo $evenementSelected['recurrenceEvent']; ?></span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Bouton inscription -->
        <div class="boutonContainer">
            <form action="../../controller/controller.php" method="post" class="formActionInscription">
                <input type="hidden" name="id_evenement" value="<?php echo $evenementSelected['id_evenement']; ?>">
                <input type="number" name="nbInscrits" placeholder="0" min="0" max="5">
                <input type="hidden" name="id_utilisateur" value="<?php echo $_SESSION['id_utilisateur']; ?>">

                <button type="submit" name="btninscriptionEvent" class="btn-inscription">
                    S'inscrire
                </button>
            </form>
        </div>
    </div>
</div>


