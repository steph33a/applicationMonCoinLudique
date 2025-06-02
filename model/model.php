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
    if (strlen($valeurChamp) > 255) {
        return  [
            "success" => false,
            "phraseEchec" => "Le champ $nomChamp est trop long"
        ];
    }
    //  echo "<br>"."ligne44";
    //  echo "<br>"."nomChamp".$nomChamp."valeurChamp".$valeurChamp;

    if ($nomChamp == "pseudo" || $nomChamp == "nom" || $nomChamp == "prenom" || $nomChamp == "jeuPrefereUser" || $nomChamp == "chanteurPrefereUser" || $nomChamp=="villeEvent" || $nomChamp=="rueEvent" || $nomChamp=="titreEvent" || $nomChamp=="recurrenceEvent"||$nomChamp=="jeuxThemesEvent"||$nomChamp=="discussionGroupName") {
        if (strlen($valeurChamp) < 3) {
            //  echo "ligne48";
            // echo "nomChamp".$nomChamp."valeurChamp".$valeurChamp;
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
                 
                
    }
 
    if (($nomChamp == "url1") || ($nomChamp == "url2") ){
        $url = $valeurChamp;
        if (filter_var($url, FILTER_VALIDATE_URL)=== false) {
            return  [
                                "success" => false,
                                "phraseEchec" => "L'url n'est pas valide"
                            ];
        } else {
            return  [
                                "success" => false,
                                "phraseEchec" => "L'url est valide'"
                            ];
        }
                
        }
    switch ($nomChamp) {
      
            case 'nom':
                //  Cette regex accepte :Lettres (y compris accentuées),Espaces,Apostrophes (ex. Léo d’Arcy), Tirets (ex. Jean-Michel)
                  // Vérifie que ce sont uniquement des lettres (avec accents), éventuellement espaces ou tirets
            if (!preg_match('/^[\p{L} \'-]+$/u', $valeurChamp)) {
                return [
                    "success" => false,
                    "phraseEchec" => ucfirst($nomChamp) . " ne doit contenir que des lettres, espaces, apostrophes ou tirets"
                ];
            }
            return [
                "success" => true,
                "phraseEchec" => ""
            ];
               
            case 'prenom':
                        // Vérifie que ce sont uniquement des lettres (avec accents), éventuellement espaces ou tirets
            if (!preg_match('/^[\p{L} \'-]+$/u', $valeurChamp)) {
                return [
                    "success" => false,
                    "phraseEchec" => ucfirst($nomChamp) . " ne doit contenir que des lettres, espaces, apostrophes ou tirets"
                ];
            }
            return [
                "success" => true,
                "phraseEchec" => ""
            ];
               
            
            case 'email':
                
                   if (filter_var($valeurChamp, FILTER_VALIDATE_EMAIL) === false) {
                    
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

            case 'typeSoiree':
          
                 $typesValides = ['createur', 'classique', 'thematique'];
                    if (!in_array($valeurChamp, $typesValides)) {
                        return [
                            "success" => false,
                            "phraseEchec" => "Le type de soirée doit être 'createur', 'classique' ou 'thematique'"
                        ];
                    }
                    break;
           
            case 'nbParticipants':
            if (!is_numeric($valeurChamp) || $valeurChamp <= 0) {
                return [
                    "success" => false,
                    "phraseEchec" => "Le nombre de participants doit être un nombre positif"
                ];
            }
            break;
            case 'ageRequis':
            if (!is_numeric($valeurChamp) || $valeurChamp < 0) {
                return [
                    "success" => false,
                    "phraseEchec" => "L'age requis doit être un nombre positif"
                ];
            }

        case 'dateEvent':
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $valeurChamp)) {
                return [
                    "success" => false,
                    "phraseEchec" => "Format de date invalide"
                ];
            }
            break;

        case 'heureEvent':
            if (!preg_match('/^\d{2}:\d{2}$/', $valeurChamp)) {
                return [
                    "success" => false,
                    "phraseEchec" => "Format d’heure invalide"
                ];
            }
            break;

        case 'codePostalEvent':
            if (!preg_match('/^\d{5}$/', $valeurChamp)) {
                return [
                    "success" => false,
                    "phraseEchec" => "Code postal invalide"
                ];
            }
            break;

        case 'numRueEvent':
            if (!is_numeric($valeurChamp) || $valeurChamp <= 0) {
                return [
                    "success" => false,
                    "phraseEchec" => "Numéro de rue invalide"
                ];
            }
            break;

        case 'numberPhoneEvent':
            if (!preg_match('/^\d{10}$/', $valeurChamp)) {
                return [
                    "success" => false,
                    "phraseEchec" => "Numéro de téléphone invalide"
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
         return  [
                    "success" => true,
                    "phraseEchec" => ""
                  ];   
}
    
function allChampsNecessaryPresents($datas,$fonctionnalite)
{ 
   $champNecessary=[];
   var_dump($fonctionnalite);
 if ($fonctionnalite=="inscription") {
    $champNecessary=["pseudo","email","motDePasse","confirmationMotDePasse"];


 }
 if ($fonctionnalite=="connexion") {
    $champNecessary=["email","motDePasse"];
 }
  if ($fonctionnalite=="connexionAdminAsUser") {
    $champNecessary=["pseudo"];
 }
 if ($fonctionnalite=="reponsesQuestionForRecupMotDePasse") {
    // echo "ligne131 model";
    $champNecessary=["email","jeuPrefereUser","chanteurPrefereUser"];
 }
 if ($fonctionnalite=="creationEvenement") {
    $role=$_SESSION["role"];
    var_dump($role);
    if (($role=="groupe") ) {
        $champNecessary=["emailEvent","numberPhoneEvent","codePostalEvent","villeEvent","numRueEvent","rueEvent","titreEvent","typeSoiree","reccurenceEvent","nbParticipants","dateEvent","heureEvent"];
        var_dump($champNecessary);
    } else if ($role=="particulier"|| ($role=="admin")) {
        $champNecessary=["emailEvent","dateEvent","heureEvent","typeSoiree","nbParticipants"];
        var_dump($champNecessary);
    } 
 }
 
 if ($fonctionnalite=="redefinitionMotDePasse") {
    $champNecessary=["email","motDePasse","confirmationMotDePasse"];
 }

    

  foreach ($champNecessary as $champ) {
    // echo "champ".$champ;
        if (!isset($datas[$champ]) || empty($datas[$champ])) {
            
              echo "champ 262 ".$champ;
              return [
        "success" => false,
        "champNecessaryPresents" => $champNecessary
    ];
        }
    }
   echo"ok champNecessary";
    return [
        "success" => true,
        "champNecessaryPresents" => $champNecessary
    ];
}


function areValidChamps($datas,$allChampsNecessaryPresents)
{
   echo "279arrive dans areValidChamps";
    var_dump($allChampsNecessaryPresents);
    $areValidChamps=[];
    var_dump($datas);
    $phraseEchec=[]; 
    foreach ($datas as $nomChamp => $valeurChamp) {
        if ($nomChamp === "confirmationMotDePasse") {
            if (!isset($datas["motDePasse"]) || $valeurChamp !== $datas["motDePasse"]) {
                return [
                    "success" => false,
                    "phraseEchec" => "Les deux mots de passe ne correspondent pas"
                ];
            }
            // Passe au champ suivant, on ne valide pas ce champ plus loin
            continue;
        }
       
    
       if (empty($valeurChamp)) {
            // Si c’est un champ obligatoire => ERREUR
            if (in_array($nomChamp, $allChampsNecessaryPresents)) {
                $phraseEchec[] = "Le champ '$nomChamp' est obligatoire et ne peut pas être vide.";
                $areValidChamps[] = false;
            } else {
                // Sinon c’est un champ optionnel => on accepte
                $areValidChamps[] = true;
            }
            continue; // Passe au champ suivant
        }
        echo "nomChamp".$nomChamp."valeurChamp".$valeurChamp."<br>";

    //    echo "nomChamp".$nomChamp."valeurChamp".$valeurChamp."<br>";
        $isValidChamp=champIsValid($nomChamp,$valeurChamp);
        $areValidChamps[]=$isValidChamp["success"];
        if ($isValidChamp["success"]==false) {
            $phraseEchec[]=$isValidChamp["phraseEchec"];
            echo "invalideChamp";
            echo "valeurChamp".$valeurChamp."nomChamp".$nomChamp."phraseEchec".$isValidChamp["phraseEchec"];
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
   


function verifExistInDb($datas){

global $connexion_bd;
$utilisateur = null;
//  echo "<script>console.log('verif');</script>";

    if (isset($datas["email"])&&isset($datas["pseudo"])) {
//  echo "<script>console.log('verif');</script>";
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
        $utilisateur = $requetePreparee->fetch(PDO::FETCH_ASSOC);

       
        
    } 

    else if (isset($datas["email"])&&!isset($datas["pseudo"])) {
         $email=$datas["email"];
            $requete="select * from utilisateurs where email = :email";
            $requetePreparee= $connexion_bd ->prepare($requete);
        // on exécute la requete preparee en remplacant chaque élément de la requete  par sa valeur)
            $requetePreparee->execute([
            ':email' => $email
        ]);
        $utilisateur = $requetePreparee->fetch(PDO::FETCH_ASSOC);
    

    }
    else if (!isset($datas["email"])&&isset($datas["pseudo"])) {
         $pseudo=$datas["pseudo"];
            $requete="select * from utilisateurs where pseudo = :pseudo";
            $requetePreparee= $connexion_bd ->prepare($requete);
        // on exécute la requete preparee en remplacant chaque élément de la requete  par sa valeur)
            $requetePreparee->execute([
            ':pseudo' => $pseudo
        ]);
        $utilisateur = $requetePreparee->fetch(PDO::FETCH_ASSOC);
    

    }
     if ($utilisateur) {
            //  echo "<script>console.log('verifexitedeja');</script>";
                return  [
                    "success" => true,
                    "utilisateur" => $utilisateur
                ];
        } else {
            //  echo "<script>console.log('verifexistepas');</script>";
            return  [
                "success" => false,
                "phraseEchec" => "L'utilisateur n'existe pas"];
        }


}
 function  verifPassword($datas,$userFound){
    // echo "224verifpassword";
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
 
// Si tu récupères cette donnée dans $datas['imageEvent'] (par exemple en fusionnant $_POST et $_FILES), alors $datas['imageEvent'] n’est pas une chaîne simple (comme 'image (9).png'), mais un tableau (avec les clés 'name', 'tmp_name', 'size', etc).
function trimData($datas){
  

    $listDataToClean=["pseudo","jeuPrefereUser","chanteurPrefereUser","villeEvent","rueEvent","titreEvent"];

    foreach ($datas as $key => $data) {
      
        if (is_string($data)) {
        // echo "data272".$data;
            $datas[$key]=trim($data);

        if (in_array($datas[$key], $listDataToClean, true)) {
            
            while (strpos($datas[$key], "  ") !== false) {
               $datas[$key] = str_replace("  ", " ",$datas[$key]);
            }
        }
    } else if (is_array($data)) {
            // Par exemple, rien à faire, on garde la valeur telle quelle
            $datas[$key] = $data;
        }
      
        
    }
    return $datas;
}




/**
 * Sanitizes an array of data by converting special characters to HTML entities.
 *
 * This function iterates over the provided associative array and applies the
 * `htmlspecialchars` function to each value, ensuring that any special characters
 * are converted to their corresponding HTML entities. This is useful for preventing
 * XSS (Cross-Site Scripting) attacks by escaping characters like '<', '>', '&', etc.
 *
 * @param array $datas The array of data to be sanitized.
 * @return array The sanitized array with special characters converted to HTML entities.
 */

function protectData($datas){
    var_dump($datas);
     foreach ($datas as $key => $valeur) {
        $datas[$key]=htmlspecialchars(isset($valeur) ? $valeur : "");
    }
    return $datas;
}




function insertInBD($datas){
    
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
    // echo"id".$id_utilisateur;
   
      $_SESSION['id_utilisateur']=$id_utilisateur;
      $_SESSION['pseudo']=$pseudo;
      $_SESSION['role']=$role;
      session_write_close();

    // echo "<script>console.log('ID nouvel utilisateur : $id_utilisateur');</script>";
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
function modificationMotDePasse($datas){
    $email=$datas["email"];
    $motDePasse=$_POST['motDePasse'];
    $motDePasseHash=password_hash($motDePasse,PASSWORD_DEFAULT);
    // echo $motDePasseHash;
    global $connexion_bd;
    $requete="update utilisateurs set password = :motDePasse where email = :email";
    $requetePreparee=$connexion_bd->prepare($requete);
    $requetePreparee->execute([
        ':motDePasse' => $motDePasseHash,
        ':email' => $email,
    ]);

    $requete="select * from utilisateurs  where email = :email ";
    $requetePreparee=$connexion_bd->prepare($requete);
    $requetePreparee->execute([
        ':email' => $email,
    ]);
    
    $result=$requetePreparee->fetch(PDO::FETCH_ASSOC);
    // var_dump($result);
    $id_utilisateur=$result["id_utilisateur"];
    $pseudo=$result["pseudo"];
    $role=$result["role"];

      $_SESSION['id_utilisateur']=$id_utilisateur;
      $_SESSION['pseudo']=$pseudo;
      $_SESSION['role']=$role;

      session_write_close();
    
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
function importReponsesQuestions($id_utilisateur){
    global $connexion_bd;
    $requete="select * from password_recup where id_utilisateur = :id_utilisateur";
    
    $requetePreparee=$connexion_bd->prepare($requete);
    $requetePreparee->execute(
        [
            ':id_utilisateur' => $id_utilisateur,
        ]
    );
    // fetch pour récupérer le premier résultat qui sera de toute façon le seul
    $result=$requetePreparee->fetch(PDO::FETCH_ASSOC);
    return $result;
}
// à revoir
function nettoyerNomFichier($filename) {
    // enlève tous les caractères sauf lettres, chiffres, tirets, points, underscores
    $filename = preg_replace("/[^a-zA-Z0-9\-\._]/", "_", $filename);
    return $filename;
}
/**
 * Vérifie si le type et la taille d'un fichier image sont valides.
 *
 * @param string $fileType Le type MIME du fichier à vérifier (ex: image/jpeg).
 * @param int $fileSize La taille du fichier en octets.
 *
 * @throws Exits le script si le type de fichier n'est pas autorisé ou si la taille dépasse 2 Mo.
 * @return void
 */

 function  verificationFichierImage($cheminTemporaireServeur, $fileSize) {  
    // Types MIME autorisés
    $maxSizeInBytes = 2 * 1024 * 1024;
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];
    //  pour vérifier le type MIME du fichier plus robuste que typefile
// fonction ouvre un gestionnaire finfo, qui permet d'analyser un fichier.
// FILEINFO_MIME_TYPE indique qu’on veut récupérer le type MIME du fichier
     $analyseurFichierMime = finfo_open(FILEINFO_MIME_TYPE);
    //  $analyseurFichierMime  c'est appelé f_info en temps normal
     $realMimeType = finfo_file($analyseurFichierMime, $cheminTemporaireServeur);
     finfo_close($analyseurFichierMime);

        // Taille max (2 Mo)
    
    if (!in_array($realMimeType, $allowedMimeTypes)) {
         echo "Erreur : type de fichier non autorisé. Seules les images JPEG, PNG et WEBP sont acceptées.";
        return false;
    }
  

    // Vérification de la taille
    if ($fileSize > $maxSizeInBytes) {
        echo "Erreur : le fichier est trop volumineux. La taille maximale autorisée est de 2 Mo.";
        return false;
    }
    return true;
 }
function enregistrementImageProfil(){

    if (isset($_FILES['imageProfil']) && $_FILES['imageProfil']['error'] === UPLOAD_ERR_OK) {
    // Récupérer les infos du fichier uploadé
      $cheminTemporaireServeur = $_FILES['imageProfil']['tmp_name']; // fichier temporaire sur serveur
      $fileOriginalName = nettoyerNomFichier(basename($_FILES['imageProfil']['name'])); // $_FILES['imageProfil']['name']; // nom d'origine du fichier
      $fileSize = $_FILES['imageProfil']['size']; // taille du fichier
    //   $fileType = $_FILES['imageProfil']['type']; 
      $result=verificationFichierImage( $cheminTemporaireServeur , $fileSize);
      if (!$result) {
        return;
      }
      $userId = $_SESSION['id_utilisateur'];


        $destinationDirectory = __DIR__ .'/../vue/images/uploads/'.$userId.'/profil/';
        // Exemple : déplacer le fichier vers un dossier "uploads/"
        // pour éviter les collisions de noms de fichiers en utilisant uniqid() crée un identifiant unique
        $destinationFile = $destinationDirectory . uniqid() . '_' . basename($fileOriginalName);
        if (!is_dir($destinationDirectory)) {
            mkdir($destinationDirectory, 0777, true);
        }
        if (move_uploaded_file($cheminTemporaireServeur, $destinationFile)) {
            return ["success"=>true,"destinationFile"=>$destinationFile];
            // echo "Le fichier a bien été uploadé : " . htmlspecialchars($fileOriginalName);
        } else {
            echo "Erreur lors du déplacement du fichier.";
        }

    } else {
        echo "Aucun fichier uploadé ou erreur d'upload.";
    }
   
}
function enregistrementImageEvent(){

    if (isset($_FILES['imageEvent']) && $_FILES['imageEvent']['error'] === UPLOAD_ERR_OK) {
    // Récupérer les infos du fichier uploadé
      $cheminTemporaireServeur = $_FILES['imageEvent']['tmp_name']; // fichier temporaire sur serveur
    //   pour enlever les chemins dans le nom du fichier 
      $fileOriginalName = nettoyerNomFichier(basename($_FILES['imageEvent']['name'])); //$_FILES['imageEvent']['name']; // nom d'origine du fichier
      $fileSize = $_FILES['imageEvent']['size']; // taille du fichier
    //   $fileType = $_FILES['imageEvent']['type']; 
       $result=verificationFichierImage( $cheminTemporaireServeur , $fileSize);
      if (!$result) {
        return;
      }
        $userId = $_SESSION['id_utilisateur'];


 
        // Exemple : déplacer le fichier vers un dossier "uploads/"
        $destinationDirectory = __DIR__ .'/../vue/images/uploads/'.$userId.'/evennement/';
        $destinationFile = $destinationDirectory . uniqid() . '_' . basename($fileOriginalName);
        if (!is_dir($destinationDirectory)) {
            mkdir($destinationDirectory, 0777, true);
        }

        if (move_uploaded_file($cheminTemporaireServeur, $destinationFile)) {
            // echo "Le fichier a bien été uploadé : " . htmlspecialchars($fileOriginalName);
        } else {
            echo "Erreur lors du déplacement du fichier.";
        }
        
    } else {
        echo "Aucun fichier uploadé ou erreur d'upload.";
    }
   
}
// A revoir 
function insertEvenementInBD($datas) {
    global $connexion_bd;

    // Extraction des données depuis $datas (provenant de $_POST probablement)
    $titre = $datas["titre"];
    $description = $datas["description"] ?? "";
    $date = $datas["dateEvent"];
    $heure = $datas["heureEvent"] ?? null;
    $lieu = $datas["villeEvent"] ?? null;
    $typeSoiree = $datas["typeSoiree"]; // ex: 'classique', 'createur', etc.
    $nbParticipantsMax = $datas["nbParticipantsMax"] ?? null;
    $idOrganisateur = $datas["id_organisateur"]; // Doit venir de la session ou d’un champ caché

    $dateCreation = date("Y-m-d H:i:s");

    $requete = "INSERT INTO evenements (titre, description, date, heure, lieu, type_soiree, nb_participants_max, id_organisateur, date_creation)
                VALUES (:titre, :description, :date, :heure, :lieu, :typeSoiree, :nbParticipantsMax, :idOrganisateur, :dateCreation)";

    $requetePreparee = $connexion_bd->prepare($requete);
    $requetePreparee->execute([
        ':titre' => $titre,
        ':description' => $description,
        ':date' => $date,
        ':heure' => $heure,
        ':lieu' => $lieu,
        ':typeSoiree' => $typeSoiree,
        ':nbParticipantsMax' => $nbParticipantsMax,
        ':idOrganisateur' => $idOrganisateur,
        ':dateCreation' => $dateCreation,
    ]);

    $id_evenement = $connexion_bd->lastInsertId();

    // echo "<script>console.log('ID nouvel événement : $id_evenement');</script>";

    return $id_evenement;
}

function verifyExistInBDEvenement() {
     global $connexion_bd;
      $heure = $datas["heureEvent"] ?? null;
      $lieu = $datas["villeEvent"] ?? null;
      $id_utilisateur= $_SESSION[$id_utilisateur];
      $requete="select * from evenements where heure = :heure AND lieu = :lieu AND id_organisateur = :id_utilisateur";
      $requetePreparee=$connexion_bd->prepare($requete);
      $requetePreparee->execute([
          ':heure' => $heure,
          ':lieu' => $lieu,
          ':id_utilisateur' => $id_utilisateur,
      ]);

      $result=$requetePreparee->fetch(PDO::FETCH_ASSOC);
      return $result;

}
?>