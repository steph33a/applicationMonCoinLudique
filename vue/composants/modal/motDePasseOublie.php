

 
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">

<form class="formulaireMotDePasse" id="formulaireMotDePasseOublie" action="../../controller/controller.php" method="POST">
    <div class="blocChampsFormulaire">
        <?php if (isset($_SESSION['id'])) { ?>
            <h2 class="titreFormulaire">Mot de passe oublié</h2>
        <?php } else { ?>
            <h2 class="titreFormulaire">Enregistre infos pour la récupération de mot de passe</h2>
        <?php } ?>

        <label class="labelFormulaire" for="emailPart">Email :</label>
        <input class="email formElement" type="email" name="email">
        <p class="emailCommentaire commentaire displayNone"></p>

        <label class="labelFormulaire">Quel est votre jeu préféré</label>
        <input class="jeuPrefereUser formElement" type="text" id="jeuPrefereUser" name="jeuPrefereUser" placeholder="nom du jeu préféré" required>
        <p class="jeuPrefereUserCommentaire commentaire displayNone" id="jeuPrefereUserCommentaire"></p>

        <label class="labelFormulaire">Quel est votre chanteur préféré</label>
        <input class="chanteurPrefereUser formElement" type="text" id="chanteurPrefereUser" name="chanteurPrefereUser" placeholder="nom du chanteur préféré" required>
        <p class="chanteurPrefereUserCommentaire commentaire displayNone" id="chanteurPrefereUserCommentaire"></p>

        <?php if (isset($_SESSION['id'])) { ?>
            <input class="boutonValidation formElement" type="submit" value="Envoyer" name="btnSendInfosSuppCompte" id="btnSendInfosSuppCompte">
        <?php } else { ?>
            <input class="boutonValidation formElement" type="submit" value="Envoyer" name="btnEnvoiReponsesRecupMotDePasse" id="btnEnvoiReponsesRecupMotDePasse">
        <?php } ?>
    </div>
</form>

