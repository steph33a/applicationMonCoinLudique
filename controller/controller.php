
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once ($_SERVER['DOCUMENT_ROOT'].'/model/db.php'); //require $_SERVER['DOCUMENT_ROOT'] /model/db.php';

require ($_SERVER['DOCUMENT_ROOT'].'/model/model.php');
//fonctiosns helpers

    function handleLoginAndRegistration() {
      if ( (!isset($_POST['btnInscription']))&& (!isset($_SESSION['id']))&& (!isset($_POST['btnConnexion']))){ {
        

          locationView('accueil');
          exit();
      }
      
      if  (isset($_POST['btnConnexion'])){

       
          existInDbUtilisateur($_POST);

          if (isset($_SESSION['id'])) {

            locationView('gestion_evenements');

            exit();

          } 
         
          
        }
      }

      if  (isset($_POST['btnGoToInscription'])){


          // if (isset($_SESSION['id'])) {

          //   locationView('gestion_evenements'); 

          //   exit();

          // } else

          if (isset($_POST['btnInscription'])){
        
            // var_dump($_POST);
            //  echo "arrive dans inscription";
              insertInBdUtilisateur($_POST);

              if (isset($_SESSION['id'])) {

              locationView('gestion_evenements');

              exit();

              }

             } 
            // ici affichage également du modal d'inscription
          
            }
          

          if (isset($_POST['btnDeconnexion'])) {
              session_destroy();
             locationView('accueil');
              exit();
          }
    }
  
function includeView($viewName) {
    include($_SERVER['DOCUMENT_ROOT'] . "/vue/{$viewName}.php");
}



 function locationView($viewName) {
    $path =  "../vue/pages/{$viewName}.php";
    header("Location: $path");
    exit();
}




if (isset($_SESSION['id'])) { 

    if ((( isset($_GET['page']) && $_GET['page'] == 'gestion_evenements')) || (!isset($_POST['actionPage']))){
      locationView('accueil');
      exit();

    } 

    if (isset($_POST['actionPage'])){
       handleActionAccueil();
    }

   // Si l'utilisateur est connecté
    // Afficher le dashboard ou gérer les actions envoyées
} else {  // Si l'utilisateur n'est pas connecté
    handleLoginAndRegistration();
}




function handleActionAccueil() {


       
}

    

?>