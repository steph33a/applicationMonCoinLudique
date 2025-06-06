
<?php if (!$estConnecte || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {?> 

    <form class="formulaire formulaire-connexion" id="formulaireConnexion" action="../../controller/controller.php" method="POST">
        <h2 class="formulaire-titre">Connexion</h2>

        <label class="formulaire-label" for="mailConnexion">Email</label>
        <input class="formulaire-input email" type="email" id="mailConnexion" name="email" placeholder="Email" autofocus required>
        <p class="formulaire-commentaire mailCommentaire displayNone" id="mailCommentaireConnexion"></p>

        <label class="formulaire-label" for="motDePasseConnexion">Mot de passe</label>  
        <input class="formulaire-input motDePasse" type="password" id="motDePasseConnexion" name="motDePasse" placeholder="Mot de passe" required>
        <p class="formulaire-commentaire motDePasseCommentaire displayNone"></p>

        <div class="formulaire-checkbox-container">
            <input type="checkbox" name="voirMDP" id="voirMDPConnexion">
            <label for="voirMDP">Afficher le mot de passe</label>
        </div>

        <ul class="formulaire-liens">
            <li><a class="openModalLink" href="#" id="openModalLinkMotDePasseOublie">Mot de passe oublié</a></li>
            <li><a class="openModalLink openModalLinkInscription" href="#" id="openModalLinkInscription">Inscription</a></li>
        </ul>

        <button class="btnFormulaire" type="submit" id="btnConnexion" name="btnConnexion">Connexion</button>
        <div id="formulaireConnexionCommentaire"></div>
    </form>  

<?php } else if ($_SESSION['role'] == 'admin') {?>

    <form class="formulaire formulaire-admin-login" id="formulaireLoginAsUser" action="../../controller/controller.php" method="POST">
        <h2 class="formulaire-titre">Mode administrateur : Connexion en tant qu'un autre utilisateur</h2>

        <label class="formulaire-label" for="pseudoConnexion">Pseudo</label>
        <input class="formulaire-input pseudo" type="text" id="pseudoConnexion" name="pseudo" placeholder="pseudo" autofocus required>
        <p class="formulaire-commentaire pseudoCommentaire displayNone" id="pseudoCommentaireConnexion"></p>

        <ul class="formulaire-liens">
            <li><a class="openModalLink openModalLinkInscription" href="#" id="openModalLinkInscription">Inscription</a></li>
        </ul>

        <button class="btnFormulaire" type="submit" id="btnAdminLoginAsUser" name="btnAdminLoginAsUser">
            Se connecter en tant que cet utilisateur
        </button>

        <div id="formulaireConnexionCommentaire"></div>
    </form>  

<?php } ?>
