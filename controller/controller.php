
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// echo "<script>console.log('arrive dans inscription ligne6');</script>";

//  var_dump($_SESSION);
  // var_dump($_SESSION);
// // session_destroy();
include_once ($_SERVER['DOCUMENT_ROOT'].'/model/db.php'); //require $_SERVER['DOCUMENT_ROOT'] /model/db.php';

require ($_SERVER['DOCUMENT_ROOT'].'/model/model.php');
//fonctiosns helpers
 

      function handleInscription() {
         $_SESSION["refresh"] = "handleInscription";
    $roleDemande = htmlspecialchars(trim($_POST['role'] ?? 'particulier'));
    $roleSession = $_SESSION['role'] ?? null;

    if ($roleSession === 'admin') {
        $_POST['role'] = $roleDemande;
    } else {
        $_POST['role'] = in_array($roleDemande, ['particulier', 'groupe']) ? $roleDemande : 'particulier';
    }

    $file = $_FILES['imageProfil'] ?? null;
    $imageUpload = !empty($_FILES['imageEvent']['tmp_name']);

    $result = allChampsNecessaryPresents($_POST, 'inscription');
    if ($result["success"]) {
        $champNecessaryPresents = $result["champNecessaryPresents"];

        if ($file) {
            $verifImage = verificationImageProfil();
            if (!$verifImage["success"]) {
                $_SESSION["phraseEchec"] = $verifImage["phraseEchec"];
                redirectAccueil();
                return;
            }

            $cheminTemporaireServeur = $verifImage["cheminTemporaireServeur"];
            $fileOriginalName = $verifImage["fileOriginalName"];
        }

        $datas = protectData(trimData($_POST));
        $valid = areValidChamps($datas, $champNecessaryPresents);

        if ($valid["success"]) {
            $exist = verifExistInDb($datas);

            if (!$exist["success"]) {
                $insert = insertInBD($datas);
                if ($insert["success"]) {
                    $id_utilisateur = $insert["id_utilisateur"];
                    createRecupMotDePasse($id_utilisateur);

                    if ($imageUpload) {
                        $upload = enregistrementImageProfil($id_utilisateur, $cheminTemporaireServeur, $fileOriginalName);
                        if (!$upload["success"]) {
                            $_SESSION["phraseEchec"] = $upload["phraseEchec"];
                            redirectAccueil();
                            return;
                        }
                        sendImageProfilInBd($id_utilisateur, $upload["webPath"]);
                    }

                    $_SESSION["data_transferred_from_controller"] = true;
                    locationView('gestion_evenements');
                    exit();
                } else {
                    $_SESSION["phraseEchec"] = $insert["data"];
                }
            } else {
                $_SESSION["phraseEchec"] = $exist["phraseEchec"];
            }
        } else {
            $_SESSION["phraseEchec"] = $valid["phraseEchec"];
        }
    } else {
        $_SESSION["phraseEchec"] = $result["phraseEchec"];
    }

    redirectAccueil();
}
  

  
  function handleConnexion(){
          $_SESSION["refresh"] = "handleConnexion";
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
              $_SESSION["data_transferred_from_controller"]=true;
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
  

  function handleRedefinitionMotDePasse(){
          $_SESSION["refresh"] = "redefinitionMotDePasse";
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
      $_SESSION["data_transferred_from_controller"]=true;

       locationView('gestion_evenements');
     
      }
      else {
        $phrase=$result["phraseEchec"];
      }
    }
    
  }
  function handleRecupMotDePasse(){
    $_SESSION["refresh"] = "redefinitionMotDePasse";
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
            $_SESSION['modal']='redefinitionMotDePasse';
            $_SESSION['email']=$datas['email'];
            $_SESSION["refresh"] = "redefinitionMotDePasse";
            $_SESSION["data_transferred_from_controller"]=true;
              locationView('accueil');
              exit();
        }
        else if (($firstReponseInBD!=$datas["reponse1"])&&($secondReponseInBD!=$datas["reponse2"])){
          $phrase="Les reponses sont incorrectes";
        } else {
          $phrase="erreur";
        }
      }
    }
  }

//   var_dump($_POST);
//  var_dump($_SESSION);
  // var_dump($_POST);
  
 
  function handleAdminLoginAsUser(){
       if (!isset($_SESSION['id_utilisateur'])) {
        
        exit();
    }
    $_SESSION["refresh"] = "handleAdminLoginAsUser";
    if ($_SESSION['role'] === 'admin') {
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
          $_SESSION["data_transferred_from_controller"]=true;

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


  





/**
 * Fonctions pour gérer chaque action
 */

  

function handleResearchAllUsers() {

  $_SESSION["refresh"] = "handleResearchAllUsers";
    if (!isset($_SESSION['id_utilisateur'])) {
        
        exit();
    }
    if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
        
        exit();
    }
    // echo "arrive dans handleResearchAllUsers";

    $list_utilisateurs = selectAllInfosUtilisateurs();
    $_SESSION['list_utilisateurs'] = $list_utilisateurs;
    $_SESSION["data_transferred_from_controller"] = true;
         $_SESSION["modal"]="";

    // Si besoin, décommenter et adapter pour redirection
     if ($_POST['page_contexte'] === 'gestion_utilisateurs') {
         locationView('gestion_utilisateurs');
        exit();
     }
}

 


   function handleResearchAllEvents() {

  

    $events = selectAllEvents();
    if (!$events || empty($events)) {
        $events = ["pas d'evenement"];
    }

    $_SESSION['list_evenements'] = $events;
    $_SESSION["data_transferred_from_controller"] = true;
    $_SESSION["modal"] = "";
    $_SESSION["refresh"] = "handleResearchAllEvents";

    $pageContexte = $_POST['page_contexte'] ?? 'accueil';
  
    if ($pageContexte === "gestion_evenements") {
       if ((!isset($_SESSION['id_utilisateur'])) && ((!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'))){
         locationView('accueil');
        exit();
    } else{
        locationView('gestion_evenements');
    }
        
    } else {
       

        locationView('accueil');
    }
    
}




function handleResearchEventsByUser() {
   $_SESSION["refresh"] = "handleResearchEventsByUser";
    if (!isset($_SESSION['id_utilisateur'])) {
        handleLoginAndRegistration();
        exit();
    }

    $id_organisateur = $_SESSION['id_utilisateur'];
    $events = findAllEventsByOrganisateurId($id_organisateur);

    if (!$events) {
        $events = ["pas d'evenement"];
    }
   

    $_SESSION['list_evenements'] = $events;
    $_SESSION["data_transferred_from_controller"] = true;
     $_SESSION["modal"]="";
    if ($_POST['page_contexte'] == "accueil") {
        locationView('accueil');
        exit();
    } else if ($_POST['page_contexte'] == "gestion_evenements") {
        locationView('gestion_evenements');
        exit();
    }
}


function handleResearchUserInscriptions() {
   $_SESSION["refresh"] = "handleResearchUserInscriptions";
    if (!isset($_SESSION['id_utilisateur'])) {
        
        exit();
    }

    $id_inscrit = $_SESSION['id_utilisateur'];
    $events = findAllEventsByParticipantId($id_inscrit);

    if (!$events) {
        $events = ["pas d'evenement"];
    }

    $_SESSION['list_evenements'] = $events;
    $_SESSION["data_transferred_from_controller"] = true;
         $_SESSION["modal"]="";

    locationView('accueil');
    exit();
}


function handleEventCreation() {
   $_SESSION["refresh"] = "handleEventCreation";
    if (!isset($_SESSION['id_utilisateur'])) {
      
        exit();
    }

    if (!empty($_FILES['imageEvent']['tmp_name'])) {
        $_POST["imageEvent"] = "exist";
    }

    $result = allChampsNecessaryPresents($_POST, 'creationEvenement');
    if ($result["success"] == true) {
        $champNecessaryPresents = $result["champNecessaryPresents"];
        if (isset($_POST['typeSoiree'])) {
            $_POST['typeSoiree'] = $_POST['typeSoiree'][0];
        }

        $datas = trimData($_POST);
        $datas = protectData($datas);

        $result = areValidChamps($datas, $champNecessaryPresents);
        if ($result["success"] == true) {
            if (!empty($_FILES['imageEvent']['tmp_name'])) {
                $result = enregistrementImageEvent();
                if ($result["success"] === false) {
                    // echo $result["phraseEchec"];
                    exit();
                } else {
                    $datas["imageEvent"] = $result["webPath"];
                }
            }

            $result = verifyExistInBDEvenement($datas, $_SESSION['id_utilisateur']);
            if ($result["success"] == false) {
                insertEvenementInBD($datas, $_SESSION['id_utilisateur']);
                $_SESSION["data_transferred_from_controller"] = true;
                locationView('gestion_evenements');
                exit();
            } else {
                // echo $result["phraseEchec"];
                $_SESSION["data_transferred_from_controller"] = true;
                locationView('gestion_evenements');
                exit();
            }
        } else {
            // echo $result["phraseEchec"];
            $_SESSION["data_transferred_from_controller"] = true;
            locationView('gestion_evenements');
            exit();
        }
    } else {
      
        $_SESSION["data_transferred_from_controller"] = true;
             $_SESSION["modal"]="";
        locationView('gestion_evenements');
        exit();
    }
}


function handleEventActionView() {
   $_SESSION["refresh"] = "handleEventActionView";
    if (!isset($_SESSION['id_utilisateur'])) {
        locationView('accueil');
        exit();
    }

    $id_evenement = $_POST['id_evenement'] ?? null;
    $id_organisateur = $_SESSION['id_utilisateur'];

    if (!$id_evenement) {
        // echo "Événement non spécifié";
        locationView('actions_evenement');
        exit();
    }

    $event = findAllInfosEvent($id_organisateur, $id_evenement);
    if (!$event) {
        // echo "pas d'evenement";
        locationView('actions_evenement');
        exit();
    }

    $_SESSION['evenementSelected'] = $event;
    $_SESSION["data_transferred_from_controller"] = true;
         $_SESSION["modal"]="";
    locationView('actions_evenement');
    exit();
}

function handleEventModification() {
   $_SESSION["refresh"] = "handleEventModification";
  if (!isset($_SESSION['id_utilisateur'])) {
        locationView('accueil');
        exit();
    }

$result = allChampsNecessaryPresents($_POST, 'modificationEvenement');

// var_dump($result);
    if ($result["success"] == true) {
    $champNecessaryPresents = $result["champNecessaryPresents"];
   
    if (isset($_POST['typeSoiree'])) {
            $_POST['typeSoiree'] = $_POST['typeSoiree'][0];
   }

    $datasEvent = trimData($_POST);
    $datasEvent= enleverChampsVides($datasEvent);
    $id_evenement = $_POST['id_evenement'];
    $id_utilisateur = $_SESSION['id_utilisateur'];
    $datasEvent = trimData($datasEvent);
    $datasEvent = protectData($datasEvent);
    $result = parametresEventCorrects($id_utilisateur,$id_evenement,$datasEvent);
    $_SESSION["result"] = $result;

    // exit();
   
    if ($result["success"] == true) {
        $result = getChampsDifferentsParRapportBDEvent($id_utilisateur,$id_evenement,$datasEvent); 
        $_SESSION["result"] = $result;
       
      
        if ($result["success"] == true) {
            $champsToUpdate = $result["champsToUpdate"];

            $result = updateInBdEventUtilisateur($id_utilisateur,$id_evenement,$champsToUpdate);
             
            $event = findAllInfosEvent($id_utilisateur,$id_evenement);
          
            $_SESSION['evenementSelected'] = $event;
            $_SESSION["data_transferred_from_controller"] = true;
            $_SESSION["modal"]="";
             locationView('actions_evenement');

        } else {
            $_SESSION['result'] = "soucis dans les données";
            locationView('actions_evenement');
           
        } 
       
    } else {
        // echo $result["phraseEchec"];
        $_SESSION["data_transferred_from_controller"] = true;
        $_SESSION["modal"]="";
        
        
         locationView('actions_evenement');
    exit();
  

    }
    } else {
      
    }
    

    locationView('actions_evenement');
    exit();
  
    // Tu peux y mettre la logique que tu souhaites, similaire aux autres fonctions
}

function handleEventDeletion() {
  if (!isset($_SESSION['id_utilisateur'])) {
        locationView('accueil');
        exit();
    }
   $_SESSION["refresh"] = "handleEventDeletion";
  $id_evenement = $_POST['id_evenement'] ?? null;
    if (!$id_evenement) {
        // echo "Événement non spécifié";
        locationView('gestion_evenements');
        exit();
    }
  deleteThisEvent($id_evenement);
  unset($_SESSION["evenementSelected"]);
       $_SESSION["modal"]="";
  locationView('gestion_evenements');
  exit();

    // Idem pour la suppression, gérer la suppression d'un événement ici
}

// function handleDefaultOrAdminFallback() {
//     if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
//         if (isset($_POST['btnInscription']) || isset($_POST['btnAdminLoginAsUser']) || isset($_POST['btnRedefinitionMotDePasse']) || isset($_POST['btnDeconnexion'])) {
//             handleLoginAndRegistration();
//         } else {
//           // echo" ligne596 controller";
//             $_SESSION["data_transferred_from_controller"] = true;
//                  $_SESSION["modal"]="";
//             locationView('gestion_evenements');
//           exit();
//         }
//     } else {
//         handleLoginAndRegistration();
//         exit();
//     }
// }

function handleUserDeletion() {
 $_SESSION["refresh"] = "handleUserDeletion";
    // Idem pour la suppression, gérer la suppression d'un utilisateur ici
    $id_utilisateur = $_POST['id_utilisateur'] ?? null;
    
    if ((!$id_utilisateur) && $_SESSION["role"] != 'admin') {
        // echo "Utilisateur non spécifié";
        locationView('accueil');
        exit();
    }
    
    deletePasswordRecupByUser($id_utilisateur);
    deleteAllIscriptionsByUser($id_utilisateur); 
    deleteAllEventsByOrganisateur($id_utilisateur);
    deleteUser($id_utilisateur);
         $_SESSION["modal"]="";
    unset($_SESSION["utilisateur"]);
    locationView('gestion_utilisateurs');
    exit();
}


function handleEventDatasForThisEvent(){
  if (!isset($_SESSION['id_utilisateur'])) {
        locationView('accueil');
        exit();
    }
   $_SESSION["refresh"] = "handleEventDatasForThisEvent";
    $id_evenement = $_POST['id_evenement'] ?? null;
    $id_organisateur = $_SESSION['id_utilisateur'];

    if (!$id_evenement) {
        // echo "Événement non spécifié";
        locationView('actions_evenement');
        exit();
    }
    $event = findAllInfosEvent($id_organisateur, $id_evenement);
    if (!$event) {
        // echo "pas d'evenement";
        locationView('actions_evenement');
        exit();
    }
    $_SESSION['evenementSelectedSpecial'] = $event;
    $_SESSION["data_transferred_from_controller"] = true;
         $_SESSION["modal"]="";
    locationView('actions_evenement');
    exit();
}




function actionAdminModifierParametresCompteUtilisateur() {
   $_SESSION["refresh"] = "actionAdminModifierParametresCompteUtilisateur";
   if ((!$id_utilisateur) && $_SESSION["role"] != 'admin') {
        // echo "Utilisateur non spécifié";
        locationView('accueil');
        exit();
    }
     $_SESSION['action'] = 'modificationInformationsUtilisateur';
    $_SESSSON["modal"]="modalFormGestionUtilisateurInformationsUtilisateur";

    $id_utilisateur = $_POST['id_utilisateur'];
    $parametresComptes = trimData($_POST);
    $parametresComptes = enleverChampsVides($parametresComptes);
    $parametresComptes = protectData($parametresComptes);
    if (empty($parametresComptes["motDePasse"]) && empty($parametresComptes["confirmationMotDePasse"])) {
    unset($parametresComptes["motDePasse"], $parametresComptes["confirmationMotDePasse"]);
    }

    $result = parametresCompteCorrects($parametresComptes);
    // var_dump($result);
    if ($result["success"] == true) {
      // var_dump($result);
        $result = getChampsDifferentsParRapportBD($parametresComptes, $id_utilisateur);
        // var_dump($result);
        if ($result["success"] == true) {
            $champsToUpdate = $result["champsToUpdate"];
            $result = whichCategoryForInsertionInBD($id_utilisateur, $champsToUpdate);
            $resultUtilisateur = updateInBdUtilisateur($id_utilisateur, $result["champsUtilisateur"]);
            if ($result["champsPasswordRecup"]) {
              $test = verifyIfPasswordRecupExists($id_utilisateur);
              if ($test["success"] == false) {
                createRecupMotDePasse($id_utilisateur);
                
              } 
               $resultPasswordRecup = updateInBdProfil($id_utilisateur, $result["champsPasswordRecup"]);
            }
           

            $utilisateur = selectAllInfosUtilisateurById($id_utilisateur);
            $_SESSION['utilisateurSelected'] = $utilisateur;
            $utilisateurs =selectAllInfosUtilisateurs();
            $_SESSION['utilisateurs'] = $utilisateurs;
           
            $_SESSION["data_transferred_from_controller"] = true;
            $_SESSION["modal"]="";

        } else {
            $_SESSION['message'] = "soucis dans les données";
           
        } 
       $_SESSION['message'] = "soucis dans les données";
    }

     locationView('gestion_utilisateurs');
    exit();
}
function handleAccountSettingsUpdate() {
   $_SESSION["refresh"] = "handleAccountSettingsUpdate";
    if (!isset($_SESSION['id_utilisateur'])) {
        
        exit();
    }

    $id_utilisateur = $_SESSION['id_utilisateur'];
    $parametresComptes = trimData($_POST);
    $parametresComptes = protectData($parametresComptes);
    if (empty($parametresComptes["motDePasse"]) && empty($parametresComptes["confirmationMotDePasse"])) {
    unset($parametresComptes["motDePasse"], $parametresComptes["confirmationMotDePasse"]);
    }

    $result = parametresCompteCorrects($parametresComptes);
    // var_dump($result);
    if ($result["success"] == true) {
        $result = getChampsDifferentsParRapportBD($parametresComptes, $id_utilisateur);
        // var_dump($result);
        if ($result["success"] == true) {
            $champsToUpdate = $result["champsToUpdate"];
            $result = whichCategoryForInsertionInBD($id_utilisateur, $champsToUpdate);
            $resultUtilisateur = updateInBdUtilisateur($id_utilisateur, $result["champsUtilisateur"]);
            $resultPasswordRecup = updateInBdProfil($id_utilisateur, $result["champsPasswordRecup"]);

            $utilisateur = selectAllInfosUtilisateurById($id_utilisateur);
            foreach (['date_inscription', 'dateNaissance', 'statut_utilisateur'] as $colonne) {
              unset($utilisateur[$colonne]);
            }

            $_SESSION['utilisateur'] = $utilisateur;
            $_SESSION["data_transferred_from_controller"] = true;
                 $_SESSION["modal"]="";

        } else {
            $_SESSION['message'] = "soucis dans les données";
           
        } 
       $_SESSION['message'] = "soucis dans les données";
    }

    locationView('monCompte');
    exit();
}
function resarchAllInfosForUserSession() {
     if ((!$id_utilisateur)) {
        // echo "Utilisateur non spécifié";
        locationView('accueil');
        exit();
    }
   $_SESSION["refresh"] = "resarchAllInfosForUserSession";
 
    $id_utilisateur = $_SESSION['id_utilisateur'];
    $utilisateur = selectAllInfosUtilisateurById($id_utilisateur);
    $_SESSION['utilisateur'] = $utilisateur;
    $_SESSION["data_transferred_from_controller"] = true;
     $_SESSION["modal"]="";
  
    foreach (['date_inscription', 'dateNaissance', 'statut_utilisateur'] as $colonne) {
              unset($utilisateur[$colonne]);
            }
        locationView('monCompte');
        exit();
    exit();
    
}

 function resarchSectionUtilisateurForLecture(){
     if ((!$id_utilisateur) && $_SESSION["role"] != 'admin') {
        // echo "Utilisateur non spécifié";
        locationView('accueil');
        exit();
    }
   $_SESSION["refresh"] = "resarchSectionUtilisateurForLecture";
  $id_utilisateur = $_POST['id_utilisateur'] ?? null;
 $utilisateur = selectAllInfosUtilisateurById($id_utilisateur);
 $_SESSION["data_transferred_from_controller"] = true;
  $_SESSION["modal"]="modalFormGestionUtilisateurInformationsUtilisateur";
  $_SESSION['utilisateurSelected'] = $utilisateur;
  $_SESSION['action'] = 'lectureInformationsUtilisateur';
  locationView('gestion_utilisateurs');
  exit();
}
function handleVisionEvenement(){
   $_SESSION["refresh"] = "handleVisionEvenement";
  $id_evenement = $_POST['id_evenement'] ?? null;
  $evenement = selectAllInfosEvenementById($id_evenement);
  // var_dump($evenement);
 $_SESSION['evenementSelected'] = $evenement;
  
  $list_evenements = selectAllEvents();
  
  $_SESSION['list_evenements'] =  $list_evenements;
  $_SESSION["data_transferred_from_controller"] = true;
  $_SESSION["modal"]="visionEvenementAndInscription";
 
 
//    var_dump($evenement);
  $_SESSION['action'] = 'lectureInformationsEvenement';
 
   locationView('accueil');
   
}
function handleEventDesinscription(){
     if ((!$id_utilisateur) ) {
        // echo "Utilisateur non spécifié";
        locationView('accueil');
        exit();
    }
   $_SESSION["refresh"] = "handleEventDesinscription";
  $id_evenement = $_POST['id_evenement'] ?? null;
  $id_utilisateur = $_SESSION['id_utilisateur'];
  desinscriptionAtThisEvent($id_evenement,$id_utilisateur);
  // var_dump($evenement);
  $list_evenements = selectAllEvents();
  
  $_SESSION['list_evenements'] =  $list_evenements;
  $_SESSION["data_transferred_from_controller"] = true;
  $_SESSION["modal"]="visionEvenementAndInscription";
 
//    var_dump($evenement);
  $_SESSION['action'] = 'desinscriptionEvenement';
 
   locationView('accueil');
}
function handleEventInscription(){
     if ((!$id_utilisateur)) {
        // echo "Utilisateur non spécifié";
        locationView('accueil');
        exit();
    }
   $_SESSION["refresh"] = "handleEventInscription";
  $id_evenement = $_POST['id_evenement'] ?? null;
  $id_utilisateur = $_SESSION['id_utilisateur'];
  $nombreInscrits = $_POST['nbInscrits'] ?? null;
 inscriptionAtThisEvent($id_evenement,$id_utilisateur,$nombreInscrits);
  // var_dump($evenement);
  $list_evenements = selectAllEvents();
  
  $_SESSION['list_evenements'] =  $list_evenements;
  $_SESSION["data_transferred_from_controller"] = true;
  $_SESSION["modal"]="visionEvenementAndInscription";
 
//    var_dump($evenement);
  $_SESSION['action'] = 'inscriptionEvenement';
 
   locationView('accueil');
}
function resarchFormulaireUtilisateurForModification(){
     if ((!$id_utilisateur) && $_SESSION["role"] != 'admin') {
        // echo "Utilisateur non spécifié";
        locationView('accueil');
        exit();
    }
   $_SESSION["refresh"] = "resarchFormulaireUtilisateurForModification";
  $id_utilisateur = $_POST['id_utilisateur'] ?? null;
 $utilisateur = selectAllInfosUtilisateurById($id_utilisateur);
 $_SESSION["data_transferred_from_controller"] = true;
  $_SESSION["modal"]="modalFormGestionUtilisateurInformationsUtilisateur";
  $_SESSION['utilisateurSelected'] = $utilisateur;
  $_SESSION['action'] = 'modificationInformationsUtilisateur';
  locationView('gestion_utilisateurs');
  exit();
}
function handleRefreshAllEvents(){
 
  // var_dump($evenement);
  $list_evenements = selectAllEvents();
     if (!$events || empty($events)) {
        $events = ["pas d'evenement"];
    }
  $_SESSION['list_evenements'] =  $list_evenements;
  $_SESSION["data_transferred_from_controller"] = true;
  
 $id_evenementSelected = $_POST['id_evenementParticulier'] ?? null;
  if (isset($id_evenementSelected)&&($id_evenementSelected=="")) {
    unset($id_evenementSelected);
  }
   if (isset($id_evenementSelected)) {
    

  $evenement = selectAllInfosEvenementById($id_evenementSelected);
      // echo "Événement non spécifique";
      $_SESSION['evenementSelected'] = $evenement;
   $_SESSION["modal"]="visionEvenementAndInscription";
    $_SESSION["refresh"] = "refreshAllEventsAndEventSpecial";
  } else {
    unset ($_SESSION['evenementSelected']);
    $_SESSION["modal"]="";
       $_SESSION["refresh"] = "refreshAllEventsButNotEventSpecial";
  }
//    var_dump($evenement);
  $_SESSION['action'] = 'lectureInformationsEvenement';
 
  
    $pageContexte = $_POST['page_contexte'] ?? 'accueil';

    if ($pageContexte === "gestion_evenements") {
        locationView('gestion_evenements');
    } else {
        locationView('accueil');


    }
}
// Liste des boutons et fonctions associées
$actions = [
    'btnConnexion' => 'handleConnexion',
    'btnInscription' => 'handleInscription',
    'btnEnvoiReponsesRecupMotDePasse' => 'handleRecupMotDePasse',
    'btnRedefinitionMotDePasse' => 'handleRedefinitionMotDePasse',
    'btnAdminLoginAsUser' => 'handleAdminLoginAsUser',
    'researchAllEvent' => 'handleResearchAllEvents',
    'btnResearchAllProfilInfosForThisUser' => 'resarchAllInfosForUserSession',
    'btnResearchAllInfosOfAllUsers' => 'handleResearchAllUsers',
    'actionModifierParametresCompte' => 'handleAccountSettingsUpdate',
    'researchAllEvent' => 'handleResearchAllEvents',
    'researchAllEventForThisUser' => 'handleResearchEventsByUser',
    'researchAllInscriptionsForThisUser' => 'handleResearchUserInscriptions',
    'btnCreationEvenement' => 'handleEventCreation',
    'btnaction_evenement' => 'handleEventActionView',
    'btnModificationEvenement' => 'handleEventModification',
    'btnSuppressionEvenement' => 'handleEventDeletion',
    'btnDeleteUser' => 'handleUserDeletion',
    'btnGetSectionWithInformationUser' => 'resarchSectionUtilisateurForLecture',
    'btnGetFormulaireModificationUser' => 'resarchFormulaireUtilisateurForModification',
    'researchAllDataForThisEvent' => 'handleEventDatasForThisEvent',
    'actionAdminModifierParametresCompteUtilisateur' => 'actionAdminModifierParametresCompteUtilisateur',
    'btnVoirEvenement' => 'handleVisionEvenement',
    'btninscriptionEvent' => 'handleEventInscription',
    'btnDesinscriptionEvent'=>"handleEventDesinscription",
    'refreshAllEvents'=>"handleRefreshAllEvents",


    
];

// var_dump($_POST);
// Parcours des boutons attendus pour détecter celui qui a été soumis
$actionFound = false;
foreach ($actions as $btnName => $functionName) {
    if (isset($_POST[$btnName])) {
        $functionName();
        $actionFound = true;
        break; // on arrête dès qu'on a trouvé un bouton cliqué
    }
}
// var_dump(POST);
// exit();
// echo $actionFound;
if (!$actionFound) {
   $_SESSION["refresh"] = "accueilDebut";
   $_SESSION["modal"] = "";
    $_SESSION["data_transferred_from_controller"] = true;
     locationView('accueil');
    exit();
}

function redirectAccueil() {
    $_SESSION["data_transferred_from_controller"] = true;
    locationView('accueil');
    exit();
}
function includeView($viewName) {
    include($_SERVER['DOCUMENT_ROOT'] . "/vue/{$viewName}.php");
}



 function locationView($viewName) {
    $path =  "../vue/pages/{$viewName}.php";
    header("Location: $path");
    exit();
}
// if (!$actionFound) {
//     redirectAccueil();
// }

exit();

?>