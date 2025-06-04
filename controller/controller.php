
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
  else if ( isset($_POST['btnEnvoiReponsesRecupMotDePasse'])){
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
  
  else if (isset($_POST['btnRedefinitionMotDePasse'])){
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

  else if (isset($_POST['btnConnexion'])){
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
  else if (isset($_POST['btnAdminLoginAsUser']) && $_SESSION['role'] === 'admin') {
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
  else if (isset($_POST['btnInscription'])){
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
    if (!empty($_FILES['imageEvent']['tmp_name'])) {
  // un fichier a bien été uploadé
    }

    $result=allChampsNecessaryPresents($_POST,'inscription');
    if ($result["success"]==true){ 
      $champNecessaryPresents=$result["champNecessaryPresents"];
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
   
      $datas=trimData($_POST);
      $datas=protectData($datas);
      $result=areValidChamps($datas,$champNecessaryPresents);
        //  echo "<script>console.log('arrive dans inscription ligne50');</script>";
        if ($result["success"]==true){
          $result=verifExistInDb($datas);

          if ($result["success"]==false){
            $result=insertInBD($datas);
            var_dump($result); 

            if ($result["success"]==true){
              $id_utilisateur=$result["id_utilisateur"];
              $file=$_FILES['imageProfil'];

              echo"ligne220";
              var_dump($file);
              if (!empty($_FILES['imageEvent']['tmp_name'])) {
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
        
        } else {
            $phrase=$result["phraseEchec"];
        }
    } else {
        $phrase=$result["phraseEchec"];
    }
  }
  else {
    
  $_SESSION["refresh"]=true;
  locationView('accueil');
  $_SESSION["phraseEchec"]=$phrase;
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

if (!isset($_SESSION['id_utilisateur'])) {
    handleLoginAndRegistration();
    exit();
}

$action = $_POST['action'] ?? null;

switch ($action) {
    case 'btnResearchAllProfilInfosForThisUser':
        handleResearchUserProfile();
        break;

    case 'btnResearchAllInfosOfAllUsers':
        handleResearchAllUsers();
        break;

    case 'actionModifierParametresCompte':
        handleAccountSettingsUpdate();
        break;

    case 'researchAllEvent':
        handleResearchAllEvents();
        break;

    case 'researchAllEventForThisUser':
        handleResearchEventsByUser();
        break;

    case 'researchAllInscriptionsForThisUser':
        handleResearchUserInscriptions();
        break;

    case 'btnCreationEvenement':
        handleEventCreation();
        break;

    case 'btnaction_evenement':
        handleEventActionView();
        break;

    case 'btnModificationEvenement':
        handleEventModification();
        break;

    case 'btnSuppressionEvenement':
        handleEventDeletion();
        break;

    default:
        handleDefaultOrAdminFallback();
        break;
}

exit();

/**
 * Fonctions pour gérer chaque action
 */

  
function handleResearchUserProfile() {
    if (!isset($_SESSION['id_utilisateur'])) {
        handleLoginAndRegistration();
        exit();
    }

    $id_utilisateur = $_SESSION['id_utilisateur'];
    $utilisateur = selectAllInfosUtilisateurById($id_utilisateur);
    $_SESSION['utilisateur'] = $utilisateur;
    $_SESSION["refresh"] = true;

    if ($_POST['page_contexte'] === 'gestion_utilisateurs') {
        locationView('gestion_utilisateurs');
        exit();
    } else if ($_POST['page_contexte'] === 'monCompte') {
        locationView('monCompte');
        exit();
    }
}

function handleResearchAllUsers() {
    if (!isset($_SESSION['id_utilisateur'])) {
        handleLoginAndRegistration();
        exit();
    }

    $list_utilisateurs = selectAllInfosUtilisateurs();
    $_SESSION['list_utilisateurs'] = $list_utilisateurs;
    $_SESSION["refresh"] = true;

    // Si besoin, décommenter et adapter pour redirection
    // if ($_POST['page_contexte'] === 'gestion_utilisateurs') {
    //    locationView('gestion_utilisateurs');
    //    exit();
    // }
}

 
function handleAccountSettingsUpdate() {
    if (!isset($_SESSION['id_utilisateur'])) {
        handleLoginAndRegistration();
        exit();
    }

    $id_utilisateur = $_SESSION['id_utilisateur'];
    $parametresComptes = trimData($_POST);
    $parametresComptes = protectData($parametresComptes);

    $result = parametresCompteCorrects($parametresComptes);
    if ($result["success"] == true) {
        $result = getChampsDifférentsParRapportBD($parametresComptes, $id_utilisateur);
        if ($result["success"] == true) {
            $champsToUpdate = $result["champsToUpdate"];
            $result = whichCategoryForInsertionInBD($id_utilisateur, $champsToUpdate);
            $result = updateInBdUtilisateur($id_utilisateur, $result["champsUtilisateur"]);
            $result = updateInBdProfil($id_utilisateur, $result["champsPasswordRecup"]);

            $utilisateur = selectAllInfosUtilisateurById($id_utilisateur);
            $_SESSION['utilisateur'] = $utilisateur;
            $_SESSION["refresh"] = true;

        } else {
            echo $result["phraseEchec"];
            exit();
        }
    } else {
        echo $result["phraseEchec"];
        exit();
    }

    locationView('monCompte');
    exit();
}


function handleResearchAllEvents() {
    if (!isset($_SESSION['id_utilisateur'])) {
        handleLoginAndRegistration();
        exit();
    }

    $events = selectAllEvents();
    if (!$events) {
        $events = ["pas d'evenement"];
    }
    $_SESSION['list_evenements'] = $events;
    $_SESSION["refresh"] = true;

    if ($_POST['page_contexte'] == "accueil") {
        locationView('accueil');
        exit();
    } else if ($_POST['page_contexte'] == "gestion_evenements") {
        locationView('gestion_evenements');
        exit();
    }
}


function handleResearchEventsByUser() {
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
    $_SESSION["refresh"] = true;

    if ($_POST['page_contexte'] == "accueil") {
        locationView('accueil');
        exit();
    } else if ($_POST['page_contexte'] == "gestion_evenements") {
        locationView('gestion_evenements');
        exit();
    }
}


function handleResearchUserInscriptions() {
    if (!isset($_SESSION['id_utilisateur'])) {
        handleLoginAndRegistration();
        exit();
    }

    $id_inscrit = $_SESSION['id_utilisateur'];
    $events = findAllEventsByParticipantId($id_inscrit);

    if (!$events) {
        $events = ["pas d'evenement"];
    }

    $_SESSION['list_evenements'] = $events;
    $_SESSION["refresh"] = true;

    locationView('accueil');
    exit();
}

 
function handleEventCreation() {
    if (!isset($_SESSION['id_utilisateur'])) {
        handleLoginAndRegistration();
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
                    echo $result["phraseEchec"];
                    exit();
                } else {
                    $datas["imageEvent"] = $result["webPath"];
                }
            }

            $result = verifyExistInBDEvenement($datas, $_SESSION['id_utilisateur']);
            if ($result["success"] == false) {
                insertEvenementInBD($datas, $_SESSION['id_utilisateur']);
                $_SESSION["refresh"] = true;
                locationView('gestion_evenements');
                exit();
            } else {
                echo $result["phraseEchec"];
                $_SESSION["refresh"] = true;
                locationView('gestion_evenements');
                exit();
            }
        } else {
            echo $result["phraseEchec"];
            $_SESSION["refresh"] = true;
            locationView('gestion_evenements');
            exit();
        }
    } else {
        echo $result["phraseEchec"];
        $_SESSION["refresh"] = true;
        locationView('gestion_evenements');
        exit();
    }
}


function handleEventActionView() {
    if (!isset($_SESSION['id_utilisateur'])) {
        handleLoginAndRegistration();
        exit();
    }

    $id_evenement = $_POST['id_evenement'] ?? null;
    $id_organisateur = $_SESSION['id_utilisateur'];

    if (!$id_evenement) {
        echo "Événement non spécifié";
        locationView('actions_evenement');
        exit();
    }

    $event = findAllInfosEvent($id_organisateur, $id_evenement);
    if (!$event) {
        echo "pas d'evenement";
        locationView('actions_evenement');
        exit();
    }

    $_SESSION['evenementSelectedSpecial'] = $event;
    $_SESSION["refresh"] = true;
    locationView('actions_evenement');
    exit();
}

function handleEventModification() {
    // Tu peux y mettre la logique que tu souhaites, similaire aux autres fonctions
}

function handleEventDeletion() {
    // Idem pour la suppression, gérer la suppression d'un événement ici
}

function handleDefaultOrAdminFallback() {
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        if (isset($_POST['btnInscription']) || isset($_POST['btnAdminLoginAsUser']) || isset($_POST['btnRedefinitionMotDePasse']) || isset($_POST['btnDeconnexion'])) {
            handleLoginAndRegistration();
        } else {
            $_SESSION["refresh"] = true;
            locationView('gestion_evenements');
            exit();
        }
    } else {
        handleLoginAndRegistration();
        exit();
    }
}

?>