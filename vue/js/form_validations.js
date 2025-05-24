




  function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === "password" ? "text" : "password";
  }

function showTextComment(idIdentification,text){
  console.log("showTextComment");
  // Cette fonction montre juste le commentaire et met le display on 
  let element=document.querySelector("#"+idIdentification);
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
function removeTextComment(idIdentification){
 let element = document.querySelector("#"+idIdentification);
 if (element) {
    element.textContent="";
 }
 if (element.classList.contains("displayBlock")) {
  element.classList.remove("displayBlock");
}
if (!element.classList.contains("displayNone")) {
  element.classList.add("displayNone");
}
}
function champIsValid(idChamp) {
  let champ=document.querySelector("#"+idChamp);
  let champValue= champ.value.trim();

  switch (idChamp) {
 case "mail":
      return (champValue.includes("@") && champValue.includes(".")&& champValue !== "") ? true : false;
  
 case "username":
      // vérification en ternaire
      return (champValue.length >= 2) ? true : false;
   case "userPrenom":
      // vérification en ternaire
      return (champValue.length >= 2) ? true : false;
  case "motDePasse":
    // [^a-zA-Z0-9]/.test(champValue)/ TESTER SI IL EXISTE BIEN UN CARACTERE TOUT SAUF A-Z? a-z ET 0_9
      return ((champValue.length >= 8)&& /[A-Z]/.test(champValue) && /[0-9]/.test(champValue) && /[^a-zA-Z0-9]/.test(champValue)) ? true : false;
 
  
    }
  return false;
}
function commentaireAfficher(idChamp) {
  let champ=document.querySelector("#"+idChamp);
  let champValue= champ.value.trim();
  let motDePasse=document.querySelector("#motDePasse");
  if (champ.value==="") {
    return "";
  }
  console.log("commentiare afficher idChamp",idChamp);
  switch (idChamp) {
  
    case "username":
      {
        if (champValue.length < 2) 
          {
            return "Le prénom doit contenir au moins 2 caractères.";
          }
          else
          {
            return "champValide";
          }
      }
        case "userPrenom":
      {
        if (champValue.length < 2) 
          {
            return "Le prénom doit contenir au moins 2 caractères.";
          }
          else
          {
            return "champValide";
          }
      }
    
    case "mail":
     {
      if (champValue === "")
        {
          return "L'adresse mail est obligatoire.";
        } 
        else if (!champValue.includes("@") || !champValue.includes(".")) 
        {
          return "L'adresse mail doit contenir un '@' et un '.'";
        }
        else
        {
          return "champValide";
        }
      }

     case "motDePasse":
      {
        if (champValue.length < 8) 
          {
            return "Le mot de passe doit contenir au moins 8 caractères.";
          }
          else if (!/[A-Z]/.test(champValue)) 
          {
            return "Le mot de passe doit contenir au moins une majuscule.";
          }
          else if (!/[0-9]/.test(champValue)) 
          {
            return "Le mot de passe doit contenir au moins un chiffre.";
          }
          else if (!/[^a-zA-Z0-9]/.test(champValue)) 
          {
            return "Le mot de passe doit contenir au moins un caractère special.";
          }
          else
          {
            return "champValide";
          }
         
      }
    
 
    //  default:
    //   return "Champ non reconnu."; 
  }
}

// Déclaration des variables globales

let mailCommentaire;
let motDePasseCommentaire;

  //  selection des éléments du dom importants et stokage dans une variable
    let btnFormulaire=document.querySelector(".btnFormulaire");
    btnFormulaire.disabled=true;
    btnFormulaire.classList.add("disabled");
    let formulaire=document.querySelector(".formulaire");
    // Selection de tous les inputs du document
    let inputs=formulaire.querySelectorAll('.formElement');
    let formLien = document.querySelector("#formLien");
    let formCommentaire = document.querySelector("#formCommentaire");
    
    inputs.forEach(element => {
// J' écoute tous les inputs, chaque fois qu'ils sont modifiés cela appelle la fonction ci dessous
      element.addEventListener("input", function(){
      
        let idInput=element.id; 
        let idCommentaire=idInput+"Commentaire";
        // Vérification de la validité du champ
        let response=champIsValid(idInput);
    
          if (response==false)
          {
            // si invalide j'affiche un commentaire d'erreur
            console.log("idInput",idInput);
            console.log("idCommentaire",idCommentaire);
            //création d'un commentaire d'erreur en fonction de l'erreur dans l'input
            let commentaireErreur=commentaireAfficher(idInput);
            console.log("commentaireErreur",commentaireErreur);
            // fonction pour afficher et modifier ce qu'il y a da,s le champ commentaire de l'input en question
            showTextComment(idCommentaire,commentaireErreur);
          //  J'enlève la classe validChamp et  ajoute la classe invalidChamp à l'input pour ajouter du style si le champ est incorrect
            if (element.classList.contains("validChamp"))
            {
              element.classList.remove("validChamp");
              
            }
            if (!element.classList.contains("invalidChamp"))
            {
              element.classList.add("invalidChamp");
            }
            
          }else
          {
            console.log( "validChamp")
            // enlever le commentaire le faire disparaitre et ajouter une classe pour appliquer un style particulier
            removeTextComment(idCommentaire);

            if (!element.classList.contains("validChamp"))
            {
              element.classList.add("validChamp");
            }
           
            if (element.classList.contains("invalidChamp"))
            {
              element.classList.remove("invalidChamp");
            }
            

          }
          tousValid=false;
          // inputs.length nombre d'élément du tableau d'inputs
          for (let i = 0; i < inputs.length; i++) {
            console.log( inputs[i].classList)
            // vérification que chaque input a la classe validChamp
            if (!inputs[i].classList.contains("validChamp")) {
                console.log("tousValidFalse");
              tousValid = false;
              
            } else {
              console.log("tousValidTrue");
              tousValid = true;
            }

          }
      
          if (tousValid) {
            btnFormulaire.disabled=false;
            btnFormulaire.classList.remove("disabled");
            console.log("tousValid");
          }else {
            btnFormulaire.disabled=true;
            btnFormulaire.classList.add("disabled");
            formCommentaire.textContent = "Inscription réussie";
          formLien.textContent=" se connecter";

          formCommentaire.classList.add("displayBlock");
          formLien.classList.add("displayBlock");
          }
        
      
      }); 
    });
      btnFormulaire.addEventListener("click", function(e) {
        if (!tousValid)
        {
        e.preventDefault();
        }

          
        });
