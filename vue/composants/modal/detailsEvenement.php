  <?php 
    if (isset($evenementSelectedSpecial)and $evenementSelectedSpecial != null) {
      
  ?>
<div id="eventSelected" class="eventSelectedSpecial event-card">
     
    <?php 
    if (!isset($evenementSelectedSpecial)and $evenementSelectedSpecial == null) {
         exit();
     }
    if (!function_exists('cleanImagePath')) {
            function cleanImagePath($fullPath) {
                if ($fullPath === null) return $fullPath;
                return str_replace('/moncoinludique/vue/', '../', $fullPath);
            }
        }
    
    if (isset($evenementSelectedSpecial)and $evenementSelectedSpecial !== null) {
      $eventTypePublic = !empty($evenementSelectedSpecial['prenom-utilisateur'])
      ;} ?>
    <div class="partie1" id="separationColonne">
        <div class="left-column">
           
            <!-- Image de l'événement -->
            <div class="photo-container">
                <img src="<?php echo cleanImagePath($evenementSelectedSpecial['image_evenement']); ?>" alt="Photo de l'événement" class="photoEvent" />
            </div>

            <!-- Lien 1 s'il existe -->
            <?php if (!empty($evenementSelectedSpecial['url1'])) {?>
                <div class="event-link">
                    <a href="<?php echo $evenementSelectedSpecial['url1']; ?>" target="_blank">Lien 1</a>
                </div>
            <?php }; ?>

            <!-- Lien 2 s'il existe -->
            <?php if (!empty($evenementSelectedSpecial['url2'])){ ?>
                <div class="event-link">
                    <a href="<?php echo $evenementSelectedSpecial['url2']; ?>" target="_blank">Lien 2</a>
                </div>
            <?php } ?>
        </div>
        <div class="right-column">
            <!-- Type d'événement -->
             <div class="event-info">
                <h3><?php if (empty($evenementSelectedSpecial['prenom-utilisateur'])) { echo "Événement Privé"; } else { echo "Événement Public"; } ?> </h3>
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
        </div>
    </div>
    <div class="partie2">
        <div class="right-column partieEventInfos">
            <div class="event-info">
                <div class="info-row">
                    <span class="info-label">Date & Heure :</span>
                    <span class="info-value"><?php echo $evenementSelectedSpecial['date_evenement'] . " à " . $evenementSelectedSpecial['heure']; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Adresse :</span>
                    <span class="info-value"><?php echo $evenementSelectedSpecial['adresse_rue'] . ", " . $evenementSelectedSpecial['adresse_numero']; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Ville :</span>
                    <span class="info-value"><?php echo $evenementSelectedSpecial['adresse_ville'] . " (" . $evenementSelectedSpecial['adresse_CP'] . ")"; ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="partie3">

        <!-- Infos complémentaires -->
        <div class="event-info">
            <div class="info-row">
                <span class="info-label">Jeux :</span>
                <span class="info-value"><?php echo $evenementSelectedSpecial['jeux_et_themes']; ?></span>
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

            <?php if (!empty($evenementSelectedSpecial['telephone'])){?>
                <div class="info-row">
                    <span class="info-label">Téléphone :</span>
                    <span class="info-value"><?php echo $evenementSelectedSpecial['telephone']; ?></span>
                </div>
            <?php } ?>

            <?php if (!empty($evenementSelectedSpecial['email'])){ ?>
                <div class="info-row">
                    <span class="info-label">Email :</span>
                    <span class="info-value"><?php echo $evenementSelectedSpecial['email']; ?></span>
                </div>
            <?php } ?>

            <?php if (!empty($evenementSelectedSpecial['recurrence'])){ ?>
                <div class="info-row">
                    <span class="info-label">Groupe de discussion :</span>
                    <span class="info-value"><?php echo $evenementSelectedSpecial['recurrence']; ?></span>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="partie4">

        <div class="boutonContainer">
            <form action="../../controller/controller.php" method="post" class="formActionInscription">
                <input type="hidden" name="id_evenement" value="<?php echo $evenementSelectedSpecial['id_evenement']; ?>">

                <div class="inputRow">
                    <label for="nbInscrits">Nombre d'inscrits</label>
                    <input type="number" name="nbInscrits" id="nbInscrits" placeholder="0" min="0" max="5"
                        <?php if (!isset($_SESSION['id_utilisateur'])) echo 'disabled'; ?>>
                </div>

                <?php if (isset($_SESSION['id_utilisateur'])): ?>
                    <input type="hidden" name="id_utilisateur" value="<?php echo $_SESSION['id_utilisateur']; ?>">
                <?php endif; ?>

                <button type="submit" name="btninscriptionEvent" class="btn-inscription"
                    <?php if (!isset($_SESSION['id_utilisateur'])) echo 'disabled title="Connectez-vous pour vous inscrire"'; ?>>
                    S'inscrire
                </button>
            </form>
        </div>
     
    </div>

    
</div>
<?php } else { ?> <p>recharger l'événement</p> <?php }?>



