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

    if ($nomChamp == "pseudo" || $nomChamp == "nom" || $nomChamp == "prenom" || $nomChamp == "jeuPrefereUser" || $nomChamp == "chanteurPrefereUser" || $nomChamp=="villeEvent" || $nomChamp=="rueEvent" || $nomChamp=="titreEvent" || $nomChamp=="recurrenceEvent"||$nomChamp=="jeuxThemesEvent"||$nomChamp=="discussionGroupName"||$nomChamp=="imageEvent"||$nomChamp=="imageProfil"){ 
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
                                "success" => true,
                                "phraseEchec" => "L'url est valide'"
                            ];
        }
                
        }
    if (($nomChamp == "email")||($nomChamp=='emailEvent')){
        if (filter_var($valeurChamp, FILTER_VALIDATE_EMAIL) === false) {
            return  [
                "success" => false,
                "phraseEchec" => "L'email n'est pas valide"
            ];
        } else {
            return  [
                "success" => true,
                "phraseEchec" => "L'email est valide'"
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
            break;

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
            if (!preg_match('/^\d{4}$/', $valeurChamp)) {
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
//    var_dump($fonctionnalite);
 if ($fonctionnalite=="inscription") {
    $champNecessary=["pseudo","email","motDePasse","confirmationMotDePasse","imageProfil"];


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
    // var_dump($role);
    if (($role=="groupe") ) {
        $champNecessary=["emailEvent","numberPhoneEvent","codePostalEvent","villeEvent","numRueEvent","rueEvent","titreEvent","typeSoiree","nbParticipants","dateEvent","heureEvent","imageEvent"];
        // var_dump($champNecessary);
    } else if ($role=="particulier"|| ($role=="admin")) {
        $champNecessary=["emailEvent","dateEvent","heureEvent","typeSoiree","nbParticipants","villeEvent","imageEvent"];
        // var_dump($champNecessary);
    } 
 }
  if ($fonctionnalite=="modificationEvenement") {
    $role=$_SESSION["role"];
    // var_dump($role);
    if (($role=="groupe") ) {
        $champNecessary=["emailEvent","numberPhoneEvent","codePostalEvent","villeEvent","numRueEvent","rueEvent","titreEvent","typeSoiree","nbParticipants","dateEvent","heureEvent"];
        // var_dump($champNecessary);
    } else if ($role=="particulier"|| ($role=="admin")) {
        $champNecessary=["emailEvent","dateEvent","heureEvent","typeSoiree","nbParticipants","villeEvent"];
        // var_dump($champNecessary);
    } 
 }
 if ($fonctionnalite=="redefinitionMotDePasse") {
    $champNecessary=["email","motDePasse","confirmationMotDePasse"];
 }

    

  foreach ($champNecessary as $champ) {
    // echo "champ".$champ;
        if (!isset($datas[$champ]) || empty($datas[$champ])) {
            
            //    echo "champ 262 ".$champ;
              return [
        "success" => false,
        "champNecessaryPresents" => $champNecessary
    ];
        }
    }
//    echo"ok champNecessary";
    return [
        "success" => true,
        "champNecessaryPresents" => $champNecessary
    ];
}

function areValidChamps($datas, $allChampsNecessaryPresents)
{
    $resultats = [];

    foreach ($datas as $nomChamp => $valeurChamp) {

        // Cas spécial : confirmation mot de passe
        if ($nomChamp === "confirmationMotDePasse") {
            if (!isset($datas["motDePasse"]) || $valeurChamp !== $datas["motDePasse"]) {
                $resultats["confirmationMotDePasse"] = [
                    "success" => false,
                    "phraseEchec" => "Les deux mots de passe ne correspondent pas"
                ];
            } else {
                $resultats["confirmationMotDePasse"] = ["success" => true];
            }
            continue;
        }

        // Champ vide
        if (empty($valeurChamp)) {
            if (in_array($nomChamp, $allChampsNecessaryPresents)) {
                $resultats[$nomChamp] = [
                    "success" => false,
                    "phraseEchec" => "Le champ '$nomChamp' est obligatoire et ne peut pas être vide."
                ];
            } else {
                $resultats[$nomChamp] = ["success" => true];
            }
            continue;
        }

        // Vérification personnalisée
        $isValidChamp = champIsValid($nomChamp, $valeurChamp);

        if (!is_array($isValidChamp)) {
            $resultats[$nomChamp] = [
                "success" => false,
                "phraseEchec" => "Erreur interne de validation sur le champ '$nomChamp'."
            ];
            continue;
        }

        $resultats[$nomChamp] = $isValidChamp["success"]
            ? ["success" => true]
            : ["success" => false, "phraseEchec" => $isValidChamp["phraseEchec"]];
    }

    // Résumé global
    // Cette fonction PHP extrait la colonne "success" de chaque élément (qui doit être un tableau associatif) dans le tableau $resultats.
    $successGlobal = !in_array(false, array_column($resultats, "success"));

    return [
        "success" => $successGlobal,
        "details" => $resultats
    ];
}
function updateInBdEventUtilisateur($id_organisateur, $id_evenement,$champsToUpdate) {
    global $connexion_bd;

    if (empty($champsToUpdate)) {
        return ["success" => true, "message" => "Aucun champ à mettre à jour pour utilisateurs"];
    }

    // Correspondance champs formulaire -> colonnes BD
    $mapping = [
        'nbParticipants' => 'nb_participants_max',
        'ageRequis'=> 'age_minimum',
        'recurrenceEvent' => 'recurrence',
        'typeSoiree' => 'type_soiree',
        'dateEvent' => 'date_evenement',
        'heureEvent' => 'heure',
        'titreEvent' => 'titre_evenement',
        'jeuxThemesEvent' => 'jeux_et_themes', // Spécial : hash du mot de passe
        'rueEvent' => 'adresse_rue',
        'numeroEvent' => 'adresse_numero',
        'villeEvent' => 'adresse_ville',
        'codePostalEvent' => 'adresse_CP',
        'emailEvent' => 'email',
        'numberPhoneEvent' => 'telephone',
        'url1' => 'url1',
        'url2' => 'url2',
        'discussionGroupName' => 'groupe_de_discussion',
    ];

    $sets = [];
    $params = [
        ':id_organisateur' => $id_organisateur,
        ':id_evenement' => $id_evenement
    ];

    foreach ($champsToUpdate as $champ => $valeur) {
        if (isset($mapping[$champ])) {
            // Prépare la partie SET de la requête SQL : nom_colonne = :paramètre
        // Exemple : "nom_utilisateur = :nomUtilisateur"
        // $mapping[$champ] récupère par exemple nom_utilisateur, prenom_utilisateur, email, pseudo, password
            $sets[] = $mapping[$champ] . " = :" . $champ;
            $params[":" . $champ] = $valeur;
        }
    }

    if (empty($sets)) {
        return ["success" => true, "message" => "Aucun champ valide pour mise à jour utilisateurs"];
    }
    // implode pour  joindre les éléments d’un tableau en une seule chaîne de caractères

    $sql = "UPDATE evenements SET " . implode(", ", $sets) . " WHERE id_organisateur = :id_organisateur and id_evenement = :id_evenement";

    try {
        $stmt = $connexion_bd->prepare($sql);
        $stmt->execute($params);
        return ["success" => true, "message" => "Mise à jour utilisateurs réussie"];
    } catch (PDOException $e) {
        return ["success" => false, "message" => "Erreur mise à jour utilisateurs : " . $e->getMessage()];
    }
    
    
}
function parametresCompteCorrects($datas) {
    $champs = [];

    foreach ($datas as $nomChamp => $valeurChamp) {
        // Gestion spéciale pour mot de passe (puisque non vide grâce au unset préalable)
        if ($nomChamp === "motDePasse") {
            $motDePasse = trim($valeurChamp);
            $confirmation = isset($datas["confirmationMotDePasse"]) ? trim($datas["confirmationMotDePasse"]) : "";

            if ($confirmation === "") {
                $champs["confirmationMotDePasse"] = [
                    "success" => false,
                    "phraseEchec" => "Veuillez confirmer le mot de passe."
                ];
            } elseif ($motDePasse !== $confirmation) {
                $champs["confirmationMotDePasse"] = [
                    "success" => false,
                    "phraseEchec" => "Le mot de passe et la confirmation ne correspondent pas."
                ];
            }
            

            $isValidChamp = champIsValid($nomChamp, $motDePasse);
            if ($isValidChamp["success"] === false) {
                $champs["motDePasse"] = [
                    "success" => false,
                    "phraseEchec" => $isValidChamp["phraseEchec"]
                ];
            } else {
                $champs["motDePasse"] = ["success" => true];
            }

            continue;
        }

        // Validation des autres champs
        $isValidChamp = champIsValid($nomChamp, $valeurChamp);
        if ($isValidChamp["success"] === false) {
            $champs[$nomChamp] = [
                "success" => false,
                "phraseEchec" => $isValidChamp["phraseEchec"]
            ];
        } else {
            $champs[$nomChamp] = ["success" => true];
        }
    }

    $successGlobal = !in_array(false, array_column($champs, "success"));

    return [
        "success" => $successGlobal,
        "champs" => $champs
    ];
}

function parametresEventCorrects($id_utilisateur,$id_evenement,$datasEvent) {
    $champs = [];

    foreach ($datasEvent as $nomChamp => $valeurChamp) {
        // Gestion spéciale pour mot de passe (puisque non vide grâce au unset préalable)
   
        // Validation des autres champs
        $isValidChamp = champIsValid($nomChamp, $valeurChamp);
        if ($isValidChamp["success"] === false) {
            $champs[$nomChamp] = [
                "success" => false,
                "phraseEchec" => $isValidChamp["phraseEchec"]
            ];
        } else {
            $champs[$nomChamp] = ["success" => true];
        }
    }

    $successGlobal = !in_array(false, array_column($champs, "success"));

    return [
        "success" => $successGlobal,
        "champs" => $champs
    ];
}
function enleverChampsVides($datasEvent) {
    foreach ($datasEvent as $nomChamp => $valeurChamp) {
        if (empty($valeurChamp)) {
            unset($datasEvent[$nomChamp]);
        }
    }
    return $datasEvent;
}
function getChampsDifferentsParRapportBD($datas, $id_utilisateur) {
    // Ajouter le mot de passe hashé aux données à comparer
    

    // Tableau de correspondance : champ formulaire => champ base de données
    $champsAComparer = [
        'email' => 'email',
        'pseudo' => 'pseudo',
        'nomUtilisateur' => 'nom_utilisateur',
        'prenomUtilisateur' => 'prenom_utilisateur',
        'motDePasse' => 'password', // Spécial : hash du mot de passe
        'jeuPrefereUser' => 'reponse1',
        'chanteurPrefereUser' => 'reponse2'
    ];

    // Connexion à la base de données
    global $connexion_bd;
    $requete = "SELECT email, pseudo, nom_utilisateur, prenom_utilisateur, password, imageProfil, reponse1, reponse2 
                FROM utilisateurs 
                LEFT JOIN password_recup ON utilisateurs.id_utilisateur = password_recup.id_utilisateur 
                WHERE utilisateurs.id_utilisateur = :id_utilisateur";
    $requetePreparee = $connexion_bd->prepare($requete);
    $requetePreparee->execute([':id_utilisateur' => $id_utilisateur]);
    $userBD = $requetePreparee->fetch(PDO::FETCH_ASSOC);
    if (!$userBD) {
        return ["success" => false, "message" => "Utilisateur introuvable"];
    }

    // Comparaison des champs
    $champsdifferents = [];
    foreach ($champsAComparer as $champFormulaire => $champBD) {
        if ($champFormulaire === 'motDePasse') {
            // Comparaison spéciale pour le mot de passe
            if (!empty($datas['motDePasse']) &&
                !password_verify($datas['motDePasse'], $userBD[$champBD])) {
                    $champsdifferents['motDePasse']= password_hash($datas['motDePasse'], PASSWORD_DEFAULT);

            }
        } else {
            if (isset($datas[$champFormulaire]) && $datas[$champFormulaire] !== $userBD[$champBD]) {
                $champsdifferents[$champFormulaire] = $datas[$champFormulaire];

            }
        }
    }
    if (count($champsdifferents) > 0) {
        return [
            "success" => true,
            
            "champsToUpdate" => $champsdifferents
        ];
    } else {
        return [
            "success" => false,
           
            
        ];
    }

   
}
function getChampsDifferentsParRapportBDEvent($id_organisateur, $id_evenement, $datas) {
    // Remplacement de l'ID événement depuis les datas si nécessaire
    $id_evenement = $datas['id_evenement'];

    // Correspondance champ formulaire => champ en base
    $champsAComparer = [
        'nbParticipants' => 'nbParticipants_max', // corriger ici aussi !
        'ageRequis'=> 'age_minimum',
        'recurrenceEvent' => 'recurrence',
        'typeSoiree' => 'type_soiree',
        'dateEvent' => 'date_evenement',
        'heureEvent' => 'heure',
        'titreEvent' => 'titre_evenement',
        'jeuxThemesEvent' => 'jeux_et_themes',
        'rueEvent' => 'adresse_rue',
        'numeroEvent' => 'adresse_numero',
        'villeEvent' => 'adresse_ville',
        'codePostalEvent' => 'adresse_CP',
        'emailEvent' => 'email',
        'numberPhoneEvent' => 'telephone',
        'url1' => 'url1',
        'url2' => 'url2',
        'discussionGroupName' => 'groupe_de_discussion',
    ];

    // Connexion à la base de données
    global $connexion_bd;
    $requete = "SELECT * FROM evenements WHERE id_organisateur = :id_organisateur AND id_evenement = :id_evenement";
    $requetePreparee = $connexion_bd->prepare($requete);
    $requetePreparee->execute([
        ':id_organisateur' => $id_organisateur,
        ':id_evenement' => $id_evenement
    ]);
    $eventBD = $requetePreparee->fetch(PDO::FETCH_ASSOC);

    if (!$eventBD) {
        return ["success" => false, "message" => "event introuvable"];
    }

    // Comparaison des champs
    $champsdifferents = [];

    foreach ($champsAComparer as $champFormulaire => $champBD) {
        if (isset($datas[$champFormulaire])) {
            $valForm = trim((string)$datas[$champFormulaire]);
            $valBD = trim((string)$eventBD[$champBD]);

            if ($valForm !== $valBD) {
                $champsdifferents[$champFormulaire] = $valForm;
            }
        }
    }

    // Retourner le résultat après la boucle
    if (count($champsdifferents) > 0) {
        return [
            "success" => true,
            "champsToUpdate" => $champsdifferents
        ];
    } else {
        return [
            "success" => false,
            "message" => "Aucun champ modifié"
        ];
    }
}


function whichCategoryForInsertionInBD($id_utilisateur, $champsToUpdate) {
    global $connexion_bd;
    $champsUtilisateursFormulaire = [
        'nomUtilisateur', 'prenomUtilisateur',
        'email', 'pseudo', 'password' // exemple
        // ajoute ici tous les autres champs valides pour la table utilisateurs
    ];
       $champsPasswordRecupFormulaire = [
        'motDePasseHash', 'jeuPrefereUser', 'chanteurPrefereUser'
    ];

     $champsUtilisateurs = [];
    $champsPasswordRecup = [];
    foreach ($champsToUpdate as $champ => $valeur) {
        if (in_array($champ, $champsUtilisateursFormulaire)) {
            $champsUtilisateurs[$champ] = $valeur;
            
        } 
        if (in_array($champ, $champsPasswordRecupFormulaire)) {
            $champsPasswordRecup[$champ] = $valeur;
        } 
    }
    return [
        "champsUtilisateur" => $champsUtilisateurs,
        "champsPasswordRecup" => $champsPasswordRecup
    ];
   
}   
function createRecupMotDePasse($id_utilisateur){
    global $connexion_bd;
    $requete = "INSERT INTO password_recup (id_utilisateur, reponse1, reponse2) VALUES (:id_utilisateur, :reponse1, :reponse2)";
    $requetePreparee = $connexion_bd->prepare($requete);
    $requetePreparee->execute([
        ':id_utilisateur' => $id_utilisateur,
        ':reponse1' => "",
        ':reponse2' => ""
    ]);
}
function verifyIfPasswordRecupExists($id_utilisateur) {
    global $connexion_bd;

    $requete = "SELECT * FROM password_recup WHERE id_utilisateur = :id_utilisateur";
    $requetePreparee = $connexion_bd->prepare($requete);
    $requetePreparee->execute([
        ':id_utilisateur' => $id_utilisateur
    ]);

    $resultat = $requetePreparee->fetch(PDO::FETCH_ASSOC);

    if ($resultat) {
        return [
            "success" => true,
            "data" => $resultat
        ];
    } else {
        return [
            "success" => false
        ];
    }
}

function updateInBdUtilisateur($id_utilisateur, $champsUtilisateurs) {
    global $connexion_bd;

    if (empty($champsUtilisateurs)) {
        return ["success" => true, "message" => "Aucun champ à mettre à jour pour utilisateurs"];
    }

    // Correspondance champs formulaire -> colonnes BD
    $mapping = [
        'nomUtilisateur' => 'nom_utilisateur',
        'prenomUtilisateur' => 'prenom_utilisateur',
        'email' => 'email',
        'pseudo' => 'pseudo',
        'motDePasseHash' => 'password'
    ];

    $sets = [];
    $params = [':id_utilisateur' => $id_utilisateur];

    foreach ($champsUtilisateurs as $champ => $valeur) {
        if (isset($mapping[$champ])) {
            // Prépare la partie SET de la requête SQL : nom_colonne = :paramètre
        // Exemple : "nom_utilisateur = :nomUtilisateur"
        // $mapping[$champ] récupère par exemple nom_utilisateur, prenom_utilisateur, email, pseudo, password
            $sets[] = $mapping[$champ] . " = :" . $champ;
            $params[":" . $champ] = $valeur;
        }
    }

    if (empty($sets)) {
        return ["success" => true, "message" => "Aucun champ valide pour mise à jour utilisateurs"];
    }
    // implode pour  joindre les éléments d’un tableau en une seule chaîne de caractères

    $sql = "UPDATE utilisateurs SET " . implode(", ", $sets) . " WHERE id_utilisateur = :id_utilisateur";

    try {
        $stmt = $connexion_bd->prepare($sql);
        $stmt->execute($params);
        return ["success" => true, "message" => "Mise à jour utilisateurs réussie"];
    } catch (PDOException $e) {
        return ["success" => false, "message" => "Erreur mise à jour utilisateurs : " . $e->getMessage()];
    }
}
function updateInBdProfil($id_utilisateur, $champsPasswordRecup) {
    global $connexion_bd;

    if (empty($champsPasswordRecup)) {
        return ["success" => true, "message" => "Aucun champ à mettre à jour pour profil"];
    }

    // Correspondance champs formulaire -> colonnes BD dans password_recup
    $mapping = [
        'id_utilisateur' => 'id_utilisateur',
        'jeuPrefereUser' => 'reponse1',
        'chanteurPrefereUser' => 'reponse2'
    ];

    $sets = [];
    $params = [':id_utilisateur' => $id_utilisateur];

    foreach ($champsPasswordRecup as $champ => $valeur) {
        if (isset($mapping[$champ])) {
            // Pour motDePasse, la valeur est déjà hashée
            $sets[] = $mapping[$champ] . " = :" . $champ;
            $params[":" . $champ] = $valeur;
        }
    }

    if (empty($sets)) {
        return ["success" => true, "message" => "Aucun champ valide pour mise à jour profil"];
    }

    $sql = "UPDATE password_recup SET " . implode(", ", $sets) . " WHERE id_utilisateur = :id_utilisateur";

    try {
        $stmt = $connexion_bd->prepare($sql);
        $stmt->execute($params);
        return ["success" => true, "message" => "Mise à jour profil réussie"];
    } catch (PDOException $e) {
        return ["success" => false, "message" => "Erreur mise à jour profil : " . $e->getMessage()];
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

    // var_dump($userFound);
    // var_dump($datas);
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
        echo"imageProfil".$imageProfil;
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
      return ["id_utilisateur"=>$id_utilisateur,"success"=>true];

    // echo "<script>console.log('ID nouvel utilisateur : $id_utilisateur');</script>";
    // sleep(2);
    // return true;
}
function selectAllInfosEvenementById($id_evenement){
 global $connexion_bd;
  
        // Compter les inscrits pour cet événement
        $requete = "SELECT COUNT(*) as nbInscrits FROM inscriptions WHERE id_evenement = :id_evenement";
        $requetePreparee = $connexion_bd->prepare($requete);
        $requetePreparee->execute([':id_evenement' => $id_evenement]);
        $inscriptionData = $requetePreparee->fetch(PDO::FETCH_ASSOC);
        $nbInscrits =  $inscriptionData['nbInscrits'];
    
            // Récupérer les infos complètes de l'événement + utilisateur
            $requete = "SELECT 

                            E.id_evenement,
                            E.recurrence,
                            E.heure,
                            E.date_evenement,
                            E.titre_evenement,
                            E.image_evenement,
                            E.jeux_et_themes,
                            E.nbParticipants_max,
                            E.age_minimum,
                            E.adresse_numero,
                            E.adresse_rue,
                            E.adresse_CP,
                            E.adresse_ville,
                            E.url1,
                            E.url2,
                            E.telephone,
                            E.email,
                            E.groupe_de_discussion,
                            E.type_soiree,
                            E.nbParticipants_max,
                            U.id_utilisateur,
                            U.pseudo,
                            U.prenom_utilisateur,
                            U.nom_utilisateur,
                            U.imageProfil
                        FROM evenements E
                        JOIN utilisateurs U ON E.id_organisateur = U.id_utilisateur
                        WHERE E.id_evenement = :id_evenement";

            $requetePreparee = $connexion_bd->prepare($requete);
            $requetePreparee->execute([':id_evenement' => $id_evenement]);
            $evenement = $requetePreparee->fetch(PDO::FETCH_ASSOC);
            // var_dump($evenement);

            if ($evenement) {
                // Ajouter le champ nbInscrits
                $evenement['nbInscrits'] = $nbInscrits;
                $resultats[] = $evenement;
                // var_dump($resultats);
                if ($evenement['nbInscrits'] > 0) {
                    // Récupérer les inscrits
                $requete = "SELECT U.id_utilisateur, U.pseudo, U.prenom_utilisateur, U.nom_utilisateur
                        FROM inscriptions I
                        JOIN utilisateurs U ON I.id_inscrit = U.id_utilisateur
                        WHERE I.id_evenement = :id_evenement";
                        $requetePreparee = $connexion_bd->prepare($requete);
                        $requetePreparee->execute([':id_evenement' => $id_evenement]);
                        $inscrits = $requetePreparee->fetchAll;
                    (PDO::FETCH_ASSOC);
                        $evenement['inscrits'] = $inscrits;
                
                // var_dump($resultats);

            }
        }
        return $evenement;
}
function getEvenementsWithAllInfos($evenements)
{
    global $connexion_bd;
     $resultats = [];
    if (!empty($evenements) && isset($evenements['id_evenement'])) {
    $evenements = [$evenements];
}

    foreach ($evenements as $evenement) {

           $nbMax = $evenement['nbParticipants_max'];
       $id_evenement = $evenement['id_evenement'];
       $evenement=selectAllInfosEvenementById($id_evenement);
       $resultats[] = $evenement;


            } 
              return $resultats;
 }

function getEvenementsWithEssentialInfos($evenements)
{
    global $connexion_bd;
     $resultats = [];
    if (!empty($evenements) && isset($evenements['id_evenement'])) {
    $evenements = [$evenements];
}

    foreach ($evenements as $evenement) {
           $nbMax = $evenement['nbParticipants_max'];
       $id_evenement = $evenement['id_evenement'];

        // Compter les inscrits pour cet événement
        $requete = "SELECT COUNT(*) as nbInscrits FROM inscriptions WHERE id_evenement = :id_evenement";
        $requetePreparee = $connexion_bd->prepare($requete);
        $requetePreparee->execute([':id_evenement' => $id_evenement]);
        $inscriptionData = $requetePreparee->fetch(PDO::FETCH_ASSOC);
        $nbInscrits =  $inscriptionData['nbInscrits'];
    
            // Récupérer les infos complètes de l'événement + utilisateur
            $requete = "SELECT 
                            E.id_evenement,
                            E.type_soiree,
                            E.heure,
                            E.date_evenement,
                            E.adresse_ville,
                            E.image_evenement,
                            E.nbParticipants_max,
                            U.id_utilisateur,
                            U.pseudo,
                            U.prenom_utilisateur,
                            U.nom_utilisateur,
                            U.imageProfil
                        FROM evenements E
                        JOIN utilisateurs U ON E.id_organisateur = U.id_utilisateur
                        WHERE E.id_evenement = :id_evenement";

            $requetePreparee = $connexion_bd->prepare($requete);
            $requetePreparee->execute([':id_evenement' => $id_evenement]);
            $evenement = $requetePreparee->fetch(PDO::FETCH_ASSOC);

            if ($evenement) {
                // Ajouter le champ nbInscrits
                $evenement['nbInscrits'] = $nbInscrits;
                $resultats[] = $evenement;
            }
        
    } 
    return $resultats;

}
function selectAllEvents(){
    global $connexion_bd;
     // Étape 1 : récupérer tous les événements futurs
    $requete="select id_evenement,date_evenement,nbParticipants_max from evenements where (date_evenement > now())";
    $requetePreparee=$connexion_bd->prepare($requete);
    $requetePreparee->execute();
    $evenements=$requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    $resultats=getEvenementsWithEssentialInfos($evenements);
    return $resultats;
    
}

function findAllEventsByParticipantId($id_inscrit){
    
    global $connexion_bd;
      
    $requete="select E.id_evenement,E.date_evenement,E.nbParticipants_max,I.id_inscrit from inscriptions I join evenements E on I.id_evenement = E.id_evenement where id_inscrit = :id_inscrit and date_evenement > now() and(date_evenement > now())";
    $requetePreparee=$connexion_bd->prepare($requete);
    $requetePreparee->execute([
        ':id_inscrit' => $id_inscrit,
    ]);
    
    $evenements=$requetePreparee->fetchAll(PDO::FETCH_ASSOC);
     $resultats=getEvenementsWithEssentialInfos($evenements);
    return $resultats;
}

 function findAllEventsByOrganisateurId($id_organisateur){
    global $connexion_bd;
     $requete="select id_evenement,date_evenement,nbParticipants_max from evenements where (date_evenement > now())";
    $requete="select id_evenement,date_evenement,nbParticipants_max,id_organisateur,id_utilisateur from evenements E join utilisateurs U on E.id_organisateur = U.id_utilisateur where id_organisateur = :id_organisateur and date_evenement > now()";
    $requetePreparee=$connexion_bd->prepare($requete);
    $requetePreparee->execute([
        ':id_organisateur' => $id_organisateur,
    ]);
    
    $evenements=$requetePreparee->fetchAll(PDO::FETCH_ASSOC);
       $resultats=getEvenementsWithEssentialInfos($evenements);
    return $resultats;
    
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
    $evenements=$requetePreparee->fetch(PDO::FETCH_ASSOC);
    $resultats=getEvenementsWithEssentialInfos($evenements);
    return $resultats;
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
function verificationImageProfil(){

    if (isset($_FILES['imageProfil']) && $_FILES['imageProfil']['error'] === UPLOAD_ERR_OK) {
    // Récupérer les infos du fichier uploadé
      $cheminTemporaireServeur = $_FILES['imageProfil']['tmp_name']; // fichier temporaire sur serveur
      $fileOriginalName = nettoyerNomFichier(basename($_FILES['imageProfil']['name'])); // $_FILES['imageProfil']['name']; // nom d'origine du fichier
      $fileSize = $_FILES['imageProfil']['size']; // taille du fichier
    //   $fileType = $_FILES['imageProfil']['type']; 
      $result=verificationFichierImage( $cheminTemporaireServeur , $fileSize);
      if (!$result) {
        return ["success"=>false,"phraseEchec"=>"Le fichier est trop volumineux. La taille maximale autorisée est de 2 Mo."];  
      } else {
        return ["success"=>true,"cheminTemporaireServeur"=>$cheminTemporaireServeur,"fileOriginalName"=>$fileOriginalName,"fileSize"=>$fileSize];
      }
   
} else {
    echo "Erreur lors du chargement du fichier.";
}
}
function enregistrementImageProfil($id_utilisateur,$cheminTemporaireServeur,$fileOriginalName){

        $destinationDirectory = __DIR__ .'/../vue/images/uploads/'.$id_utilisateur.'/imageprofil/';
        $uniqueFileName = uniqid() . '_' . $fileOriginalName;
        $destinationFile = $destinationDirectory . $uniqueFileName;
        // Exemple : déplacer le fichier vers un dossier "uploads/"
        // pour éviter les collisions de noms de fichiers en utilisant uniqid() crée un identifiant unique
       
        if (!is_dir($destinationDirectory)) {
            mkdir($destinationDirectory, 0777, true);
        }
        if (move_uploaded_file($cheminTemporaireServeur, $destinationFile)) {
            $webPath = '/moncoinludique/vue/images/uploads/' . $id_utilisateur . '/imageProfil/' . $uniqueFileName;
            return ["success"=>true,"destinationFile"=>$destinationFile,"webPath"=>$webPath];
            // echo "Le fichier a bien été uploadé : " . htmlspecialchars($fileOriginalName);
        } else {
            echo "Erreur lors du déplacement du fichier.";
        }


   
}
function sendImageProfilInBd($id_utilisateur,$webPath){
    global $connexion_bd;
    $sql = "UPDATE utilisateurs SET imageProfil = :webPath WHERE id_utilisateur = :id_utilisateur";
    $stmt = $connexion_bd->prepare($sql);
    $stmt->bindParam(':webPath', $webPath);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt->execute();
    
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
        $destinationDirectory = __DIR__ .'/../vue/images/uploads/'.$userId.'/evenement/';
        $uniqueFileName = uniqid() . '_' . $fileOriginalName;
        $destinationFile = $destinationDirectory . $uniqueFileName;
        
        if (!is_dir($destinationDirectory)) {
            mkdir($destinationDirectory, 0777, true);
        }

        if (move_uploaded_file($cheminTemporaireServeur, $destinationFile)) {
             $webPath = '/moncoinludique/vue/images/uploads/' . $userId . '/evenement/' . $uniqueFileName;
            return ["success"=>true,"destinationFile"=>$destinationFile,"webPath"=>$webPath];
            // echo "Le fichier a bien été uploadé : " . htmlspecialchars($fileOriginalName);
        } else {
            echo "Erreur lors du déplacement du fichier.";
        }
        
    } else {
        echo "Aucun fichier uploadé ou erreur d'upload.";
    }
   
}
function findAllInfosEvent($id_organisateur,$id_evenement){
    global $connexion_bd;
    // echo $id_evenement." ".$id_organisateur;
    $sql = "SELECT * FROM evenements E join utilisateurs U on E.id_organisateur = U.id_utilisateur where E.id_organisateur = :id_organisateur and E.id_evenement = :id_evenement";
    $stmt = $connexion_bd->prepare($sql);
    $stmt->execute(
        [
            ':id_organisateur' => $id_organisateur,
            ':id_evenement' => $id_evenement    
        ]
    );
    $evenements = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($evenements);
    $resultats=getEvenementsWithAllInfos($evenements);
    if (count($resultats) === 1) {
        return $resultats[0]; // un seul élément, retourne tableau associatif
    }
  
}
function insertEvenementInBD($datas, $id_utilisateur) {
    global $connexion_bd;
    //  var_dump ($datas);

    // Extraction des données depuis $datas
    $nbParticipants       = $datas["nbParticipants"];
    $ageRequis            = $datas["ageRequis"];
    $recurrenceEvent           = $datas["recurrenceEvent"];
    $typeSoiree           = $datas["typeSoiree"];
    $dateEvent            = $datas["dateEvent"];
 
    $heureEvent           = $datas["heureEvent"];
    $titreEvent           = $datas["titreEvent"];
    $jeuxThemesEvent      = $datas["jeuxThemesEvent"];
    $numRueEvent          = $datas["numRueEvent"];
    $rueEvent             = $datas["rueEvent"];
    $villeEvent           = $datas["villeEvent"];
    $codePostalEvent      = $datas["codePostalEvent"];
    $emailEvent           = $datas["emailEvent"];
    $numberPhoneEvent     = $datas["numberPhoneEvent"];
    $url1                 = $datas["url1"];
    $url2                 = $datas["url2"];
    $discussionGroupName  = $datas["discussionGroupName"];
    $imageEvent           = $datas["imageEvent"];

    $requete = "INSERT INTO evenements (
        id_organisateur,
        recurrence,
        type_soiree,
        date_evenement,
        heure,
        titre_evenement,
        image_evenement,
        jeux_et_themes,
        nbParticipants_max,
        age_minimum,
        adresse_rue,
        adresse_ville,
        adresse_numero,
        adresse_CP,
        email,
        telephone,
        url1,
        url2,
        groupe_de_discussion,
        date_creation
    ) VALUES (
        :id_utilisateur,
        :recurrence,
        :typeSoiree,
        :dateEvent,
        :heureEvent,
        :titreEvent,
        :imageEvent,
        :jeuxThemesEvent,
        :nbParticipants,
        :ageRequis,
        :rueEvent,
        :villeEvent,
        :numRueEvent,
        :codePostalEvent,
        :emailEvent,
        :numberPhoneEvent,
        :url1,
        :url2,
        :discussionGroupName,
        NOW()
    )";

    $requetePreparee = $connexion_bd->prepare($requete);

    $requetePreparee->execute([
        ':id_utilisateur'      => $id_utilisateur,
        ':recurrence'          => $recurrenceEvent,
        ':typeSoiree'          => $typeSoiree,
        ':dateEvent'           => $dateEvent,
        ':heureEvent'          => $heureEvent,
        ':titreEvent'          => $titreEvent,
        ':imageEvent'          => $imageEvent,
        ':jeuxThemesEvent'     => $jeuxThemesEvent,
        ':nbParticipants'      => $nbParticipants,
        ':ageRequis'           => $ageRequis,
        ':numRueEvent'         => $numRueEvent,
        ':rueEvent'            => $rueEvent,
        ':villeEvent'          => $villeEvent,
        ':codePostalEvent'     => $codePostalEvent,
        ':emailEvent'          => $emailEvent,
        ':numberPhoneEvent'    => $numberPhoneEvent,
        ':url1'                => $url1,
        ':url2'                => $url2,
        ':discussionGroupName' => $discussionGroupName
    ]);

    return $connexion_bd->lastInsertId();
}

function verifyExistInBDEvenement($datas,$id_utilisateur) {

     global $connexion_bd;
      $heureEvent = $datas["heureEvent"] ?? null;
      $dateEvent= $datas["dateEvent"] ?? null;
      $id_utilisateur= $id_utilisateur;
     

    //   echo "id_utilisateur".$id_utilisateur."heureEvent".$heureEvent."dateEvent".$dateEvent.$heureEvent;
      $requete="select * from evenements where heure = :heureEvent AND date_evenement = :dateEvent AND id_organisateur = :id_utilisateur";
      $requetePreparee=$connexion_bd->prepare($requete);
      $requetePreparee->execute([
          ':heureEvent' => $heureEvent,
          ':dateEvent' => $dateEvent,
          ':id_utilisateur' => $id_utilisateur
      ]);

      $result=$requetePreparee->fetch(PDO::FETCH_ASSOC);
      
    //   var_dump($result);
      if ($result===false){
          return ["success"=>false];
      } else {
          return ["success"=>true,"phraseEchec"=>"evenementdejapresent"];
      }
      

}
 function selectAllInfosUtilisateurById($id_utilisateur){
     global $connexion_bd;
     $requete="select U.id_utilisateur,imageProfil,pseudo,nom_utilisateur,prenom_utilisateur,email,role,dateInscription,statut_utilisateur,reponse1,reponse2,dateNaissance from utilisateurs U left join password_recup P on U.id_utilisateur=P.id_utilisateur where U.id_utilisateur = :id_utilisateur";
     $requetePreparee=$connexion_bd->prepare($requete);
     $requetePreparee->execute([
         ':id_utilisateur' => $id_utilisateur
     ]);
     $result=$requetePreparee->fetch(PDO::FETCH_ASSOC);
     return $result;
 }
// function saveProfilImageFile()
// {
//     $save_directory = __DIR__ . DIRECTORY_SEPARATOR . 'facturesUBL' . DIRECTORY_SEPARATOR .    $IDComm  . DIRECTORY_SEPARATOR;

//     if (!file_exists($save_directory)) {
//         mkdir($save_directory, 0777, true); // Crée le répertoire s'il n'existe pas
//     }

//     // Chemin complet du fichier XML à enregistrer
//     $filePath = $save_directory . $filename;

//     // Sauvegarder le fichier XML sur le serveur
//     file_put_contents($filePath, $dom->saveXML());
// }
function selectAllInfosUtilisateurs(){
    global $connexion_bd;
    $requete="select U.id_utilisateur,nom_utilisateur,prenom_utilisateur,pseudo,imageProfil,email,dateInscription,role,statut_utilisateur,dateNaissance,reponse1,reponse2 from utilisateurs U left join password_recup P on U.id_utilisateur=P.id_utilisateur";
    $requetePreparee=$connexion_bd->prepare($requete);
    $requetePreparee->execute();
    $result=$requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    
    return $result;
}
function deleteAllIscriptionsByUser($id_inscrit){
    global $connexion_bd;
    $requete="delete from inscriptions where id_inscrit = :id_inscrit";
    $requetePreparee=$connexion_bd->prepare($requete);
    $requetePreparee->execute([
        ':id_inscrit' => $id_inscrit
    ]);
}
function deleteAllEventsByOrganisateur($id_organisateur){
    global $connexion_bd;

    // Supprimer d'abord les inscriptions liées à ses événements
    $requete1 = "DELETE FROM inscriptions WHERE id_evenement IN (
        SELECT id_evenement FROM evenements WHERE id_organisateur = :id_organisateur
    )";
    $stmt1 = $connexion_bd->prepare($requete1);
    $stmt1->execute([':id_organisateur' => $id_organisateur]);

    // Ensuite supprimer les événements
    $requete2 = "DELETE FROM evenements WHERE id_organisateur = :id_organisateur";
    $stmt2 = $connexion_bd->prepare($requete2);
    $stmt2->execute([':id_organisateur' => $id_organisateur]);
}
function deleteThisEvent($id_evenement){
    global $connexion_bd;

    // Supprimer les inscriptions liées à cet événement
    $requete1 = "DELETE FROM inscriptions WHERE id_evenement = :id_evenement";
    $stmt1 = $connexion_bd->prepare($requete1);
    $stmt1->execute([':id_evenement' => $id_evenement]);

    // Supprimer l'événement
    $requete2 = "DELETE FROM evenements WHERE id_evenement = :id_evenement";
    $stmt2 = $connexion_bd->prepare($requete2);
    $stmt2->execute([':id_evenement' => $id_evenement]);
}
function deleteUser($id_utilisateur){
    global $connexion_bd;
    $requete="delete from utilisateurs where id_utilisateur = :id_utilisateur";
    $requetePreparee=$connexion_bd->prepare($requete);
    $requetePreparee->execute([
        ':id_utilisateur' => $id_utilisateur
    ]);
}
function deletePasswordRecupByUser($id_utilisateur) {
    global $connexion_bd;
    $requete = "DELETE FROM password_recup WHERE id_utilisateur = :id_utilisateur";
    $requetePreparee = $connexion_bd->prepare($requete);
    $requetePreparee->execute([':id_utilisateur' => $id_utilisateur]);
}
?>