
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// echo "<script>console.log('arrive dans inscription ligne6');</script>";
// var_dump($_POST);
 var_dump($_SESSION);
// session_destroy();
include_once ($_SERVER['DOCUMENT_ROOT'].'/model/db.php'); //require $_SERVER['DOCUMENT_ROOT'] /model/db.php';

require ($_SERVER['DOCUMENT_ROOT'].'/model/model.php');
//fonctiosns helpers

function handleLoginAndRegistration() {
  if ( (!isset($_POST['btnInscription']))&&(!isset($_POST['btnEnvoiReponsesRecupMotDePasse']))&& (!isset($_SESSION['id']))&& (!isset($_POST['btnConnexion']))){
      locationView('accueil');
      exit();
  }
  var_dump($_POST);
  echo "<script>console.log('arrive dans inscription ligne17');</script>";
  if (isset($_POST['btnEnvoiReponsesRecupMotDePasse'])){
    if (allChampsNecessaryPresents($_POST,'reponsesQuestionForRecupMotDePasse')){
    }
  }
  if  (isset($_POST['btnConnexion'])){
    if (allChampsNecessaryPresents($_POST,'connexion')){
        $datas=trimDataForConnexion($_POST);
        $datas=protectData($datas);
        $result=areValidChamps($datas);
          if ($result["success"]==true){
          $result=verifExistInDb($datas);
          var_dump($result);
          if ($result["success"]==true){
              $userFound=$result["utilisateur"];
              $result=verifPassword($datas,$userFound);
              var_dump($result);
              if ($result["success"]==true){
                  $_SESSION['id'] = $result['utilisateur']['id'];
                  $_SESSION['pseudo'] = $result['utilisateur']['pseudo'];
                  $_SESSION['role'] = $result['utilisateur']['role'];
                  locationView('gestion_evenements');
                  exit();
          }

              else {
                      $phrase=$result["phraseEchec"];

                      }
              } else {
                  $phrase=$result["phraseEchec"];
              }
    }
  }

  if (isset($_POST['btnInscription'])){

echo "<script>console.log('arrive dans inscription ligne42');</script>";
     if (allChampsNecessaryPresents($_POST,'inscription')){
      //  var_dump($_POST);
        $datas=trimDataForInscription($_POST);
        $datas=protectData($datas);
        $result=areValidChamps($datas);
        echo "<script>console.log('arrive dans inscription ligne50');</script>";
        if ($result["success"]==true){
          $result=verifExistInDb($datas);
            echo "<script>console.log('arrive dans inscription ligne53');</script>";
          // var_dump($result);
          
         

          if ($result["success"]==false){
                $result=InsertInBD($datas); 
            } else {
                 $phrase=$result["data"];
                 echo $phrase;
            }

          } else {
          $phrase=$result["phraseEchec"];
          }

        

          if (isset($_SESSION['id_utilisateur'])) {
            echo "<script>console.log('arrive dans inscription ligne72');</script>";

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
      // locationView('accueil');
      exit();

    } 

    if (isset($_POST['actionPage'])){
       handleActionAccueil();
    }

   // Si l'utilisateur est connecté
    // Afficher le dashboard ou gérer les actions envoyées
} else { 
  echo "<script>console.log('arrive dans inscription ligne123');</script>";
   // Si l'utilisateur n'est pas connecté
    handleLoginAndRegistration();
}




// function handleActionAccueil() {


       
// }

    

?>