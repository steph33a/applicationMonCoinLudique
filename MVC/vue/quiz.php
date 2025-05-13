
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
          <script src="form_validations.js" defer></script>

     <link rel="stylesheet" href="styles.css">
    </head>
    <body>
     
    <main>
    
    <div id="divBody">
        <?php

        
            // echo "Bonjour " . $_SESSION['pseudo'] . ", nous sommes ravis de vous voir à nouveau.";
        
           include_once 'db.php';
            global $connexion_bd;
            require_once 'get_questions.php';
            getBaseDonneesQuizz();
            $_SESSION['tableauDonneesQuizz']=getQuizz();
            // var_dump($_SESSION['tableauDonneesQuizz']);
            // echo "meilleurscore".$_SESSION['meilleurscoreJeu1']
        
            $_SESSION['score']=0;
            $_SESSION['i']=0;
            // count nombre d'élément du tableau
            $_SESSION['nombreTotalQuestionQuizz']=count($_SESSION['tableauDonneesQuizz']);
            ?>
              
            <?php
        if (isset($_POST['btnValiderReponse'])) {


                $reponseDonnee1=$_POST['reponseDonnee1'];
                
                $numeroBonneReponse=$_SESSION['tableauDonneesQuizz'][0]["numeroBonneReponse"];
                switch ($numeroBonneReponse) {
                case 1:
                    
                    $bonneReponse=$_SESSION['tableauDonneesQuizz'][0]["proposition1"];
                    
                    break;
                case 2:
                        $bonneReponse=$_SESSION['tableauDonneesQuizz'][0]["proposition2"];
                    break;
                case 3:
                        $bonneReponse=$_SESSION['tableauDonneesQuizz'][0]["proposition3"];
                    break;
                     case 4:
                        $bonneReponse=$_SESSION['tableauDonneesQuizz'][0]["proposition4"];
                    break;
                
                }
                // La première fois que le bouton est validé i vaut 0 et la réponse se trouve à la première ligne du tableauDonnees du quizz
                if ($reponseDonnee1==$bonneReponse){
                    $_SESSION['score']= $_SESSION['score']+1;
                }
                      $reponseDonnee2=$_POST['reponseDonnee2'];
                
                $numeroBonneReponse=$_SESSION['tableauDonneesQuizz'][1]["numeroBonneReponse"];
                switch ($numeroBonneReponse) {
                case 1:
                    
                    $bonneReponse=$_SESSION['tableauDonneesQuizz'][1]["proposition1"];
                    
                    break;
                case 2:
                        $bonneReponse=$_SESSION['tableauDonneesQuizz'][1]["proposition2"];
                    break;
                case 3:
                        $bonneReponse=$_SESSION['tableauDonneesQuizz'][1]["proposition3"];
                    break;
                 case 4:
                        $bonneReponse=$_SESSION['tableauDonneesQuizz'][1]["proposition4"];
                    break;
                }
                // La première fois que le bouton est validé i vaut 0 et la réponse se trouve à la première ligne du tableauDonnees du quizz
                if ($reponseDonnee2==$bonneReponse){
                    $_SESSION['score']= $_SESSION['score']+1;
                }
                $_SESSION['i']++;

                    echo "vous avez terminé le quizz";
                    echo "<br>";
                    echo "vous avez obtenu ".$_SESSION['score']." points sur ".$_SESSION['nombreTotalQuestionQuizz'];
                    $jeu="quiz";
                    include_once 'save_score.php';
                    sendScoreInBD($_SESSION['id'],$jeu,$_SESSION['score']);
                   
               ?>  <div>
                 <form action="dashboard.php" method="post
            ">
            <input type="submit" name="btnValiderReponse"value="retour accueil "></form>

          
                    </div>
                    <?php
                
               
        }
           
                // Comportement si on a terminé le quizz
         
                // si le test n'est pas fini affichage de la question suivante, de ses propositions et du résultat et de son meilleurScore
                
        
       
     else {  
        ?>

            <div id="Jeu1div">
                <form action="quiz.php" method="post">

                    <p><?php echo $_SESSION['tableauDonneesQuizz'][0]["question"];?></p>
                    <!-- l'id doit correspondre au name de l'input -->
                    <input type="radio" name="reponseDonnee1" value="<?php echo $_SESSION['tableauDonneesQuizz'][0]["proposition1"]; ?>" id="proposition1"><label for="proposition1"><?php echo $_SESSION['tableauDonneesQuizz'][0]["proposition1"]; ?></label>
                    <input type="radio" name="reponseDonnee1" value="<?php echo $_SESSION['tableauDonneesQuizz'][0]["proposition2"]; ?>" id="proposition2"><label for="proposition2"><?php echo $_SESSION['tableauDonneesQuizz'][0]["proposition2"]; ?></label>
                    <input type="radio" name="reponseDonnee1" value="<?php echo $_SESSION['tableauDonneesQuizz'][0]["proposition3"]; ?>" id="proposition3"><label for="proposition3"><?php echo $_SESSION['tableauDonneesQuizz'][0]["proposition3"]; ?></label> 
                      
                                        <input type="radio" name="reponseDonnee1" value="<?php echo $_SESSION['tableauDonneesQuizz'][0]["proposition4"]; ?>" id="proposition4"><label for="proposition4"><?php echo $_SESSION['tableauDonneesQuizz'][0]["proposition4"]; ?></label> 
                    <p><?php echo $_SESSION['tableauDonneesQuizz'][1]["question"];?></p>
                    <!-- l'id doit correspondre au name de l'input -->
                    <input type="radio" name="reponseDonnee2" value="<?php echo $_SESSION['tableauDonneesQuizz'][1]["proposition1"]; ?>" id="proposition1"><label for="proposition1"><?php echo $_SESSION['tableauDonneesQuizz'][1]["proposition1"]; ?></label>
                    <input type="radio" name="reponseDonnee2"value="<?php echo $_SESSION['tableauDonneesQuizz'][1]["proposition2"]; ?>" id="proposition2"><label for="proposition2"><?php echo $_SESSION['tableauDonneesQuizz'][1]["proposition2"]; ?></label>
                    <input type="radio" name="reponseDonnee2" value="<?php echo $_SESSION['tableauDonneesQuizz'][1]["proposition3"]; ?>" id="proposition3"><label for="proposition3"><?php echo $_SESSION['tableauDonneesQuizz'][1]["proposition3"]; ?></label> 
                   <input type="radio" name="reponseDonnee2" value="<?php echo $_SESSION['tableauDonneesQuizz'][1]["proposition4"]; ?>" id="proposition4"><label for="proposition3"><?php echo $_SESSION['tableauDonneesQuizz'][1]["proposition4"]; ?></label> 
                    <input type="submit" name="btnValiderReponse"value="bouton valider">
    
                </form>             
            </div>
             <a href="controller.php?page=dashboard">retour au jeux </a>

        </div>
        <?php
    }
    ?>
</main>

</body>
</html>


            
