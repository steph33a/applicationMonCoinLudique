

 
        
      
       
        <form style="width:620px; min-height: 448px;background-color: #FFFFFF; display:flex; flex-direction:column; justify-content:space-between; align-items:center;"class="formulaire" id="formulaireMotDePasseOublie" action="../../controller/controller.php" method="POST">
            <div style=" display:flex; flex-direction:column; justify-content:space-between;   width:305px">
                <?php if (isset($_SESSION['id'])) { ?>
                <h2 style=" font-size: 36px; font-weight: 700; margin-left: auto; margin-right: auto; margin-top: 28px; font-family: 'Nunito Sans', sans-serif;"> Mot de passe Oublié</h2>
                <?php
                } else {
                    ?>
                <h2 style=" font-size: 36px; font-weight: 700; margin-left: auto; margin-right: auto; margin-top: 28px; font-family: 'Nunito Sans', sans-serif;"> Enregistre infos pour la récupération de mot de passe</h2>
               <?php } ?>
          
                <label style="text-align: left;margin-top: 25px;" for="emailPart">Email :</label>
                <input  class="email formElement" type="email" name="email" >
                <p class="emailCommentaire commentaire displayNone" ></p>

                <label style="text-align: left;margin-top: 25px;">Quel est votre jeu préféré</label>
                <input  class="jeuPrefereUser formElement"type="text" id="jeuPrefereUser" name="jeuPrefereUser" min="2" placeholder="nom du film préféré" required autofocus>
                
                <p class="jeuPrefereUserCommentaire    commentaire displayNone" id="jeuPrefereUserCommentaire"></p>
                <!-- prénom -->
                <label style="text-align: left;margin-top: 25px;">Quel est votre chanteur préféré</label>
                <input  class="chanteurPrefereUser formElement"type="text" id="chanteurPrefereUser" name="chanteurPrefereUser" min="2" placeholder="nom du film préféré" required autofocus>
                
                <p class="chanteurPrefereUserCommentaire commentaire displayNone" id="chanteurPrefereCommentaire"></p>
                <?php if (isset($_SESSION['id'])) { ?>
                    <input style=" margin-top: 25px;width:114px; height:40px;background-color: #6EBA46; color: #FFFFFF; font-size:18px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" class="formElement" type="submit" value="Envoyer" name="btnSendInfosSuppCompte" id="btnSendInfosSuppCompte">  
              <?php  } else { ?>
                     <input style=" margin-top: 25px;width:114px; height:40px;background-color: #6EBA46; color: #FFFFFF; font-size:18px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" class="formElement" type="submit" value="Envoyer" name="btnEnvoiReponsesRecupMotDePasse" id="btnEnvoiReponsesRecupMotDePasse">
                <?php
                }
             ?>

            </div>
       
        </form>
