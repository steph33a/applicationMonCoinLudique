
 <div style="width=620px; background-color: #F8F3EB; opacity: 0.7; border: #704405 solid 1px; display:flex; flex-direction:row; justify-content:space-between; align-items:center;" >
        
    <div style="margin-top:25px; display:flex; flex-direction:column; justify-content:space-between;   width:200px"  class="" style=" margin-top: 20px;">
        <h3><?php  echo !empty($evenementSelected['prenomUtilisateur'])? "Evenement Public" : 'Evenement Prive'; ?></h3>
        <h4><?php  echo $evenementSelected['styleEvenement']; ?></h4>
        <label style="margin-top: 25px; cursor:pointer; display:inline-block;" for="photoInput" class="photo-label">
                <div class="photo-container">
                    <img style="" src="<?php  echo $evenementSelected['imageEvenementSource']; ?>" alt="Photo" class="photoEvent" />
                </div>
        </label>
    </div>
    <div style="margin-top:25px; display:flex; flex-direction:column; justify-content:space-between;   width:200px" class="" style=" margin-top: 20px;">
        <div style="position:relative;">
            
            <label style="margin-top: 25px; cursor:pointer; display:inline-block;" for="photoInput" class="photo-label">
                <div class="photo-container">
                    <img style="" src="<?php  echo $evenementSelected['imageProfilSource']; ?>" alt="Photo" class="photoProfil" />
                </div>
            </label>
            <div>
                <h3><?php  echo $evenementSelected['pseudo'];?></h3>
                <h4><?php  echo "alias ".$evenementSelected['prenomUtilisateur']." ".$evenementSelected['nomUtilisateur']; ?></h4>
            </div>

        </div>
        <div style="display:flex; flex-direction:row; justify-content:space-between;align-items:center; width:305px;" >
            <h3 class="dateetHeureEvenement">Date et heure de l'evenement</h3>
            <h4 class="valueDateHeureEvenement"><?php  echo $evenementSelected['dateEvenement']." ". $evenementSelected['heureEvenement']; //echo $dateEvenement." ". $heureEvenement; ?></h4>
        </div>
        <div  style="display:flex; flex-direction:row; justify-content:space-between;align-items:center; width:305px;">
            <h3 class="lieu">Lieu</h3>
            <h4><?php  echo $evenementSelected['lieuEvenement']; //echo $lieuEvenement; ?></h4>
        </div>
        <div  style="display:flex; flex-direction:row; justify-content:space-between;align-items:center; width:305px;">
            <h3 class="places restantes">Places restantes</label>
            <h4 class="valuePlacesRestantes"><?php  echo $evenementSelected['placesRestantes']; //echo $placesRestantes; ?></h4>
        </div>
       
    <form action="../controller/controller.php" method="post">
        <input type="hidden" name="idEvenement" value="<?php echo htmlspecialchars($evenementSelected); ?>">

        <?php if ($page_contexte === 'accueil' || $page_contexte === 'actionEvenement'): ?>
            <button
                type="submit"
                name="action"
                value="voir_details"
                class="btnVoirEvenement"
                style="width:114px; height:40px; background-color:#6EBA46; color:#FFF; font-size:18px; font-weight:600;"
            >
                Voir
            </button>

        <?php elseif ($page_contexte === 'gestion_evenement'): ?>
            <button
                type="submit"
                name="action"
                value="voir_gestion"
                class="btnVoirEvenement"
                style="width:114px; height:40px; background-color:#004B87; color:#FFF; font-size:18px; font-weight:600;"
            >
                Gérer
            </button>
        <?php endif; ?>
    </form>
    </div>

</div>
     