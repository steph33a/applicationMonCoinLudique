
// A   Partie Validation des formulaires

const voirMDPCheckbox = document.getElementById('voirMDPInscription');
  const motDePasseInput = document.getElementById('motDePasseInscription');
if (voirMDPCheckbox) {
  voirMDPCheckbox.addEventListener('change', () => {
    motDePasseInput.type = voirMDPCheckbox.checked ? 'text' : 'password';
  });
}

  // Pour le champ "Confirmation du mot de passe"
  const voirConfMDPCheckbox = document.getElementById('voirConfMPDInscription');
  const confirmationMotDePasseInput = document.getElementById('confirmationMotDePasseInscription');
if (voirConfMDPCheckbox) {
  voirConfMDPCheckbox.addEventListener('change', () => {
    confirmationMotDePasseInput.type = voirConfMDPCheckbox.checked ? 'text' : 'password';
  });
}

  const voirMDPCheckboxConnexion = document.getElementById('voirMDPConnexion');
  const motDePasseInputConnexion = document.getElementById('motDePasseConnexion');

if (voirMDPCheckboxConnexion) {
  voirMDPCheckboxConnexion.addEventListener('change', () => {
    motDePasseInputConnexion.type = voirMDPCheckboxConnexion.checked ? 'text' : 'password';
  });
}

let photoInput=document.getElementById('photoInput');
if (photoInput) {
photoInput.addEventListener('change', function (e) {
    
    // On récupère le premier fichier sélectionné par l'utilisateur
    const file = e.target.files[0];

    // Si aucun fichier sélectionné, on arrête la fonction
    if (!file) return;

    // Liste des types MIME autorisés (formats d'image acceptés)
    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
     // Taille maximale autorisée : 2 Mo (2 * 1024 * 1024 octets)
    const maxSizeInBytes = 2 * 1024 * 1024;
    
    let  indexInput;

    // Si le type du fichier n'est pas dans la liste autorisée, on alerte l'utilisateur
    if (!allowedTypes.includes(file.type)) {
       // Ajouter à validChamps si pas déjà dedans
         indexInput = validChamps.indexOf("imageProfil");
        if (indexInput !== -1) {
          validChamps.splice(indexInput, 1);
        }
        alert('Veuillez sélectionner une image au format JPEG, PNG ou WEBP.');
        e.target.value = ''; // On réinitialise le champ fichier pour forcer une nouvelle sélection
        return; // On quitte la fonction
    } else if (file.size > maxSizeInBytes) {
        alert('La taille de l’image ne doit pas dépasser 2 Mo.');
        e.target.value = ''; // Réinitialisation du champ
        indexInput = validChamps.indexOf("imageProfil");
        if (indexInput !== -1) {
          validChamps.splice(indexInput, 1);
        }
    } else {
       if (!validChamps.includes("imageProfil")) {
          validChamps.push("imageProfil");
        }
    }

    // Création d’un FileReader pour lire le fichier localement
    const reader = new FileReader();

    // Quand le fichier est lu avec succès
    reader.onload = function (e) {
        // On insère l'image lue (en base64) dans la balise <img> ayant la classe 'photo-preview'
        document.querySelector('.photo-preview').src = e.target.result;
    };

    // Lecture du fichier sous forme de DataURL (base64), nécessaire pour afficher un aperçu
    reader.readAsDataURL(file);
});
}
let imageEventInput=document.getElementById('imageEventInput');

if (imageEventInput) {
imageEventInput.addEventListener('change', function (e) {

    
    // On récupère le premier fichier sélectionné par l'utilisateur
    const file = e.target.files[0];

    // Si aucun fichier sélectionné, on arrête la fonction
    if (!file) return;

    // Liste des types MIME autorisés (formats d'image acceptés)
    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
     // Taille maximale autorisée : 2 Mo (2 * 1024 * 1024 octets)
    const maxSizeInBytes = 2 * 1024 * 1024;
    let  indexInput;

    // Si le type du fichier n'est pas dans la liste autorisée, on alerte l'utilisateur
    if (!allowedTypes.includes(file.type)) {
      console.log(validChamps);
       // Ajouter à validChamps si pas déjà dedans
         indexInput = validChamps.indexOf("imageEvent");
        if (indexInput !== -1) {
          validChamps.splice(indexInput, 1);
        }
        alert('Veuillez sélectionner une image au format JPEG, PNG ou WEBP.');
        e.target.value = ''; // On réinitialise le champ fichier pour forcer une nouvelle sélection
        return; // On quitte la fonction
    } else if (file.size > maxSizeInBytes) {
        alert('La taille de l’image ne doit pas dépasser 2 Mo.');
        e.target.value = ''; // Réinitialisation du champ
        indexInput = validChamps.indexOf("imageEvent");
        if (indexInput !== -1) {
          validChamps.splice(indexInput, 1);
        }
    } else {
       if (!validChamps.includes("imageEvent")) {
          validChamps.push("imageEvent");
        }
    }

    // Création d’un FileReader pour lire le fichier localement
    const reader = new FileReader();

    // Quand le fichier est lu avec succès
    reader.onload = function (e) {
        // On insère l'image lue (en base64) dans la balise <img> ayant la classe 'photo-preview'
        document.querySelector('.imageEvent-preview').src = e.target.result;
    };

    // Lecture du fichier sous forme de DataURL (base64), nécessaire pour afficher un aperçu
    reader.readAsDataURL(file);
});}

function showTextComment(classIdentification,text){
  console.log("showTextComment");
  // Cette fonction montre juste le commentaire et met le display on 
  let element=document.querySelector("."+classIdentification);
  if (element){
    element.textContent=text;
    if (!element.classList.contains("displayBlock")) {
      element.classList.add("displayBlock");
      
    }
    if (element.classList.contains("displayNone")) {
      element.classList.remove("displayNone");
    }
  }
}
function removeTextComment(classIdentification){
 let element = document.querySelector("."+classIdentification);
 console.log("element".$element);
  if (element) {
    element.textContent = "";

    if (element.classList.contains("displayBlock")) {
      element.classList.remove("displayBlock");
    }
    if (!element.classList.contains("displayNone")) {
      element.classList.add("displayNone");
    }
  } else {
    console.warn(`Élément .${classIdentification} introuvable`);
  }
}
function cleanChampValue(classChamp,champValue){
  console.log("classChamp",classChamp);
  let champTocleanChampValue=["dateNaissance","numberPhoneEvent","pseudo","email","motDePasse","confirmationMotDePasse","emailEvent","codePostalEvent","numRueEvent","nbParticipants","ageRequis"];
  if (champTocleanChampValue.includes(classChamp)) {
     champValue= champValue.trim();
  } else {
     champValue= champValue;
  }
 
  return champValue;
}
function champFormulaireIsValid(classInput,champValue) {
  console.log("classInput125 ",classInput);
  console.log("champValue126",champValue);
  // champ pour vérification des événements 
  if ((classInput === "villeEvent") || (classInput === "url1") || (classInput === "url2")|| (classInput === "rueEvent")||(classInput === "jeuxThemesEvent") || (classInput === "titre")|| (classInput === "recurrence")) return ( champValue.length >= 3) ? true : false;;
  
  if (classInput === "typeSoiree") {
  const valeursAutorisees = ["createur", "classique", "thematique"];
  return valeursAutorisees.includes(champValue.trim().toLowerCase());
}
if (classInput === "role") {
  const rolesAutorises = ["admin", "particulier", "groupe", "modérateur"];
  return rolesAutorises.includes(champValue.trim().toLowerCase());
}
  switch (classInput) {
    
    case "numberPhoneEvent":
       //vérification 10 de longueur et que des chiffres
      //fonction Si la valeur n'est pas un nombre valide, la fonction retourne true
     return ((champValue.length == 10)&&!isNaN(champValue)) ?  true : false; //champValue.length == 10 ? true : false;

    case "codePostalEvent":
      return ((champValue.length === 4) && !isNaN(champValue)) ? true : false;

    case "ageRequis":
      return (!isNaN(champValue)) ? true : false;  
    case "nbParticipants":
      return (!isNaN(champValue)) ? true : false;
    case "heureEvent":
      {
        const regexHeure = /^([01]\d|2[0-3]):[0-5]\d$/;
        return regexHeure.test(champValue);
      }
      
    case "dateEvent":
      {
        // Vérifie que la date existe et est au bon format AAAA-MM-JJ
        const regexDate = /^\d{4}-\d{2}-\d{2}$/;

        if (!regexDate.test(champValue)) return false;

        // Convertir la valeur en objet Date
        const dateEvent = new Date(champValue);
        const aujourdHui = new Date();

        // Mettre à 00:00:00 pour ignorer l'heure dans la comparaison
        dateEvent.setHours(0, 0, 0, 0);
        aujourdHui.setHours(0, 0, 0, 0);

        // Vérifier que la date n'est pas dans le passé
        return dateEvent >= aujourdHui;

      }

 
    case "emailEvent":
      return (champValue.includes("@") && champValue.includes(".")&& champValue !== "") ? true : false;
    // champ pour l'inscription et la connexion
    case "email":
      return (champValue.includes("@") && champValue.includes(".")&& champValue !== "") ? true : false;
    case "pseudo":
      // vérification en ternaire
      return (champValue.length >= 3) ? true : false;
      // Données non obligatoires
     case "nomUtilisateur":
      // vérification en ternaire
      return ( champValue.length >= 3) ? true : false;
     case "prenomUtilisateur":
    //   // vérification en ternaire
       return ( champValue.length >= 3) ? true : false;
    case "motDePasse":
    // [^a-zA-Z0-9]/.test(champValue)/ TESTER SI IL EXISTE BIEN UN CARACTERE TOUT SAUF A-Z? a-z ET 0_9
      return ((champValue.length >= 8)&& /[A-Z]/.test(champValue) && /[0-9]/.test(champValue) && /[^a-zA-Z0-9]/.test(champValue)) ? true : false;

    case "role":
      return (champValue === "particulier" || champValue === "groupe" || champValue === "moderateur" || champValue === "administrateur") ? true : false;
    // Donnée non obligatoires
   case "dateNaissance":

     // vérification en ternaire
      return  (/^\d{4}-\d{2}-\d{2}$/.test(champValue)) ? true : false;
    case "jeuPrefereUser":
      return (champValue.length >= 3) ? true : false;
    case "chanteurPrefereUser":
      return (champValue.length >= 3) ? true : false;
      default:
  return false;
  
    }
  return false;
}
function commentaireAfficher(classInput,champValue) {
  
  let motDePasse=document.querySelector(".motDePasse");
  if (champValue==="") {
    return "";
  }
if ((classInput === "url1") || (classInput === "url2")|| (classInput === "rue")||(classInput === "jeuxThemesEvent") || (classInput === "titre")|| (classInput === "recurrence")) return ( champValue.length >= 3) ? "champ correct": "champ incorrect au moins 3 caractères";
if (classInput === "typeSoiree") {
    const typesAutorises = ["createur", "classique", "thematique"];
    return typesAutorises.includes(champValue.trim().toLowerCase())
      ? "champ correct"
      : "Type de soirée invalide (créateur, classique, thématique)";
  }
// Cas de valeurs autorisées pour role
  if (classInput === "role") {
    const rolesAutorises = ["admin", "particulier", "groupe", "modérateur"];
    return rolesAutorises.includes(champValue.trim().toLowerCase())
      ? "champ correct"
      : "Rôle invalide (admin, particulier, groupe, moderateur)";
  }
  // console.log("commentiare afficher idChamp",idChamp);
  switch (classInput) {
      case "numberPhone":
  // pour chaque élément je retourne un commentaire mais pour le moment j'en met que un seul
{
    if (champValue === "") return "Le numéro de téléphone est obligatoire.";
    if (isNaN(champValue)) return "Le numéro de téléphone doit contenir uniquement des chiffres.";
   if (champValue.length !== 10) return "Le numéro de téléphone doit contenir exactement 10 chiffres.";
    break;
}


    case "codePostal":
    {
      if (champValue === "") return "Le code postal est obligatoire.";
      if (isNaN(champValue)) return "Le code postal doit contenir uniquement des chiffres.";
      if (champValue.length !== 4) return "Le code postal doit contenir exactement 4 chiffres.";
     
    }  
      break;

    case "ageRequis":
      {
        if (isNaN(champValue)) return "L'age requis doit contenir uniquement des chiffres.";
      
      }
      break;
    case "nbParticipants":
      {
         if (isNaN(champValue)) return "Le nombre de participants doit contenir uniquement des chiffres.";
         
      }
      break;
      
    case "heureEvent":
      {
        if (champValue === "") return "L'heure est obligatoire.";
        if (isNaN(champValue)) return "L'heure doit contenir uniquement des chiffres.";
        const regexHeure = /^([01]\d|2[0-3]):[0-5]\d$/;
        if (!regexHeure.test(champValue)) return "L'heure doit avoir le format HH:MM.";
        

      } break;
      
    case "dateEvent":
      {
        // Vérifie que la date existe et est au bon format AAAA-MM-JJ
        const regexDate = /^\d{4}-\d{2}-\d{2}$/;

        if (!regexDate.test(champValue)) return "La date doit être au format AAAA-MM-JJ.";

        // Convertir la valeur en objet Date
        const dateEvent = new Date(champValue);
        const aujourdHui = new Date();

        // Mettre à 00:00:00 pour ignorer l'heure dans la comparaison
        dateEvent.setHours(0, 0, 0, 0);
        aujourdHui.setHours(0, 0, 0, 0);
        if (isNaN(dateEvent.getTime())) return "date invalide";
        if (dateEvent < aujourdHui) return "la date est dans le passé";
       
        

        // Vérifier que la date n'est pas dans le passé
   

      } break;
    case "email":
      if (champValue === "") return "L'adresse mail est obligatoire.";
      if (!champValue.includes("@") || !champValue.includes(".")) return "L'adresse mail doit contenir un '@' et un '.'";
      
   break;
   case "pseudo":
      if (champValue === "") return "Le prénom est obligatoire.";
    if (champValue.length <3 ) return "Le prénom doit contenir au moins 2 caractères.";
  
   break;
     case "nomUtilisateur":
    
     if (champValue.length < 3) return "nomU Utilisateur au moins 3 caractères.";

   break;
   case "prenomUtilisateur":
    if (champValue.length < 3) return "Le prénom doit contenir au moins 2 caractères.";
  
     break;
  case "dateNaissance":
    if (!/^\d{4}-\d{2}-\d{2}$/.test(champValue) && champValue !== "") return "Le format de la date est incorrect (AAAA-MM-JJ).";
   break;

    
    
    case "motDePasse":
        // [^a-zA-Z0-9]/.test(champValue)/ TESTER SI IL EXISTE BIEN UN CARACTERE TOUT SAUF A-Z? a-z ET 0_9
      if (champValue === "") return "Le mot de passe est obligatoire.";
      if (champValue.length < 8) return "Le mot de passe doit contenir au moins 8 caractères.";
      if (!/[A-Z]/.test(champValue)) return "Le mot de passe doit contenir au moins une majuscule.";
      if (!/[0-9]/.test(champValue)) return "Le mot de passe doit contenir au moins un chiffre.";
      if (!/[^a-zA-Z0-9]/.test(champValue)) return "Le mot de passe doit contenir au moins un caractère special.";
      break;
    
    
   case "confirmationMotDePasse":
          // SI le mot de passe et la confirmation sont identiquES
       if (champValue !== motDePasse.value) return "Les mots de passe doivent correspondre.";
       break;
     
    case "jeuPrefereUser":
      if (champValue === "") return "La réponse à cette question  est obligatoire.";
    if (champValue.length < 2) return "une réponse de plus de 2 caractères.";
     break;
    case "chanteurPrefereUser":
      if (champValue === "") return "Le prrenom est obligatoire.";
      if (champValue.length < 2) return "une réponse de plus de 2 caractères.";

     break;
     default:
  return "Champ non reconnu.";
    //  default:
    //   return "Champ non reconnu."; 
  }
  return "champ correct";
}
  
function appliquerStyleValidChamps(validChamps, inputs) {
  inputs.forEach(element => {
    // Trouve la classe "clé" dans la liste listInputs
    let listInputs = ["pseudo","email","motDePasse","confirmationMotDePasse","nomUtilisateur","prenomUtilisateur","dateNaissance","jeuPrefereUser","chanteurPrefereUser"];
    let classInput = Array.from(element.classList).find(cls => listInputs.includes(cls));

    if (classInput) {
      if (validChamps.includes(classInput)) {
        // Champ valide : ajouter validChamp, enlever invalidChamp
        if (!element.classList.contains("validChamp")) {
          element.classList.add("validChamp");
        }
        if (element.classList.contains("invalidChamp")) {
          element.classList.remove("invalidChamp");
        }
      } else {
        // Si on veut gérer aussi le cas où il n'est pas valide, on peut ici inverser
        if (element.classList.contains("validChamp")) {
          element.classList.remove("validChamp");
        }
        if (!element.classList.contains("invalidChamp")) {
          element.classList.add("invalidChamp");
        }
      }
    }
  });
}
 function findAllInputs(formulaire) {
  let listInputs=[];
   if (formulaire.id=="formulaireInscription")  {
        listInputs = ["pseudo","email","motDePasse","confirmationMotDePasse","nomUtilisateur","prenomUtilisateur","role","imageProfil"];
      } else if (formulaire.id=="formulaireConnexion")  {
        listInputs=["email","motDePasse"];
      }
     else if (formulaire.id=="formulaireLoginAsUser") {
 listInputs=["pseudo"];
  }
      else if (formulaire.id=="formulaireMotDePasseOublie") {
        listInputs=["email","jeuPrefereUser","chanteurPrefereUser"];
      } else if (formulaire.id=="formulaireCreationEvenement") {
       listInputs=["heureEvent","dateEvent","discussionGroupEvent","url1","url2","emailEvent","numberPhoneEvent","codePostalEvent","villeEvent","numRueEvent","rueEvent","jeuxThemesEvent","titreEvent","typeSoiree","reccurenceEvent","nbParticipants","ageRequis","imageEvent"]
   
      }  else if (formulaire.id=="formulaireRedefinitionMotDePasse") {
        listInputs=["email","motDePasse","confirmationMotDePasse"];
      } 
  return listInputs;

 } 
function findAllIndispensablesInputs(formulaire) {

// let elementIndispensableInscription=["imageProfil","pseudo","email","motDePasse","confirmationMotDePasse","cocherConditionsUtilisation","role"];

// let elementIndispensableMotDePasseOublie=["email","jeuPrefereUtilisateur","chanteurPrefereUser"];
// let elementIndispensableCreateEvent = ["mail","codePostal","ville","rue","numAdresse","heureEvent","typeSoiree","nbParticipants","imageEvent"];
  let listInputsIndispensables =[];
  if (formulaire.id=="formulaireInscription")  {
    listInputsIndispensables = ["pseudo","email","motDePasse","nomUtilisateur","imageProfil","confirmationMotDePasse","role"];
  } else if (formulaire.id=="formulaireConnexion")  {
   listInputsIndispensables=["email","motDePasse"];
  } else if (formulaire.id=="formulaireLoginAsUser") {
 listInputsIndispensables=["pseudo"];
  }
    else if (formulaire.id=="formulaireMotDePasseOublie") {
    listInputsIndispensables=["email","jeuPrefereUser","chanteurPrefereUser"];
} else if (formulaire.id=="formulaireCreationEvenement") {
  listInputsIndispensables=["emailEvent","dateEvent","heureEvent","typeSoiree","nbParticipants","imageEvent"];
  // listInputsIndispensables= ["mail","codePostal","ville","rue","numAdresse","heureEvent","typeSoiree","nbParticipants","imageEvent"];
  // listInputsIndispensables= ["mail","codePostal","ville","rue","numAdresse","heureEvent","typeSoiree","nbParticipants","imageEvent"];
} else if (formulaire.id=="formulaireRedefinitionMotDePasse") {
  listInputsIndispensables=["email","motDePasse","confirmationMotDePasse"];
}
return listInputsIndispensables;
}

// Dans la fonction fichier.js
let inputs = document.querySelectorAll('input, select, textarea');
  inputs.forEach(element => {
    // Chaque élément <input>, <select>, <textarea> a une propriété .form qui renvoie directement le formulaire auquel il appartient, ou null s’il n’en a pas.
      if (element.type === "file") {
          return "";
          // Traiter le fichier si besoin
        } 
    console.log("element279",element);
    element.addEventListener("input", function() {

      let formulaire = element.form; // c’est le formulaire parent
      console.log("formulaire",formulaire);
      // renvoie la liste des éléments input se trouvant   dans le formulaire en question (ici une liste de classes)

      let listInputs=findAllInputs(formulaire);
      let tableauIndispensablesInputs=findAllIndispensablesInputs(formulaire);
      console.log(formulaire ? formulaire.id : 'Pas dans un formulaire');
      console.log("listInputs",listInputs);
      // recherche la classe de l'input parmis les clases des inputs à formater et pour voir après si il y a une correspondance avec les champs obligatoires
      let classInput = Array.from(element.classList).find(cls => listInputs.includes(cls));
      if (!classInput) return; // On sort si pas de classe correspondante
      console.log("classInput279",classInput); 
      let champValue=formulaire.querySelector("."+classInput).value;
      

      champValue = cleanChampValue(classInput,champValue);
      console.log("champValue287",champValue);
      let classCommentaire = classInput + "Commentaire";
      let success = champFormulaireIsValid(classInput, champValue);

      console.log("success289",success);

      if (champValue === "" && !tableauIndispensablesInputs.includes(classInput)) {
        console.log("success429",success);
        success = true;
      }
      if (classInput === "confirmationMotDePasse") {
        let motDePasse = formulaire.querySelector(".motDePasse").value;
        let confirmationMotDePasse = formulaire.querySelector(".confirmationMotDePasse").value;
        if (motDePasse === confirmationMotDePasse) {
          success = true;
           console.log("success289",success);
        } else {
          success = false;
        }
      }
      if (!success) {
        // Affiche le commentaire d'erreur
        let commentaireErreur = commentaireAfficher(classInput, champValue);
        showTextComment(classCommentaire, commentaireErreur);

        // Retirer de validChamps si présent
        let indexInput = validChamps.indexOf(classInput);
        if (indexInput !== -1) {
          validChamps.splice(indexInput, 1);
        }

      } else {
        console.log(classCommentaire);

        if (classCommentaire!=""){
           removeTextComment(classCommentaire);
        }
        // Supprime le commentaire d'erreur
       

        // Ajouter à validChamps si pas déjà dedans
        if (!validChamps.includes(classInput)) {
          validChamps.push(classInput);
        }
      }
      // Mise à jour des styles CSS en fonction de validChamps
      appliquerStyleValidChamps(validChamps, inputs);

    });
  });



  function toggleFormSections() {
    
 const checkbox = document.getElementById('profilParticulier');
  const formParticulier = document.getElementById('formParticulier');
  const formGroupe = document.getElementById('formGroupe');
  if (!checkbox || !formParticulier || !formGroupe) {
    return; // on quitte discrètement si quelque chose manque
  }
   const isParticulier = document.getElementById('profilParticulier').checked;
  if (isParticulier) {
  

    formParticulier.querySelectorAll('input').forEach(input => input.disabled = false);
    formGroupe.querySelectorAll('input').forEach(input => input.disabled = true);
  } else {


    formParticulier.querySelectorAll('input').forEach(input => input.disabled = true);
    formGroupe.querySelectorAll('input').forEach(input => input.disabled = false);
  }
}

// initialisation
toggleFormSections();

// gestion changement radio
document.querySelectorAll('input[name="role"]').forEach(radio => {
  radio.addEventListener('change', toggleFormSections);
});



// Déclaration des variables globales
let pseudoCommentaire;
let emailCommentaire;
let motDePasseCommentaire;
let confirmationMotDePasseCommentaire;
let dateNaissanceCommentaire;
let nomUtilisateurCommentaire;
let prenomUtilisateurCommentaire;
// let numberPhoneCommentaire;
let idElement;

const body = document.querySelector('body');
  //  selection des éléments du dom importants et stokage dans une variable
let btnInscription=document.querySelector("#btnInscription");
let btnRedefinitionMotDePasse=document.querySelector("#btnRedefinitionMotDePasse");
let btnConnexion=document.querySelector("#btnConnexion");
let btnMotDePasseOublie=document.querySelector("#btnMotDePasseOubie");
const connexion = document.getElementById("connexion");
let mainAccueil=document.querySelector("#mainAccueil");
if (mainAccueil) {
  mainAccueil.classList.add("accueil");
  
 heightMainDepart=parseFloat(getComputedStyle(mainAccueil).height)
}

let formInscriptionCommentaire = document.querySelector("#formInscriptionCommentaire");
let formConnexionCommentaire = document.querySelector("#formInscriptionCommentaire");
let formulaireMotDePasseOublieCommentaire=document.querySelector("#formulaireMotDePasseOublieCommentaire");
let boutonRedefinitionMotDePasse = document.querySelector('button[name="btnRedefinitionMotDePasse"]');
let formulaireRedefinitionMotDePasse=document.querySelector("#formulaireRedefinitionMotDePasse");
let formulaireCreationEvenement=document.querySelector("#formulaireCreationEvenement");
let boutonCreationEvenement = document.querySelector('button[name="btnCreationEvenement"]');
let boutonConnexion = document.querySelector('button[name="btnConnexion"]');
let formulaireConnexion=document.getElementById('formulaireConnexion');
let formulaireLoginAsUser=document.getElementById('formulaireLoginAsUser');
let formulaireMotDePasseOublie=document.getElementById('formulaireMotDePasseOublie');
let divCreateEventForGroupe=document.querySelector(".divCreateEventForGroupe");
// let listeClassInputsCreateEvent=["mail","champLibre","url","numberPhone","codePostal","ville","rue","numAdresse","heureEvent","dateEvent","typeSoiree","ageRequis","nbParticipants"];
 
     

let commentaireErreur;
let validChamps=[];
let modalFormConnexion=document.getElementById("modalFormConnexion");
let modalFormInscription=document.getElementById("modalFormInscription");
// modalFormRedefinitionMotDePasse=document.getElementById("modalFormRedefinitionMotDePasse");
let modalFormConditionsUtilisation=document.getElementById("modalFormConditionsUtilisation");
let modalFormMotDePasseOublie=document.getElementById("modalFormMotDePasseOublie");
let modalFormRechercheAvancee=document.getElementById("modalFormRechercheAvancee");
let modalDetailsEvenement=document.getElementById("modalDetailsEvenement");

if (modalFormConnexion) {
  modalFormConnexion.classList.add("displayNone");
}
if (modalFormInscription) {
  modalFormInscription.classList.add("displayNone");
}
// document.getElementById("modalFormRedefinitionMotDePasse").classList.add("displayNone");
if (modalFormConditionsUtilisation) { 

modalFormConditionsUtilisation.classList.add("displayNone");
}
if (modalFormMotDePasseOublie) {
modalFormMotDePasseOublie.classList.add("displayNone");
}
if (modalFormRechercheAvancee) {
modalFormRechercheAvancee.classList.add("displayNone");
}
if (modalDetailsEvenement) {

modalDetailsEvenement.classList.add("displayNone");
}




let formulaireInscription=document.getElementById('formulaireInscription');


if (formulaireInscription) {
  // let boutonInscription = document.querySelector('#btnInscription');
formulaireInscription.addEventListener('submit', function (e) {
 
        const roleRadios = document.querySelectorAll('input[name="role"]');
        let roleSelected = false;
        roleRadios.forEach(radio => {
            if (radio.checked) {
                roleSelected = true;
            }
        });
        if (roleSelected) {
              if (!validChamps.includes("role")) {
              validChamps.push("role");
            }
        } else {
            let indexInput = validChamps.indexOf("role");
            if (indexInput !== -1) {
              validChamps.splice(indexInput, 1);
            }
        }
        const cocherConditionsUtilisation = document.getElementById("cocherConditionsUtilisation");
        if (cocherConditionsUtilisation.checked) {
           if (!validChamps.includes("cocherConditionsUtilisation")) {
              validChamps.push("cocherConditionsUtilisation");  
           }
    
        } else {
           let indexInput = validChamps.indexOf("cocherConditionsUtilisation");
            if (indexInput !== -1) {
              validChamps.splice(indexInput, 1);
            }
        }
        
        let elementIndispensableInscription=findAllIndispensablesInputs(formulaireInscription);
       const champsInvalides = elementIndispensableInscription.filter(champ => !validChamps.includes(champ));

        if (champsInvalides.length > 0) {
              e.preventDefault();
          alert("Champs obligatoires incomplets ou incorrects :\n- " + champsInvalides.join("\n- "));
          return;
        }
       console.log("envoi du formulaire");

        // Si tout est OK, on peut envoyer le formulaire
        // formulaireInscription.requestSubmit(boutonInscription);
      });
    }

    
    if (formulaireConnexion) {
formulaireConnexion.addEventListener('submit', function (e) {
        let elementIndispensableConnexion=findAllIndispensablesInputs(formulaireConnexion);
       
       const champsInvalides = elementIndispensableConnexion.filter(champ => !validChamps.includes(champ));

        if (champsInvalides.length > 0) {
           e.preventDefault();
          alert("Champs obligatoires incomplets ou incorrects :\n- " + champsInvalides.join("\n- "));
          return;
        }

        // Si tout est OK, on peut envoyer le formulaire
        // formulaireConnexion.requestSubmit(boutonConnexion);
      });
    }
        if (formulaireLoginAsUser) {
          console.log("formulaireLoginAsUser");
formulaireLoginAsUser.addEventListener('submit', function (e) {
   console.log("submit");

        let elementIndispensableConnexionAdmin=findAllIndispensablesInputs(formulaireLoginAsUser);
       
       const champsInvalides = elementIndispensableConnexionAdmin.filter(champ => !validChamps.includes(champ));
        
           
        if (champsInvalides.length > 0) {
           e.preventDefault();
          alert("Champs obligatoires incomplets ou incorrects :\n- " + champsInvalides.join("\n- "));
          return;
        }
        

        // Si tout est OK, on peut envoyer le formulaire
        // formulaireConnexion.requestSubmit(boutonConnexion);
      });
    }
//     Quand tu cliques sur le bouton submit (ou que tu appelles submit), le navigateur déclenche l’événement submit avant d’envoyer le formulaire.

// Le code dans le listener submit est exécuté AVANT l’envoi effectif.


if (formulaireCreationEvenement) {
formulaireCreationEvenement.addEventListener('submit', function (e) {

      if (divCreateEventForGroupe) {
            listInputsIndispensablesCreateEvent= ["emailEvent","numberPhoneEvent","codePostalEvent","villeEvent","rueEvent","numRueEvent","titreEvent","heureEvent","typeSoiree","nbParticipants","imageEvent"];
        
          } else{
             listInputsIndispensableCreateEvent=findAllIndispensablesInputs(formulaireCreationEvenement);
        }
    
     let champsInvalides = listInputsIndispensableCreateEvent.filter(champ => !validChamps.includes(champ));

    if (champsInvalides.length > 0) {
       e.preventDefault();
          alert("Champs obligatoires incomplets ou incorrects :\n- " + champsInvalides.join("\n- "));
          return;
        }
        // Si tout est OK, on peut envoyer le formulaire
        // formulaireCreationEvenement.requestSubmit(boutonCreationEvenement);
      });
    }

if (formulaireRedefinitionMotDePasse) {
      formulaireRedefinitionMotDePasse.addEventListener('submit', function (e) {
              console.log("630");
        console.log("validChamps",validChamps);
      
          const champEmail = formulaireRedefinitionMotDePasse.querySelector('input[name="email"]');
        if (champEmail && (champEmail.value.trim() !== "")) {
           validChamps.push("email");
           console.log("validChamps",validChamps);
        }
        let elementIndispensableRedefinitionMotDePasse=findAllIndispensablesInputs(formulaireRedefinitionMotDePasse);
        const champsInvalides = elementIndispensableRedefinitionMotDePasse.filter(champ => !validChamps.includes(champ));

     

    if (champsInvalides.length > 0) {
        e.preventDefault();
          alert("Champs obligatoires incomplets ou incorrects :\n- " + champsInvalides.join("\n- "));
          return;
        }
        // formulaireRedefinitionMotDePasse.requestSubmit(boutonRedefinitionMotDePasse);
        
      })
  }
      if (formulaireMotDePasseOublie) {
      formulaireMotDePasseOublie.addEventListener('submit', function (e) {
  
       
        let elementIndispensableFormulaireMotDePasseOublie=findAllIndispensablesInputs(formulaireMotDePasseOublie);
        const champsInvalides =  elementIndispensableFormulaireMotDePasseOublie.filter(champ => !validChamps.includes(champ));

     

    if (champsInvalides.length > 0) {
        e.preventDefault();
          alert("Champs obligatoires incomplets ou incorrects :\n- " + champsInvalides.join("\n- "));
          return;
        }
        // formulaireRedefinitionMotDePasse.requestSubmit(boutonRedefinitionMotDePasse);
        
      })
    }

//Quand l'utilisateur sélectionne un fichier (input type="file") avec l’id photoInput, cette fonction est déclenchée.

// On écoute l'événement 'change' sur le champ fichier avec l'ID 'photoInput'


// Récupère tous les boutons radio du formulaire qui ont l’attribut name="profil" (c’est-à-dire "particulier", "groupe" et "professionnel").


const radios = document.querySelectorAll('input[name="role"]');

// deux radio.value ( particulier et groupe)
  const sections = {
    particulier: document.getElementById('formParticulier'),
    groupe: document.getElementById('formGroupe'),
  };

document.querySelectorAll('input[name="role"]').forEach(radio => {
  radio.addEventListener('change', () => {
    adjustModalSpacers();
  });
});

if (radios) {
// On parcourt toutes les sections, et on affiche (display: 'block') uniquement celle qui correspond à la valeur sélectionnée (radio.value)
  radios.forEach(radio => {
    radio.addEventListener('change', () => {
      // récupère les keys de l'objet section ( donc particulier ou groupe)
      Object.keys(sections).forEach(key => {
        // si radio.value vaut particulier alors la section[particulier] est affichée
        sections[key].style.display = (radio.value === key) ? 'block' : 'none';
      });
    });
  });
  
// Affiche directement la section correspondant au radio coché par défaut



  const selected = document.querySelector('input[name="role"]:checked');
  if (selected) {
    Object.keys(sections).forEach(key => {
      sections[key].style.display = (selected.value === key) ? 'block' : 'none';
    });
    
  }
}
const toggle = document.getElementById('menu-toggle');
const menu = document.getElementById('menu');
toggle.addEventListener('click', () => {
  menu.classList.toggle('active');
});




// La méthode getBoundingClientRect() est une fonction JavaScript intégrée qui permet de récupérer la position et la taille d’un élément dans la fenêtre (viewport).



function afficherFormulaireCreationEvenement(){

    let formulaireCreationEvenement=document.getElementById("formulaireCreationEvenement");
    // Afficher le modal de connexion
    formulaireCreationEvenement.classList.remove("displayNone");
    formulaireCreationEvenement.classList.add("displayBlock");
    attacherEcouteurs("formulaireCreationEvenement",elementIndispensableCreateEvent);

  
}



document.querySelectorAll(".openModalLinkConnexion").forEach(element => {

  element.addEventListener("click", function (e) {
      console.log("connexion");
    e.preventDefault(); // empêche le lien de naviguer ailleurs

    // Cacher tous les modals
    document.querySelectorAll('.modal').forEach(modal => {
      if (modal.classList.contains('displayBlock')) {
        modal.classList.add('displayNone');
        modal.classList.remove('displayBlock');
      }
    
    });
  
    modalFormConnexion=document.getElementById("modalFormConnexion");
    // Afficher le modal de connexion
    modalFormConnexion.classList.remove("displayNone");
    modalFormConnexion.classList.add("displayBlock");
    formulaireConnexion=document.getElementById("formulaireConnexion");
// setTimeout(() => {
//   attacherEcouteurs("formulaireConnexion", elementIndispensableConnexion);
// }, 5);

    // attacherEcouteurs("modalFormConnexion",elementIndispensableConnexion);
    // Modifier les classes du body et du main
    // body.classList.add("accueilWithoutModalAndResearch");
    // mainAccueil.classList.add("accueil");
    // mainAccueil.classList.remove("accueilDuringOpeningModal");

    // Recalculer la hauteur du footer
    adjustModalSpacers();
    validChamps = [];
  });
});

document.querySelectorAll(".openModalLinkInscription").forEach(element => {
  element.addEventListener("click", function (e) {
    e.preventDefault(); // empêche le lien de naviguer ailleurs

    // Cacher tous les modals
    document.querySelectorAll('.modal').forEach(modal => {
           if (modal.classList.contains('displayBlock')) {
        modal.classList.add('displayNone');
        modal.classList.remove('displayBlock');
      }
    

    });
    modalFormInscription=document.getElementById("modalFormInscription");
    // Afficher le modal de connexion
   
    // Afficher le modal de connexion
    modalFormInscription.classList.remove("displayNone");
    modalFormInscription.classList.add("displayBlock");
    
    //  attacherEcouteurs("modalFormInscription",elementIndispensableInscription);

    // Modifier les classes du body et du main
    // body.classList.remove("accueilWithoutModalAndResearch");
    // mainAccueil.classList.remove("accueil");
    // mainAccueil.classList.add("accueilDuringOpeningModal");

    // Recalculer la hauteur du footer
    adjustModalSpacers();
    validChamps = [];
  });
});

let openModalLinkMotDePasseOublie=document.getElementById("openModalLinkMotDePasseOublie")
if (openModalLinkMotDePasseOublie) {
  openModalLinkMotDePasseOublie.addEventListener("click", function (e) {
   
  e.preventDefault(); // empêche le lien de naviguer ailleurs
  document.querySelectorAll('.modal').forEach(modal => {
         if (modal.classList.contains('displayBlock')) {
        modal.classList.add('displayNone');
        modal.classList.remove('displayBlock');
      }
    
      document.getElementById("modalFormMotDePasseOublie").classList.add("displayBlock");
  document.getElementById("modalFormMotDePasseOublie").classList.remove("displayNone");
  // attacherEcouteurs();
  validChamps = [];
    //   body.classList.add("accueilWithoutModalAndResearch");
    // mainAccueil.classList.add("accueil");
    // mainAccueil.classList.remove("accueilDuringOpeningModal");
    adjustModalSpacers();
 
});
});
}

let openModalConditionsUtilisation=document.getElementById("openModalConditionsUtilisation");


if (openModalConditionsUtilisation) {
openModalConditionsUtilisation.addEventListener("click", function (e) {
  e.preventDefault(); // empêche le lien de naviguer ailleurs
  document.querySelectorAll('.modal').forEach(modal => {
         if (modal.classList.contains('displayBlock')) {
        modal.classList.add('displayNone');
        modal.classList.remove('displayBlock');
      }

});
   body.classList.remove("accueilWithoutModalAndResearch");
  document.getElementById("modalConditionsUtilisation").classList.add("displayBlock");
  // attacherEcouteurs();
  
    // body.classList.add("accueilWithoutModalAndResearch");
    // mainAccueil.classList.add("accueil");
    // mainAccueil.classList.remove("accueilDuringOpeningModal");
     adjustModalSpacers();
});}

// document.getElementById("closeModalBtn").addEventListener("click", function () {

//     document.getElementById("modalFormConnexion").classList.add("displayBlock");
//     document.getElementById("modalFormConnexion").classList.remove("displayNone");


// });

// window.addEventListener("click", function (e) {
//   const modal = document.getElementById("modalForm");
//   if (e.target === modal) {
//     modal.style.display = "none";
//   }
// });



function adjustModalSpacers() {
  const wrappers = document.querySelectorAll('.modal-wrapper');

  wrappers.forEach(wrapper => {
    const modal = wrapper.querySelector('.modal');
    const spacer = wrapper.querySelector('.modal-spacer');

    // S'assurer que le modal est visible pour calculer sa taille
    if (modal && spacer) {
      spacer.style.height = modal.offsetHeight + 'px';
    }
  });
}

// Appeler au chargement

const allModals = document.querySelectorAll('.modal');

  adjustModalSpacers();

window.addEventListener('load', adjustModalSpacers);

// Au redimensionnement
window.addEventListener('resize', adjustModalSpacers);

if (allModals) {
  allModals.forEach(modal => {
    modal.addEventListener('change', adjustModalSpacers);
  });
}


    // let formulaireRedefinitionMotDePasse=document.querySelector("#formulaireRedefinitionMotDePasse");
    // let inputsRedefinitionMotDePasse=formulaireRedefinitionMotDePasse.querySelectorAll('input');
   
    // let formulaireMotDePasseOublie=document.querySelector("#formulaireMotDePasseOublie");
    // let inputsMotDePasseOublie=formulaireMotDePasseOublie.querySelectorAll('input');
        // let formulaireConnexion=document.querySelector("#formulaireConnexion");
    // let formulaireInscription=document.querySelector("#formulaireInscription");
    // Selection de tous les inputs du document mais seulement ceux qui ne sont pas disabled pour éviter la soumission de données non voulues
   
    // let inputsInscription=formulaireInscription.querySelectorAll('input:not([disabled])');
    // let inputsConnexion=formulaireConnexion.querySelectorAll('input');

function afficherFormulaireCreationEvenement() {

  if (document.getElementById("content_modalFormCreationEvenement").classList.contains("displayNone")) {
    document.getElementById("content_modalFormCreationEvenement").classList.add("displayBlock");
    document.getElementById("content_modalFormCreationEvenement").classList.remove("displayNone");
  }


}

function afficherFormulaireModificationEvenement() {
    const section = document.getElementById("modificationEvenementContent");

    // Affiche ou masque la section
    if (section.style.display === "none" || section.style.display === "") {
      section.style.display = "block";
    } else {
      section.style.display = "none";
    }
  }

  function confirmerSuppression() {
    return confirm("Êtes-vous sûr de vouloir supprimer cet événement ?");
  }

document.querySelectorAll(".closeModal").forEach(btn => {
  btn.addEventListener("click", () => {
    const idModal = btn.getAttribute("data-target");
    const modal = document.getElementById(idModal);
    if(modal) {
      modal.classList.remove("displayBlock");
      modal.classList.add("displayNone");
    }
  });
});



window.addEventListener('DOMContentLoaded', () => {
  // Dès que le DOM est complètement chargé, on lance cette fonction
 console.log ("986")
  if (modalToOpen) {  // Si la variable modalToOpen contient une valeur non vide 
     console.log ("988")
    //  ferme toutes les modalsvisibles.
    // On cherche toutes les modals qui ont la classe CSS 'displayBlock' (visible)
    document.querySelectorAll('.modal .displayBlock').forEach(modal => {
      // On retire la classe 'displayBlock' pour masquer la modal
      modal.classList.remove('displayBlock');
      // On ajoute la classe 'displayNone' pour cacher la modal via CSS
      modal.classList.add('displayNone');
    });
    console.log ("997")

    // On construit l'id de la modal à ouvrir à partir de modalToOpen
    // Exemple : modalToOpen = "inscription"
    // => "modalForm" + "I" + "nscription" = "modalFormInscription"
    switch (modalToOpen) {
      case "inscription":
        modalToOpen = "modalFormInscription";
        break;
      case "connexion":
        modalToOpen = "modalFormConnexion";
        break;
      
    }
    const modalElement = document.getElementById(modalToOpen);
console.log("modalElement1021",modalElement)
    if (modalElement) { // Si l'élément avec cet ID existe dans le DOM
      // On retire la classe 'displayNone' pour la rendre visible
      if (modalElement.classList.contains('displayNone')) {
        modalElement.classList.remove('displayNone');
      }
      if (modalElement.classList.contains('displayBlock')) {
        modalElement.classList.remove('displayBlock');
      }
     

      // On peut également ajouter une classe au <body> pour modifier le style global de la page,
      // par exemple empêcher le scroll du fond ou appliquer un style spécifique quand une modal est ouverte.
      // document.body.classList.add('accueilWithoutModalAndResearch');
    }
  }
});




// // Dans la fonction fichier.js
// function attacherEcouteurs(idFormulaire,tableauInputIndispensable) {
//  console.log("element274");
 
// let formulaire=document.querySelector("#"+idFormulaire);
//  let inputs=formulaire.querySelectorAll('input:not([disabled])');
//   inputs.forEach(element => {
//     console.log("element279",element);
//     element.addEventListener("input", function() {
//       let classInput = Array.from(element.classList).find(cls => listInputsAccueil.includes(cls));
//       console.log("classInput279",classInput); 
//       let champValue=formulaire.querySelector("."+classInput).value;
   

//       if (!classInput) return; // On sort si pas de classe correspondante

//       champValue = cleanChampValue(classInput,champValue);
//       console.log("champValue287",champValue);
//       let classCommentaire = classInput + "Commentaire";
//       let success = champFormulaireInscriptionAndConnexionIsValid(classInput, champValue);
//       console.log("success289",success);

//       if (champValue === "" && !tableauInputIndispensable.includes(classInput)) {
//         success = true;
//       }
     

//       if (!success) {
//         // Affiche le commentaire d'erreur
//         let commentaireErreur = commentaireAfficherInscriptionEtConnexion(classInput, champValue);
//         showTextComment(classCommentaire, commentaireErreur);

//         // Retirer de validChamps si présent
//         let indexInput = validChamps.indexOf(classInput);
//         if (indexInput !== -1) {
//           validChamps.splice(indexInput, 1);
//         }

//       } else {
//         // Supprime le commentaire d'erreur
//         removeTextComment(classCommentaire);

//         // Ajouter à validChamps si pas déjà dedans
//         if (!validChamps.includes(classInput)) {
//           validChamps.push(classInput);
//         }
//       }
//        // Vérifier que tous les champs indispensables sont valides
//       // Mise à jour des styles CSS en fonction de validChamps
//       appliquerStyleValidChamps(validChamps, inputs);

//     });
//   });


// }


