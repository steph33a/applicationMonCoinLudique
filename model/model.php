<?php
include_once 'db.php';
 global $connexion_bd;


function isValidPassword($password) {
    // Vérifier la longueur du mot de passe (min 8 caractères)
    if (strlen($password) < 8) {
        return false;
    }

    // Vérifier si le mot de passe contient au moins une majuscule
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }

    // Vérifier si le mot de passe contient au moins une minuscule
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }

    // Vérifier si le mot de passe contient au moins un chiffre
    if (!preg_match('/\d/', $password)) {
        return false;
    }

    // Vérifier si le mot de passe contient au moins un caractère spécial
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        return false;
    }

    // Si toutes les conditions sont remplies
    return true;
}

function champIsValid($nomChamp,$valeurChamp)
{
    switch ($nomChamp) {
            case 'pseudo':
                if (strlen($valeurChamp) < 3) {
                    return  [
                        "success" => false,
                        "phraseEchec" => "Le pseudo doit contenir au moins 3 caractères"
                    ];
                } else {
                  return  [
                    "success" => true,
                    "phraseEchec" => ""
                  ];
                }
                break;
            
            case 'nom':
                if (strlen($valeurChamp) < 3) {
                    return  [
                        "success" => false,
                        "phraseEchec" => "Le nom doit contenir au moins 3 caractères"
                    ];
                } else {
                  return  [
                    "success" => true,
                    "phraseEchec" => ""
                  ];
                }
                break;
            case 'prenom':
                if (strlen($valeurChamp) < 3) {
                    return  [
                        "success" => false,
                        "phraseEchec" => "Le prenom doit contenir au moins 3 caractères"
                    ];
                } else {
                  return  [
                    "success" => true,
                    "phraseEchec" => ""
                  ];
                }
                break;
            
            case 'email':
                
                   if (strpos($valeurChamp, '@') === false || strpos($valeurChamp, '.') === false) {
                    
                   return  [
                    "success" => false,
                    "phraseEchec" => "mail incorrect"
                   ];
                } else {
                  return  [
                    "success" => true,
                    "phraseEchec" => ""
                  ];
                }
                break;
            case 'motDePasse':
                    if (!isValidPassword($valeurChamp)) {
                    return  [
                        "success" => false,
                        "phraseEchec" => "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère special"
                    ];
                } else {
                  return  [
                    "success" => true,
                    "phraseEchec" => ""
                  ];
                }
          
                break;
            default:
              return  [
                    "success" => true,
                    "phraseEchec" => ""
                  ];

                break;
        }       
}
    
function allChampsNecessaryPresents($datas,$fonctionnalite)
{
 if ($fonctionnalite=="inscription") {
    $champNecessary=["pseudo","email","motDePasse","confirmationMotDePasse"];


 }
 if ($fonctionnalite=="connexion") {
    $champNecessary=["email","motDePasse"];
 }
 if ($fonctionnalite=="reponsesQuestionForRecupMotDePasse") {
    $champNecessary=["email","reponse1","reponse2"];
 }
 if ($fonctionnalite=="createEvent") {
    $champNecessary=["pseudo","dateEvent","heureEvent"];
 }

    

  foreach ($champNecessary as $champ) {
        if (!isset($datas[$champ]) || empty($datas[$champ])) {
            return false;
        }
    }
    return true;
}
function areValidChamps($datas)
{
    $areValidChamps=[];
    
    $phraseEchec=[]; 
    foreach ($datas as $nomChamp => $valeurChamp) {
        
        $isValidChamp=champIsValid($nomChamp,$valeurChamp);
        $areValidChamps[]=$isValidChamp["success"];
        if ($isValidChamp["success"]==false) {
            $phraseEchec[]=$isValidChamp["phraseEchec"];
        } 

    }
     $phrasesEchec=implode(", ", $phraseEchec);
     $phraseReussite="Tous les champs sont valides";
    if (in_array(false, $areValidChamps)) {
        return [
            "success" => false,
            "phraseEchec" => $phrasesEchec
        ];
    } else {
        return [
            "success" => true,
            "phraseReussite" => $phraseReussite
        ];
    }
}

function verifExistInDB($datas){
    global $connexion_bd;
 echo "<script>console.log('verif');</script>";
    if (isset($datas["email"])&&isset($datas["pseudo"])) {
 echo "<script>console.log('verif');</script>";
       $pseudo=$datas["pseudo"];
  
       $email=$datas["email"];
         $requete="select * from utilisateurs where email = :email OR pseudo = :pseudo";
        $requetePreparee= $connexion_bd ->prepare($requete);
        // on exécute la requete preparee en remplacant chaque élément de la requete  par sa valeur)
        $requetePreparee->execute([
            ':email' => $email
            ,
            ':pseudo' => $pseudo
        ]);
        $utilisateurs = $requetePreparee->fetch(PDO::FETCH_ASSOC);

        if ($utilisateurs) {
             echo "<script>console.log('verifexitedeja');</script>";
                return  [
                    "success" => true,
                    "data" => "L'utilisateur existe deja"
                ];
        } else {
             echo "<script>console.log('verifexistepas');</script>";
            return  [
                "success" => false,
                "data" => "L'utilisateur n'existe pas"];
        }
        
    } 

    if (isset($datas["email"])&&!isset($datas["pseudo"])) {
         $email=$datas["email"];
            $requete="select * from utilisateurs where email = :email";
            $requetePreparee= $connexion_bd ->prepare($requete);
        // on exécute la requete preparee en remplacant chaque élément de la requete  par sa valeur)
            $requetePreparee->execute([
            ':email' => $email
        ]);
        $utilisateur = $requetePreparee->fetch(PDO::FETCH_ASSOC);
        if ($utilisateur) {
                return  [
                    "success" => true,
                    "utilisateur" => $utilisateur];
        } else {
            return  [
                "success" => false,
                "utilisateur" => null];
        }

    }


}
 function  verifPassword($datas,$userFound){
    echo "224verifpassword";
    var_dump($userFound);
    var_dump($datas);
    $test=password_verify($datas["motDePasse"], $userFound["password"]);
        if ($test==true) {
            return  [
                "success" => true,
                "utilisateur" => $userFound];
        } else {
            return  [
                "success" => false,
                "phraseEchec" => "Le mot de passe est incorrect"];
        }
    }
 

function trimDataForInscription($datas){
    foreach ($datas as $key => $data) {
        if ($key!="nom") {
            $datas[$key]=trim($data);
        }
        
    }
    return $datas;
}

function trimDataForConnexion($datas){
    foreach ($datas as $key => $data) {
        switch ($key) {
            case 'email':
                $datas[$key]=trim($data);
                break;
            // case 'motDePasse':
            //     $datas[$key]=trim($data);
            //     break;
            default:
                break;
        }
    }
    return $datas;
}
function protectData($datas){
     foreach ($datas as $key => $data) {
        $datas[$key]=htmlspecialchars($data);
    }
    return $datas;
}




function InsertInBD($datas){
    
    global $connexion_bd;
    //  echo"in script insertinbd";
    $nomUtilisateur=$datas["nomUtilisateur"];
    if (isset($datas["prenomUtilisateur"])) {
        $prenomUtilisateur=$datas["prenomUtilisateur"];
    } else {
        $prenomUtilisateur="";
    }
  
    $email=$datas["email"];
    $motDePasse=$datas["motDePasse"];
    $motDePasseHash=password_hash($motDePasse,PASSWORD_DEFAULT);
    $role=$datas["role"];
    $pseudo=$datas["pseudo"];
    if (isset($datas["dateNaissance"])) {
        $dateNaissance=$datas["dateNaissance"];
    } else {
        $dateNaissance=null;
    }
    if (isset($datas["imageProfil"])) {
        $imageProfil=$datas["imageProfil"];
    } else {
        $imageProfil=null;
    }
 
  
    // echo"mail".$mail;
  
    $requete="insert into utilisateurs (nom_utilisateur,prenom_utilisateur,email,password,imageProfil,pseudo,dateInscription,role,statut_utilisateur,dateNaissance) values (:nomUtilisateur,:prenomUtilisateur,:email,:motDePasseHash,:imageProfil,:pseudo,:dateInscription,:role,:statut_utilisateur,:dateNaissance)";
    $requetePreparee=$connexion_bd->prepare($requete);
    $requetePreparee->execute([
        ':nomUtilisateur' => $nomUtilisateur,
        ':prenomUtilisateur' => $prenomUtilisateur,
        ':email' => $email,
        ':imageProfil' => $imageProfil,
        ':motDePasseHash' => $motDePasseHash,
        ':role' => $role,
        ':pseudo' => $pseudo,
        ':dateNaissance' => $dateNaissance,
        ':dateInscription' => date("Y-m-d H:i:s"),
        ':statut_utilisateur' => 1,
    ]);
    
    // La fonction lastInsertId()  permet de récupérer l'identifiant auto-incrémenté de la dernière ligne insérée dans la base de données

    // Récupération de l'ID auto-incrémenté
    $id_utilisateur = $connexion_bd->lastInsertId();
    echo"id".$id_utilisateur;
   
      $_SESSION['id_utilisateur']=$id_utilisateur;
      $_SESSION['pseudo']=$pseudo;
      $_SESSION['role']=$role;
      session_write_close();

    echo "<script>console.log('ID nouvel utilisateur : $id_utilisateur');</script>";
    // sleep(2);
    // return true;
}

function selectAllEvents(){
    global $connexion_bd;
    $requete="select * from evenements";
    $requetePreparee=$connexion_bd->prepare($requete);
    $requetePreparee->execute();
    $evenements=$requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    return $evenements;
}

function findAllEventsByParticipantId(){
    $idInscrit=$_SESSION['id'];
    global $connexion_bd;
    $requete="select * from inscriptions I join evenements E on I.id_evenement = E.id_evenement where id_inscrit = :idInscrit";
    $requetePreparee=$connexion_bd->prepare($requete);
    $requetePreparee->execute([
        ':idInscrit' => $idInscrit,
    ]);
    
    $evenements=$requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    return $evenements;
}

 function findAllEventsByOrganisateurId(){
    $idOrganisateur=$_SESSION['id'];
    global $connexion_bd;
    $requete="select * from evenements where id_organisateur = :idOrganisateur";
    $requetePreparee=$connexion_bd->prepare($requete);
    $requetePreparee->execute([
        ':idOrganisateur' => $idOrganisateur,
    ]);
    
    $evenements=$requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    return $evenements;
} 

function saveProfilImageFile()
{
    $save_directory = __DIR__ . DIRECTORY_SEPARATOR . 'facturesUBL' . DIRECTORY_SEPARATOR .    $IDComm  . DIRECTORY_SEPARATOR;

    if (!file_exists($save_directory)) {
        mkdir($save_directory, 0777, true); // Crée le répertoire s'il n'existe pas
    }

    // Chemin complet du fichier XML à enregistrer
    $filePath = $save_directory . $filename;

    // Sauvegarder le fichier XML sur le serveur
    file_put_contents($filePath, $dom->saveXML());
}

?>