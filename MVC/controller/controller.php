
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once 'db.php';

require ($_SERVER['DOCUMENT_ROOT'].'/MVC/model/model.php');
//fonctiosns helpers

    function handleLoginAndRegistration() {
      
      if  (isset($_POST['btnConnexion'])){

          existInDbUtilisateur($_POST);

          if (isset($_SESSION['id'])) {

            includeView('dashboard');

            exit();

          } else
          includeView('index');
         
          exit();
      }

      if  (isset($_POST['btnGoToInscription'])){


          if (isset($_SESSION['id'])) {

            includeView('dashboard');

            exit();

          } else

          if (isset($_POST['btnInscription'])){
        
            // var_dump($_POST);
            //  echo "arrive dans inscription";
              insertInBdUtilisateur($_POST);

              if (isset($_SESSION['id'])) {

              includeView('dashboard');

              exit();

              }

            }

            includeView('register');

            exit();
            }
          

          if (isset($_POST['btnDeconnexion'])) {
              session_destroy();
             includeView('index');
              exit();
          }
    }
function includeView($viewName) {
    include($_SERVER['DOCUMENT_ROOT'] . "/MVC/vue/{$viewName}.php");
}



if (isset($_SESSION['id'])) { 

    if ((( isset($_GET['page']) && $_GET['page'] == 'dashboard')) || (!isset($_POST['actionDashboard']))){
      includeView('dashboard');
      exit();

    } 

    if (isset($_POST['actionDashboard'])){
       handleActionDashboard();
    }

   // Si l'utilisateur est connecté
    // Afficher le dashboard ou gérer les actions envoyées
} else {  // Si l'utilisateur n'est pas connecté
    handleLoginAndRegistration();
}




function handleActionDashboard() {

  switch ($_POST['actionDashboard']) {
        case 'btnJeuQuiz':
            echo "<script>console.log('Le bouton quizz a été cliqué');</script>";
           includeView('quiz');
    
           
            exit();

            break;
        
        case 'btnJeuMotMelange':
                
            if (isset($_POST['btnSubmit'])==false) {
                $_SESSION['score']=0;
            }
            echo "<script>console.log('Le bouton jeu mélangé a été cliqué');</script>";
              includeView('mot_melange');
           
            exit();
            break;

        case 'btnJeuNombreMystere':
             echo "<script>console.log('Le bouton jeu nombre mystère a été cliqué');</script>";
            includeView('nombre');
    
            exit();

          
            break;
        
        case 'btnScores':
           echo "<script>console.log('Le bouton scores a été cliqué');</script>";
            includeView('scores');
        
           exit();
            
            break;
        
        case 'btnDeconnexion':
             echo "<script>console.log('Le bouton deconnexion a été cliqué');</script>";
            session_destroy();
                includeView('index');
             exit();
            break;
        
        default:
            echo "Aucun bouton valide n'a été cliqué";
            break;
    }
  
       
}

    

?>