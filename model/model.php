<?php
include_once 'db.php';
 global $connexion_bd;
function getUser()
{
    $tab=["user1" => "gertrude", "user2" => "Bertrand"];
    return $tab;
}
function getPhrase($phrase)
{
    return $phrase;
}
function getDonnees($phrase)
{
    if (isset($phrase))
    {
        return $phrase;;
    } else
    {
        return "";
    }
}

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


function isValidChamp($typeChamp,$valeurChamp)
{
    // $typeChamp = $typeChamp;
    // $valeurChamp = $valeurChamp;
    if ($valeurChamp == "") {
        return [
            "booleen" => false,
            "phraseEchec" => "Le champ $typeChamp ne peut pas être vide."
        ];
    }
    $isValid=true;
    $phrase="";
    switch ($typeChamp) {
        

        case  "mail":
            {
                 echo "test";
                 ?>
                    <script>
                       console.log("mailinfo"); 
                    </script>
                    <?php
                if (strpos($valeurChamp, '@') === false || strpos($valeurChamp, '.') === false) {
                    
                   return  [
                    "booleen" => false,
                    "phraseEchec" => "mail incorrect"
                   ];
                    ?>
                    <script>
                        console.log("mail incorrect"); 
                    </script>
                    <?php
                    
                } else {
                  return  [
                    "booleen" => true,
                    "phraseEchec" => ""
                  ];
                }
                }  break;
        
        case  "motDePasse":
            {
                 echo "test";
                
                if (!isValidPassword($valeurChamp)) {
                    return  [
                        "booleen" => false,
                        "phraseEchec" => "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère special"
                    ];
            
                    ?>
                    <script>
                       console.log("mot de passe incorrect"); 
                    </script>
                    <?php
                } else {
                  return  [
                    "booleen" => true,
                    "phraseEchec" => ""
                  ];
                } break;
              
        }
     
    };}
        
          

function areValidChamps($listChamps)
{
      ?>
                    <script>
                          var listChamps = <?php echo json_encode($listChamps); ?>;
    console.log("listChamps", listChamps);
                    </script>
                    <?php  
     $isValid=true;
    $phrase="";
    // travail avec le tableau associatif listchamp
    
    if (isset($listChamps["mail"])) {
        echo($listChamps["mail"]);
        if (isValidChamp("mail",$listChamps["mail"])==false){
            $isValid=false;
             echo("mail pas valide");
        }
    }
    if (isset($listChamps["motDePasse"])) {
        echo($listChamps["motDePasse"]);
        if (isValidChamp("motDePasse",$listChamps["motDePasse"])==false){
            echo("mot de passe pas valide");
            $isValid=false;
        }
    }
    
    if ($isValid==false) {
        echo"isnotValid";
        // je renvoie un tableau associatif avec le résultat et la raison de l'échec
        return ["booleen"=>false,"phraseEchec"=>$phrase];
    }else {
        echo"isvalid";
        return ["booleen"=>true,"phraseEchec"=>""];
    }
  
    return true;
  
}

function existInBD($listChampsToTest){

if (isset($listChampsToTest["mail"])) {
    // global $connBDApplicationJeux;
    global $connexion_bd;
   
   
    var_dump($listChampsToTest);
    $motDePasse=$listChampsToTest["motDePasse"];
    echo $motDePasse;
    $mail=$listChampsToTest["mail"];
    echo "mail".$mail;  
   
    $requete="select * from users where email = :mail";
    $requetePreparee= $connexion_bd ->prepare($requete);
// on exécute la requete preparee en remplacant chaque élément de la requete  par sa valeur)
    $requetePreparee->execute([
    ':mail' => $mail
]);
$utilisateur = $requetePreparee->fetch(PDO::FETCH_ASSOC);
var_dump ($utilisateur);
if ($utilisateur && password_verify($motDePasse, $utilisateur['password'])){
    $_SESSION['id'] = $utilisateur["id"];

}}
return true;
}

function existInBDUtilisateur($infoUtilisateur){
        $mail=htmlspecialchars(trim($infoUtilisateur['mail']));
       $motDePasse=htmlspecialchars(trim($infoUtilisateur['motDePasse']));
 
       $listChamps=["mail"=>$mail,"motDePasse"=>$motDePasse];
    //    la premier élément du tableau reçu est le booléen pr dire SI OK LE DEUXIEme est la phrase qui l'accompagne
       $validChamp=[];
       $validChamp=areValidChamps($listChamps);

        if ($validChamp==true)
            // hashagedu mot de passe
            {
                $listChampsToTest=["mail"=>$mail,"motDePasse"=>$motDePasse];
                $responseTest=existInBD($listChampsToTest);
                return $responseTest;
              
                
            }
 }


function itsPossibleToInsert($listChamps)
{
 global $connexion_bd;
    $mail=$listChamps["mail"];
    echo"mail".$mail;
    $motDePasseHash=$listChamps["motDePasseHash"]; 
    echo"motDePasseHash".$motDePasseHash;
    // mettre en guillement les requetes SQL   
    
    $requete="select * from users where  email = :mail || password = :motDePasseHash";
   
    $requetePreparee=$connexion_bd ->prepare($requete);
// on exécute la requete preparee en remplacant chaque élément de la requete  par sa valeur)
    $requetePreparee->execute([
    ':mail' => $mail,
    ':motDePasseHash' => $motDePasseHash
]);

$utilisateur = $requetePreparee->fetch(PDO::FETCH_ASSOC);
if ($utilisateur) {
    return false;
} else {
    return true;
}
}

function InsertInBD($listChamps){
global $connexion_bd;
     echo"in script insertinbd";
    $username=$listChamps["username"];
    $userPrenom=$listChamps["userPrenom"];
    $mail=$listChamps["mail"];
    echo"mail".$mail;
    $motDePasseHash=$listChamps["motDePasseHash"]; 
    $requete="insert into users (nom,prenom,email,password) values (:username,:userPrenom,:mail,:motDePasseHash)";
    $requetePreparee=$connexion_bd->prepare($requete);
    $requetePreparee->execute([
        ':username' => $username,
        ':userPrenom' => $userPrenom,
        ':mail' => $mail,
        ':motDePasseHash' => $motDePasseHash
    ]);
    
    // La fonction lastInsertId()  permet de récupérer l'identifiant auto-incrémenté de la dernière ligne insérée dans la base de données

    // Récupération de l'ID auto-incrémenté
    $id = $connexion_bd->lastInsertId();
    $_SESSION['id'] = $id;

    echo "<script>console.log('ID nouvel utilisateur : $id');</script>";
    sleep(2);
    return true;
}
function InsertInBdUtilisateur ($infoUtilisateur){
    
       $username=htmlspecialchars(trim($infoUtilisateur(['username'])));
       $userPrenom=htmlspecialchars(trim($infoUtilisateur['userPrenom']));
       $mail=htmlspecialchars(trim($infoUtilisateur['mail']));
       $motDePasse=htmlspecialchars(trim($infoUtilisateur['motDePasse']));
       $listChamps=["username"=>$username,"userPrenom"=>$userPrenom,"mail"=>$mail,"motDePasse"=>$motDePasse];

       $validChamp=[];
    
       $validChamp=areValidChamps($listChamps);
        if ($validChamp["booleen"]==true){
            // hashagedu mot de passe
            $motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);
            $listChamps=["username"=>$username,"userPrenom"=>$userPrenom,"mail"=>$mail,"motDePasseHash"=>$motDePasseHash];
            $possibletoInsert=itsPossibleToInsert($listChamps);
            if ($possibletoInsert==true){
                $phrase="";
                InsertInBD($listChamps);  
               
            } else {
                 $phrase=$possibletoInsert["phraseEchec"];
            }
        } else {
             $phrase=$validChamp["phraseEchec"];
        }
         
        }
    function  getBaseDonneesQuizz(){
    
   global $connexion_bd;
  
    $requete="select * from questions";
    $requetePreparee=$connexion_bd->prepare($requete);
// on exécute la requete preparee en remplacant chaque élément de la requete  par sa valeur)
    $requetePreparee->execute();
    $baseDonnees = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($baseDonnees);
    $tableauDonneesQuizz=[];
    $i=0;
    // renvoi du tableau associatif $baseDonnees
    foreach ($baseDonnees as $ligneBd) {
        // ajout dans le tableau associatif $tableauDonnesQuizz des différents importants du quizz afin de le récupérer dans mon jeu
        $tableauDonneesQuizz[$i]=[
            "question"=>$ligneBd["question"],
            "proposition1"=>$ligneBd["option1"],
            "proposition2"=>$ligneBd["option2"],
            "proposition3"=>$ligneBd["option3"],
            "proposition4"=>$ligneBd["option4"],
            "numeroBonneReponse"=>$ligneBd["correct_answer"],
        ];
        $i++;
  
    }
    // var_dump($tableauDonneesQuizz);
    return $tableauDonneesQuizz;
}
function chooseRandomNumbers(){
    $tableauNumero=[];
    for ( $i=0;$i<2;$i++) {
        do {
     $numero=rand(0,9);

      } while (in_array($numero, $tableauNumero));
        
       $tableauNumero[] = $numero; 
    }
     return $tableauNumero;
    }


function getQuizz(){
    $tableauDonneesQuizz=getBaseDonneesQuizz();
    $tableauNumero =chooseRandomNumbers();
    $listeQuestions=[];
    foreach ($tableauNumero as $numero){
       $element=$tableauDonneesQuizz[$numero];
       $listeQuestions[]=$element;
    }
return $listeQuestions;

}
       function sendScoreInBD($idUtilisateur,$jeu,$score){
     global $connexion_bd;
switch ($jeu) {
    case 'quiz':
        {
            $game="quiz";
            $requete="insert into scores (user_id,game,score,date) values (:user_id,:game,:scoreToIntroduce,:date)";  
           
        }break;
       
    case 'mot_melange':
        {
            $game="mot_melange";
            $requete="insert into scores (user_id,game,score,date) values (:user_id,:game,:scoreToIntroduce,:date)";  
           
        }
        break;
       
    case 'nombre':
        {
            $game="nombre";
            $requete="insert into scores (user_id,game,score,date) values (:user_id,:game,:scoreToIntroduce,:date)";  
            
        } 
        break;
}
$requetePreparee=$connexion_bd->prepare($requete);
$requetePreparee->execute([
    ':user_id' => $idUtilisateur,
    ':game' => $game,
    ':scoreToIntroduce' => $score,
    // date et heure au format actuel
    ':date' => date("Y-m-d H:i:s")
    
]);
            
}
function getWordMelange(){
     $tableau=["ordinateur","programmation","developpeur","serveur","logiciel","constructeur","ifapme","formation"]; //ordinateur,programmation, developpeur,serveur, logiciel,constructeur, ifapme
    $numero=rand(0,7);
    $word=$tableau[$numero];
    // transforme en tableau
    $lettres=str_split($word);
    shuffle($lettres);
    $wordMelange = implode("", $lettres); // reconstruit le mot mélangé
    // transformation en tableau de lettre
    
  
   $_SESSION['wordMelange']=$wordMelange;
}



function  getScores(){
    
   global $connexion_bd;
  
    $requete="select * from scores where user_id = :user_id";  
    $requetePreparee=$connexion_bd->prepare($requete);
    
// on exécute la requete preparee en remplacant chaque élément de la requete  par sa valeur)
    $requetePreparee->execute([':user_id' => $_SESSION['id']]);
    $baseDonneesScores = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($baseDonnees);
    $tableauDonneesScores=[];
    $i=0;
    // renvoi du tableau associatif $baseDonnees
    foreach ($baseDonneesScores as $ligneBd) {
        // ajout dans le tableau associatif $tableauDonnesQuizz des différents importants du quizz afin de le récupérer dans mon jeu
        $tableauDonneesScores[$i]=[
            "game"=>$ligneBd["game"],
            "score"=>$ligneBd["score"],
            "date"=>$ligneBd["date"]
        ];
        $i++;
  
    }
    // var_dump($tableauDonneesQuizz);
    return $tableauDonneesScores;
}
?>