
<div class="event-card" style="width:620px; background-color: #F8F3EB; opacity: 0.7; border: #704405 solid 1px; display:flex; flex-direction:row; justify-content:space-between; align-items:center;" id="eventSelected">
    
    <div class="left-column" style="width:190px; margin-top:0px; display:flex; flex-direction:column; justify-content:space-between;">
        <h3><?php echo !empty($evenementSelected['prenom-utilisateur']) ? "Evenement Public" : 'Evenement Privé'; ?></h3>
        <h4><?php echo $evenementSelected['type_soiree']; ?></h4>

        <?php
        if (!function_exists('cleanImagePath')) {
            function cleanImagePath($fullPath) {
                if ($fullPath === null) return $fullPath;
                return str_replace('/moncoinludique/vue/', '../', $fullPath);
            }
        }

        $evenementSelected['image_evenement'] = cleanImagePath($evenementSelected['image_evenement']);
        ?>

        <label style="margin-top: 0px; cursor:pointer; display:inline-block;" for="photoInput" class="photo-label">
            <div class="photo-container">
                <img src="<?php echo $evenementSelected['image_evenement']; ?>" alt="Photo" class="photoEvent" />
            </div>
        </label>
    </div>

    <div class="right-column" style="margin-top:0px; display:flex; flex-direction:column; justify-content:space-between; width:345px;">
        <div style="display:flex; flex-direction:row; justify-content:space-between; align-items:center;">
            
            <div class="host-info">
                    <h3><?php echo $evenementSelected['pseudo']; ?></h3>
                    <h4><?php echo "alias " . $evenementSelected['prenom_utilisateur'] . " " . $evenementSelected['nom_utilisateur']; ?></h4>
            </div>
          
                <?php
                $evenementSelected['imageProfil'] = cleanImagePath($evenementSelected['imageProfil']);
                ?>
                <label style="margin-top: 10px; cursor:pointer; display:inline-block;" for="photoInput" class="photo-label">
                    <div class="photoProfil-container" style="position:relative;">
                        <img src="<?php echo $evenementSelected['imageProfil']; ?>" alt="Photo" class="photoProfil" />
                    </div>
                </label>
                
        </div>
        

        <div class="event-info">
            <div style="display:flex; flex-direction:row; justify-content:space-between; align-items:center; width:305px;">
                <div class="dateetHeureEvenement"><strong>Date et heure de l'événement</strong></div>
                <div class="valueDateHeureEvenement" style="text-align:right;"><?php echo $evenementSelected['date_evenement'] . " " . $evenementSelected['heure']; ?></div>
            </div>
            <div style="display:flex; flex-direction:row; justify-content:space-between; align-items:center; width:305px;">
                <div><strong class="lieu">Lieu</strong></div>
                <div style="text_align:right;"><?php echo $evenementSelected['adresse_ville']; ?></div>
            </div>
            <div style="display:flex; flex-direction:row; justify-content:space-between; align-items:center; width:305px;">
                <strong class="places_restantes">Places restantes</strong>
                <?php
                $nbInscrits = intval($evenementSelected['nbInscrits']);
                $nbParticipantsMax = intval($evenementSelected['nbParticipants_max']);
                $placesRestantes = $nbParticipantsMax - $nbInscrits;

                if ($placesRestantes > 0) {
                    echo '<div style="text_align:right;" class="valuePlacesRestantes">' . $placesRestantes . '</div>';
                } else {
                    echo '<div style="text_align:right;" class="valuePlacesRestantes">Complet</div>';
                }
                ?>
            </div>
        </div>
         <div style="width:320px; display:flex; flex-direction:row; justify-content:flex-end; align-items:center;" class="boutonContainer" style="margin: 0 10px;">
            <form action="../../controller/controller.php" method="POST" class="formActionMiniEvenement">
                <input type="hidden" name="id_evenement" readonly value="<?php echo ($evenementSelected['id_evenement']); ?>">

                <?php if ($page_contexte === 'accueil' || $page_contexte === 'actionEvenement'){ ?>
                    <button
                        type="submit"
                        name="btnVoirEvenement"
                        value="voir_details"
                        class="btnVoirEvenement"
                        style="width:114px; height:40px; background-color:#6EBA46; color:#FFF; font-size:18px; font-weight:600;"
                    class="btnVoirEvenement">
                        Voir
                    </button>
                <?php } elseif ($page_contexte === 'gestion_evenements'){ ?>

                    <button
                        type="submit"
                        name="btnaction_evenement"
                        value="voir_gestion"
                        class="btnVoirEvenement"
                        style="width:114px; height:40px; background-color:#6EBA46; color:#FFF; font-size:18px; font-weight:600;"
                    >
                        Gérer
                    </button>
                <?php }; ?>
            </form>
        </div>
    </div>

   
</div>
