
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// echo "<script>console.log('arrive dans inscription ligne6');</script>";
  var_dump($_POST);
  var_dump($_SESSION);
// // session_destroy();
include_once ($_SERVER['DOCUMENT_ROOT'].'/model/db.php'); //require $_SERVER['DOCUMENT_ROOT'] /model/db.php';

require ($_SERVER['DOCUMENT_ROOT'].'/model/model.php');
//fonctiosns helpers

function handleLoginAndRegistration() {
  
  if ( (!isset($_POST['btnInscription']))&&(!isset($_POST['btnEnvoiReponsesRecupMotDePasse']))&& (!isset($_SESSION['id']))&& (!isset($_POST['btnConnexion']))){
      locationView('accueil');
      exit();
  }
  // echo "ligne20 controller";
//   var_dump($_POST);
//  var_dump($_SESSION);
  // var_dump($_POST);
  // echo "<script>console.log('arrive dans inscription ligne17');</script>";
  if ( isset($_POST['btnEnvoiReponsesRecupMotDePasse'])){
    // echo"ligne23 controller";
    // var_dump($_POST);
    if (allChampsNecessaryPresents($_POST,'reponsesQuestionForRecupMotDePasse')){
      // echo"ligne26 controller";
     
      $datas=trimData($_POST);
      $datas=protectData($datas);
      $datas["reponse2"]=$datas["chanteurPrefereUser"];
      $datas["reponse1"]=$datas["jeuPrefereUser"];
      //verif exist in db va rechercher dans la bd si l'utilisateur existe ou non suivant le mail si il existe
      $result=verifExistInDb($datas);
      // var_dump($result);
     
      if (is_array($result) && isset($result["success"]) && $result["success"] === true){
          $id_utilisateur=$result["utilisateur"] ["id_utilisateur"];
        $result=importReponsesQuestions($id_utilisateur);

          $firstReponseInBD=$result["reponse1"];
          $firstReponseInBD=htmlspecialchars(trim($firstReponseInBD));
          $secondReponseInBD=$result["reponse2"];
          $secondReponseInBD=htmlspecialchars(trim($secondReponseInBD));
          if (($firstReponseInBD==$datas["reponse1"])&&($secondReponseInBD==$datas["reponse2"])){
            // echo "reussite";
            // var_dump($_SESSION);
          $_SESSION['redefinitionMotDePasse']=true;
          $_SESSION['email']=$datas['email'];
            locationView('accueil');
          

          }
        else if (($firstReponseInBD!=$datas["reponse1"])&&($secondReponseInBD!=$datas["reponse2"])){
          $phrase="Les reponses sont incorrectes";
        } else {
          $phrase="erreur";
        }
      }
    } else {
      echo "problème";
    }
  }
  if (isset($_POST['btnRedefinitionMotDePasse'])){
    // var_dump($_POST);
    if (allChampsNecessaryPresents($_POST,'redefinitionMotDePasse')){
      $datas=trimData($_POST);
      $datas=protectData($datas);
      //verif exist in db va rechercher dans la bd si l'utilisateur existe ou non suivant le mail si il existe
      $result=verifExistInDb($datas);
      // var_dump($result);
      if (is_array($result) && isset($result["success"]) && $result["success"] === true){
      modificationMotDePasse($datas); 
       locationView('gestion_evenements');
     
      }
      else {
        $phrase=$result["phraseEchec"];
      }
    }
  }

  if  (isset($_POST['btnConnexion'])){
    if (allChampsNecessaryPresents($_POST,'connexion')){
        $datas=trimData($_POST);
        $datas=protectData($datas);
        $result=areValidChamps($datas);
          if ($result["success"]==true){
          $result=verifExistInDb($datas);
          // var_dump($result);
            if ($result["success"]==true){
                $userFound=$result["utilisateur"];
                $result=verifPassword($datas,$userFound);
                //  var_dump($result);
                if ($result["success"]==true){
                    $_SESSION['id_utilisateur'] = $result['utilisateur']['id_utilisateur'];
                    $_SESSION['pseudo'] = $result['utilisateur']['pseudo'];
                    $_SESSION['role'] = $result['utilisateur']['role'];
                    session_write_close();
                    locationView('gestion_evenements');
                    exit();
                }

              else {
                      $phrase=$result["phraseEchec"];

                      }
              } else {
                  $phrase=$result["phraseEchec"];
              }
          } else {
              $phrase=$result["phraseEchec"];
          }
       }
    }

// var_dump($_SESSION);
// var_dump($_POST);
  if (isset($_POST['btnInscription'])){
// "echo inscription";
//  echo "<script>console.log('arrive dans inscription ligne42');</script>";
     if (allChampsNecessaryPresents($_POST,'inscription')){
      //  var_dump($_POST);
      echo"ligne201";
      var_dump($_FILES);
      $file=$_FILES['imageProfil'];
      var_dump($file);
      if (isset($file)) {
           enregistrementImageProfil();
    
     
      }
   
        $datas=trimData($_POST);
        $datas=protectData($datas);
        $result=areValidChamps($datas);
        //  echo "<script>console.log('arrive dans inscription ligne50');</script>";
        if ($result["success"]==true){
          $result=verifExistInDb($datas);
            //  echo "<script>console.log('arrive dans inscription ligne53');</script>";
          //  var_dump($result);
          
         

          if ($result["success"]==false){
                $result=insertInBD($datas); 
                echo "reussite";

            } else {
                 $phrase=$result["data"];
                //  echo $phrase;
            }

          } else {
          $phrase=$result["phraseEchec"];
          }

        var_dump($_SESSION);

          if (isset($_SESSION['id_utilisateur'])) {
            // echo "<script>console.log('arrive dans inscription ligne72');</script>";

          locationView('gestion_evenements');

          exit();

          }

          } 
        // ici affichage également du modal d'inscription
      
        }
      

      // if (isset($_POST['btnDeconnexion'])) {
      //     session_destroy();
      //     locationView('accueil');
      //     exit();
      // }
  }

  
function includeView($viewName) {
    include($_SERVER['DOCUMENT_ROOT'] . "/vue/{$viewName}.php");
}



 function locationView($viewName) {
    $path =  "../vue/pages/{$viewName}.php";
    header("Location: $path");
    exit();
}




if (isset($_SESSION['id_utilisateur'])) { 


  if (isset($_POST['btnCreationEvenement'])) {
    echo"ligne195";
    // echo "<script>console.log('arrive dans inscription ligne50');</script>";

    var_dump($_POST);
   
    if (allChampsNecessaryPresents($_POST,'creationEvenement')) {
      if (isset($_POST['typeSoiree'])) {
        $_POST['typeSoiree'] = $_POST['typeSoiree'][0];
      } 

      echo"ligne201";
      var_dump($_FILES);
      $file=$_FILES['imageEvent'];
      var_dump($file);
      if (isset($file)) {
        enregistrementImageEvent();
      }
      $datas=trimData($_POST);
      $datas=protectData($datas);
      $result=areValidChamps($datas);
      //  echo "<script>console.log('arrive dans inscription ligne50');</script>";
      if ($result["success"]==true){
        $result=verifyExistInBDEvenement($datas);
        if ($result["success"]==false)
        {
          $result=insertEvenementInBD($datas); 
            echo "reussite";
          // locationView('gestion_evenements');
          exit();
           } else {
          $phrase=$result["phraseEchec"];
                  //  echo $phrase;
           }
        }
       
    }
  }
  else if (isset($_POST['btnModificationEvenement'])) {
    
  }
  else if (isset($_POST['btnSuppressionEvenement'])) {
    
  }
   

  else if  (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        // echo "ligne182";
        if (isset($_POST['btnInscription'])||isset($_POST['btnConnexion'])||isset($_POST['btnRedefinitionMotDePasse'])||isset($_POST['btnDeconnexion'])){
            //  echo "ligne185";
          handleLoginAndRegistration();
        }
        else {
          locationView('gestion_evenements');
          exit();
        }
         
  }
  
  else {

    locationView('gestion_evenements');
      exit();
   
  }
   // Si l'utilisateur est connecté
    // Afficher le dashboard ou gérer les actions envoyées
} 


else { 
  // echo "<script>console.log('arrive dans inscription ligne123');</script>";
   // Si l'utilisateur n'est pas connecté
    handleLoginAndRegistration();
}




// function handleActionAccueil() {


       
// }

    
// if ((( isset($_GET['page']) && $_GET['page'] == 'gestion_evenements')) || (!isset($_POST['actionPage']))){
//       // locationView('accueil');
//       exit();

//     } 

//     if (isset($_POST['actionPage'])){
//        handleActionAccueil();
//     }
?>