

 
        
      
       
        <form style="width:620px; min-height: 448px;background-color: #FFFFFF; display:flex; flex-direction:column; justify-content:space-between; align-items:center;"class="formulaire" id="formulaireRecuperationDeMotDePasse" action="../controller/controller.php" method="POST">
            <div style=" display:flex; flex-direction:column; justify-content:space-between;   width:305px">
                <h2 style=" font-size: 36px; font-weight: 700; margin-left: auto; margin-right: auto; margin-top: 28px; font-family: 'Nunito Sans', sans-serif;"> Mot de passe Oublié</h2>
                <label style="text-align: left;margin-top: 25px;" for="emailPart">Email :</label>
                <input  class="formElement" type="email" name="email" id="mail">
                <p class="commentaire displayNone" id="mailCommentaire"></p>

                <label style="text-align: left;margin-top: 25px;">Quel est votre film préféré</label>
                <input  class="formElement"type="text" id="filmPrefereUser" name="filmPrefereUser" min="2" placeholder="nom du film préféré" required autofocus>
                
                <p class="commentaire displayNone" id="filmPrefereCommentaire"></p>
                <!-- prénom -->
                <label style="text-align: left;margin-top: 25px;">Quel est votre chanteur préféré</label>
                <input  class="formElement"type="text" id="chanteurPrefereUser" name="chanteurPrefereUser" min="2" placeholder="nom du film préféré" required autofocus>
                
                <p class="commentaire displayNone" id="filmPrefereCommentaire"></p>

                <input style=" margin-top: 25px;width:114px; height:40px;background-color: #6EBA46; color: #FFFFFF; font-size:18px; font-weight: 600; font-family: 'Nunito Sans', sans-serif;" class="formElement" type="submit" value="Envoyer" name="btnRecuperationDeMotDePasse" id="btnRecuperationDeMotDePasse">

            </div>
       
        </form>
