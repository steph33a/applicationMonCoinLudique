
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// echo "<script>console.log('arrive dans inscription ligne6');</script>";
   var_dump($_POST);
  //  var_dump($_SESSION);
// // session_destroy();
include_once ($_SERVER['DOCUMENT_ROOT'].'/model/db.php'); //require $_SERVER['DOCUMENT_ROOT'] /model/db.php';

require ($_SERVER['DOCUMENT_ROOT'].'/model/model.php');
//fonctiosns helpers
 
function handleLoginAndRegistration() {
   echo"ligne17";
  if ((!isset($_POST['btnAdminLoginAsUser']))&&(!isset($_POST['btnInscription']))&&(!isset($_POST['btnEnvoiReponsesRecupMotDePasse']))&& (!isset($_SESSION['id']))&& (!isset($_POST['btnConnexion']))){
     
    if (isset($_POST['researchAllEvent'])){
      echo "ligne21controller";
      $events=selectAllEvents();
      if (!$events) {
          $events=["pas d'evenement"];
        }
        $_SESSION['list_evenements'] = $events;
        $_SESSION["refresh"]=true;
        locationView('accueil');
        exit();

      } else {
        $_SESSION["refresh"]=true;
        locationView('accueil');
        exit();
      }
  }
  // echo "ligne20 controller";
//   var_dump($_POST);
//  var_dump($_SESSION);
  // var_dump($_POST);
  // echo "<script>console.log('arrive dans inscription ligne17');</script>";
  if ( isset($_POST['btnEnvoiReponsesRecupMotDePasse'])){
    // echo"ligne23 controller";
    // var_dump($_POST);
     $result=allChampsNecessaryPresents($_POST,'reponsesQuestionForRecupMotDePasse');
    if ($result["success"]==true){ 
      $champNecessaryPresents=$result["champNecessaryPresents"];
   
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
          $_SESSION["refresh"]=true;
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
      $result=allChampsNecessaryPresents($_POST,'btnRedefinitionMotDePasse');
    if ($result["success"]==true){ 
      $champNecessaryPresents=$result["champNecessaryPresents"];
      $datas=trimData($_POST);
      $datas=protectData($datas);
      //verif exist in db va rechercher dans la bd si l'utilisateur existe ou non suivant le mail si il existe
      $result=verifExistInDb($datas);
      // var_dump($result);
      if (is_array($result) && isset($result["success"]) && $result["success"] === true){
      modificationMotDePasse($datas); 
      $_SESSION["refresh"]=true;

       locationView('gestion_evenements');
     
      }
      else {
        $phrase=$result["phraseEchec"];
      }
    }
  }

  if  (isset($_POST['btnConnexion'])){
    // echo "ligne 88 controller";
     $result=allChampsNecessaryPresents($_POST,'connexion');
    if ($result["success"]==true){ 
      $champNecessaryPresents=$result["champNecessaryPresents"];
  
   
      // echo "ligne 89 controller/n";
        $datas=trimData($_POST);
        $datas=protectData($datas);
        $result=areValidChamps($datas,$champNecessaryPresents);
        // var_dump($result);
        // echo"lignes 93 controller";
          if ($result["success"]==true){
            // echo"ligne 94 controller";
          $result=verifExistInDb($datas);
          //  var_dump($result);
          //  echo"ligne97 controller";

            if ($result["success"]==true){
                $userFound=$result["utilisateur"];
                $result=verifPassword($datas,$userFound);
                // echo"lignes 97 controller";
                  // var_dump($result);
                if ($result["success"]==true){
                    //  var_dump($result);
                    $_SESSION['id_utilisateur'] = $result['utilisateur']['id_utilisateur'];
                    $_SESSION['pseudo'] = $result['utilisateur']['pseudo'];
                    $_SESSION['role'] = $result['utilisateur']['role'];
                    session_write_close();
                    $_SESSION["refresh"]=true;
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
if (isset($_POST['btnAdminLoginAsUser']) && $_SESSION['role'] === 'admin') {
  // var_dump($_POST);
     $_SESSION['role'] = 'particulier';
       $result=allChampsNecessaryPresents($_POST,'connexionAdminAsUser');
    if ($result["success"]==true){ 
      $champNecessaryPresents=$result["champNecessaryPresents"];
  
        $datas=trimData($_POST);
        $datas=protectData($datas);
        $result=areValidChamps($datas,$champNecessaryPresents);
          if ($result["success"]==true){

          $result=verifExistInDb($datas);
          //  var_dump($result);
            if ($result["success"]==true){
                $userFound=$result["utilisateur"];
               
                $_SESSION['id_utilisateur'] = $result['utilisateur']['id_utilisateur'];
                $_SESSION['pseudo'] = $result['utilisateur']['pseudo'];
                $_SESSION['role'] = $result['utilisateur']['role'];
                $_SESSION["refresh"]=true;
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
    


    // Traiter la connexion en tant qu’un autre utilisateur

// var_dump($_SESSION);
// var_dump($_POST);
  if (isset($_POST['btnInscription'])){

    $roleDemande  = htmlspecialchars(trim($_POST['role'] ?? 'particulier'));
    $roleSession = $_SESSION['role'] ?? null;
    if ($roleSession === 'admin') {
    $_POST['role'] = $roleDemande;
} else {
   if ($roleDemande === 'particulier' || $roleDemande === 'groupe') {
       $_POST['role'] = $roleDemande;
    } else {
        $_POST['role'] = 'particulier'; // sécurité par défaut
    }
}
    $file=$_FILES['imageProfil'];
    // echo"ligne195";
    // echo "<script>console.log('arrive dans inscription ligne50');</script>";
    if (isset($file)) {
             $_POST["imageProfil"]="exist";
      }

   $result=allChampsNecessaryPresents($_POST,'inscription');
    if ($result["success"]==true){ 
      $champNecessaryPresents=$result["champNecessaryPresents"];
// "echo inscription";
//  echo "<script>console.log('arrive dans inscription ligne42');</script>";
    
      //  var_dump($_POST);
      //  echo"ligne217";
      // var_dump($_FILES);
     
   if (isset($file)) {
           $result=verificationImageProfil();
           if ($result["success"] === false){
             $phrase=$result["phraseEchec"];
             echo $phrase;
           } else {
             $cheminTemporaireServeur=$result["cheminTemporaireServeur"];
             $fileOriginalName=$result["fileOriginalName"];
             $fileSize=$result["fileSize"];
             
            //  echo"228".$fileOriginalName;
            //  echo"229".$cheminTemporaireServeur;
            //  echo"230".$fileSize;
           }
     
      }
      // echo "ligne240";
   
        $datas=trimData($_POST);
        $datas=protectData($datas);
        $result=areValidChamps($datas,$champNecessaryPresents);
        //  echo "<script>console.log('arrive dans inscription ligne50');</script>";
        if ($result["success"]==true){
          $result=verifExistInDb($datas);
            //  echo "<script>console.log('arrive dans inscription ligne53');</script>";
          //  var_dump($result);
          // echo"true";
          
         

          if ($result["success"]==false){
                $result=insertInBD($datas);
                var_dump($result); 

            if ($result["success"]==true){
            
                $id_utilisateur=$_SESSION['id_utilisateur'];

                 $file=$_FILES['imageProfil'];
                echo"ligne220";
                var_dump($file);
                if (isset($file)) {
                    $result=enregistrementImageProfil($id_utilisateur,$cheminTemporaireServeur,$fileOriginalName);
                    if ($result["success"] === false){

                      $phrase=$result["phraseEchec"];
                    } else {
                      
                      $datas["imageEvent"]=$result["webPath"];

                      // echo"228".$datas["imageEvent"];
                      sendImageProfilInBd($_SESSION['id_utilisateur'],$datas["imageEvent"]);
                      $_SESSION["refresh"]=true;
                      locationView('gestion_evenements');

                      exit();

                    }
                    
              
      }
                // echo "reussite";

            } else {
                 $phrase=$result["data"];
                //  echo $phrase;
            }

          } else {
          $phrase=$result["phraseEchec"];
          }

        // var_dump($_SESSION);

          if (isset($_SESSION['id_utilisateur'])) {
            // echo "<script>console.log('arrive dans inscription ligne72');</script>";
$_SESSION["refresh"]=true;
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

 if (isset($_POST['btnResearchAllProfilInfosForThisUser'])) {

  $id_utilisateur=$_SESSION['id_utilisateur'];
  $utilisateur=selectAllInfosUtilisateurById($id_utilisateur);
  $_SESSION['utilisateur'] = $utilisateur;
  $_SESSION["refresh"]=true;
  locationView('monCompte');
  exit();
 }

 if (isset($_POST['actionModifierParametresCompte'])) {

  $id_utilisateur=$_SESSION['id_utilisateur'];
  
  $parametresComptes=trimData($_POST);
  $parametresComptes=protectData($parametresComptes);
  $result=parametresCompteCorrects($parametresComptes);
  if ($result["success"]==true){
    
    $result=getChampsDifférentsParRapportBD($parametresComptes,$id_utilisateur);
      if ($result["success"]==true){
        $champsToUpdate=$result["champsToUpdate"];

        $result=whichCategoryForInsertionInBD($id_utilisateur,$champsToUpdate);
        $result=updateInBdUtilisateur($id_utilisateur,$result["champsUtilisateur"]);
        $result=updateInBdProfil($id_utilisateur,$result["champsPasswordRecup"]);

        
        // $nomsChamps = array_keys($result["champs"]);
        

      } else {
        $phrase=$result["phraseEchec"];
        echo $phrase;
      }
  } else {
    $phrase=$result["phraseEchec"];
    echo $phrase;
  }

 
  
  $_SESSION['utilisateur'] = $utilisateur;
  $_SESSION["refresh"]=true;
  locationView('monCompte');
  exit();
 }
 if (isset($_POST['researchAllEvent'])){
 
$events=selectAllEvents();
 if (!$events) {
    $events=["pas d'evenement"];
   }
  $_SESSION['list_evenements'] = $events;
  $_SESSION["refresh"]=true;
  locationView('accueil');
  exit();

 }
 if (isset($_POST['researchAllEventForThisUser'])){

  $id_organisateur=$_SESSION['id_utilisateur'];
   $events=findAllEventsByOrganisateurId($id_organisateur);
   if (!$events) {
    $events=["pas d'evenement"];
   }
 
   $_SESSION['list_evenements'] = $events;
   $_SESSION["refresh"]=true;
  locationView('gestion_evenements');
  exit();
 }
 if (isset($_POST['researchAllInscriptionsForThisUser'])){
  $id_inscrit=$_SESSION['id_utilisateur'];
   $events=findAllEventsByParticipantId($id_inscrit);
    if (!$events) {
    $events=["pas d'evenement"];
   }
  $_SESSION['list_evenements'] = $events;
   $_SESSION["refresh"]=true;
  locationView('accueil');
  exit();
 }

  if (isset($_POST['btnCreationEvenement'])) {

    $file=$_FILES['imageEvent'];
    // echo"ligne195";
    // echo "<script>console.log('arrive dans inscription ligne50');</script>";
    if (isset($file)) {
             $_POST["imageEvent"]="exist";
      }
    //  var_dump($_POST);
    $result=allChampsNecessaryPresents($_POST,'creationEvenement');
    if ($result["success"]==true){ 
      $champNecessaryPresents=$result["champNecessaryPresents"];
      // var_dump($champNecessaryPresents);
      if (isset($_POST['typeSoiree'])) {
        $_POST['typeSoiree'] = $_POST['typeSoiree'][0];
      } 

     echo"ligne201";
      // var_dump($_FILES);
 
      $datas=trimData($_POST);
      $datas=protectData($datas);
       echo "ligne310";
      // var_dump($datas);
      $result=areValidChamps($datas,$champNecessaryPresents);
      var_dump($result);
      //  echo "<script>console.log('arrive dans inscription ligne50');</script>";
      if ($result["success"]==true){
        echo "401";
             $file=$_FILES['imageEvent'];
    //  var_dump($file);
  
      if (isset($file)) {
           $result=enregistrementImageEvent();
           if ($result["success"] === false){
             $phrase=$result["phraseEchec"];
           } else {
             $datas["imageEvent"]=$result["webPath"];
           }
     
      }
      echo "reussite";
        $result=verifyExistInBDEvenement($datas,$_SESSION['id_utilisateur']);
         echo "328".$result["success"];
        if ($result["success"]==false)
        {
      
          $result=insertEvenementInBD($datas,$_SESSION['id_utilisateur']); 
          $_SESSION["refresh"]=true;
            // echo "reussite";
          locationView('gestion_evenements');
          exit();
           } else {
          $phrase=$result["phraseEchec"];
          $_SESSION["refresh"]=true;
          locationView('gestion_evenements');
           exit();
                  //  echo $phrase;
           }
        }
        else {
          $phrase=$result["phraseEchec"];
          $_SESSION["refresh"]=true;
          locationView('gestion_evenements');
          exit();
        }
       
    }
  }
  else if (isset($_POST['btnaction_evenement'])) {
    var_dump($_POST);
    var_dump($_SESSION);
    $id_evenement=$_POST['id_evenement'];
    $id_organisateur=$_SESSION['id_utilisateur'];
    $event=findAllInfosEvent($id_organisateur,$id_evenement);
    var_dump($event);
   if (!$event) {
    $event=["pas d'evenement"];
   }
 
$_SESSION['evenementSelectedSpecial'] = $event;
   $_SESSION["refresh"]=true;
  locationView('actions_evenement');
  exit();
  }
  else if (isset($_POST['btnModificationEvenement'])) {
    
  }
  else if (isset($_POST['btnSuppressionEvenement'])) {
    
  }
   

  else if  (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        // echo "ligne182";
        if (isset($_POST['btnInscription'])||isset($_POST['btnAdminLoginAsUser'])||isset($_POST['btnRedefinitionMotDePasse'])||isset($_POST['btnDeconnexion'])){
            //  echo "ligne185";
          handleLoginAndRegistration();
        }
        else {
          $_SESSION["refresh"]=true;
           locationView('gestion_evenements');
          exit();
        }
         
  }
  
  else {
$_SESSION["refresh"]=true;
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