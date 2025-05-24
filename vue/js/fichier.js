// Récupère tous les boutons radio du formulaire qui ont l’attribut name="profil" (c’est-à-dire "particulier", "groupe" et "professionnel").
const radios = document.querySelectorAll('input[name="profil"]');

// deux radio.value ( particulier et groupe)
  const sections = {
    particulier: document.getElementById('formParticulier'),
    groupe: document.getElementById('formGroupe'),
  };
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
document.addEventListener('DOMContentLoaded', () => {
  const selected = document.querySelector('input[name="profil"]:checked');
  if (selected) {
    Object.keys(sections).forEach(key => {
      sections[key].style.display = (selected.value === key) ? 'block' : 'none';
    });
    updateFooterPositionnement(); // recalcul si nécessaire
  }
});
const toggle = document.getElementById('menu-toggle');
const menu = document.getElementById('menu');
toggle.addEventListener('click', () => {
  menu.classList.toggle('active');
});
const mainAccueil=document.querySelector('#mainAccueil');
mainAccueil.classList.add("accueil");
const body = document.querySelector('body');

document.getElementById("modalFormConnexion").classList.add("display-none");
document.getElementById("modalFormInscription").classList.add("display-none");
document.getElementById("modalFormRedefinitionMotDePasse").classList.add("display-none");
document.getElementById("modalConditionsUtilisation").classList.add("display-none");
document.getElementById("modalFormMotDePasseOublie").classList.add("display-none");
document.getElementById("modalFormRechercheAvancee").classList.add("display-none");
document.getElementById("modalDetailsEvenement").classList.add("display-none");


const connexion = document.getElementById("connexion");
 heightMainDepart=parseFloat(getComputedStyle(mainAccueil).height)


// La méthode getBoundingClientRect() est une fonction JavaScript intégrée qui permet de récupérer la position et la taille d’un élément dans la fenêtre (viewport).
function updateFooterPositionnement() {

const footer=document.querySelector('footer');
//  heightFooter=parseFloat(getComputedStyle(footer).height);
heightFooter=80;
 
// let heightMainWithModal=parseFloat(getComputedStyle(mainAccueil).height);
document.querySelectorAll('.modal').forEach(modal => {

  if (modal.classList.contains('display-block')) {
      console.log(heightMainDepart);
      
    let modalHeight = parseFloat(getComputedStyle(modal).height);
    console.log(modalHeight);
     if (modalHeight>heightMainDepart){
      heightMainWithModal=modalHeight;
      console.log(heightMainWithModal);

     }
  }
})

paddingMain=50;
// console.log("heightMainWithModal",heightMainWithModal);
// console.log("heightFooter",heightFooter);

heightMainWithModal=heightMainWithModal+heightFooter;
// console.log("heightMainWithModal",heightMainWithModal);
// heightMainWithModal=heightMainWithModal+heightFooter+paddingMain;
// const header=document.querySelector('header');
//  let heightHeader=parseFloat(getComputedStyle(header).height);
//  let height= heightMainWithModal+heightHeader;
mainAccueil.style.minHeight=heightMainWithModal+"px";
mainAccueil.style.height=heightMainWithModal+"px";

 
 
}

document.querySelectorAll('input[name="profil"]').forEach(radio => {
  radio.addEventListener('change', () => {
    updateFooterPositionnement(); // on met à jour la hauteur du main
  });
});

document.querySelectorAll(".openModalLinkConnexion").forEach(element => {

  element.addEventListener("click", function (e) {
      console.log("connexion");
    e.preventDefault(); // empêche le lien de naviguer ailleurs

    // Cacher tous les modals
    document.querySelectorAll('.modal').forEach(modal => {
      if (modal.classList.contains('display-block')) {
        modal.classList.add('display-none');
        modal.classList.remove('display-block');
      }
    
    });

    // Afficher le modal de connexion
    document.getElementById("modalFormConnexion").classList.remove("display-none");
    document.getElementById("modalFormConnexion").classList.add("display-block");

    // Modifier les classes du body et du main
    body.classList.add("accueilWithoutModalAndResearch");
    mainAccueil.classList.add("accueil");
    mainAccueil.classList.remove("accueilDuringOpeningModal");

    // Recalculer la hauteur du footer
    updateFooterPositionnement();
  });
});

document.querySelectorAll(".openModalLinkInscription").forEach(element => {
  element.addEventListener("click", function (e) {
    e.preventDefault(); // empêche le lien de naviguer ailleurs

    // Cacher tous les modals
    document.querySelectorAll('.modal').forEach(modal => {
           if (modal.classList.contains('display-block')) {
        modal.classList.add('display-none');
        modal.classList.remove('display-block');
      }
    

    });

    // Afficher le modal de connexion
    document.getElementById("modalFormInscription").classList.remove("display-none");
    document.getElementById("modalFormInscription").classList.add("display-block");

    // Modifier les classes du body et du main
    body.classList.remove("accueilWithoutModalAndResearch");
    mainAccueil.classList.remove("accueil");
    mainAccueil.classList.add("accueilDuringOpeningModal");

    // Recalculer la hauteur du footer
    updateFooterPositionnement();
  });
});



document.getElementById("openModalLinkMotDePasseOublie").addEventListener("click", function (e) {
   
  e.preventDefault(); // empêche le lien de naviguer ailleurs
  document.querySelectorAll('.modal').forEach(modal => {
         if (modal.classList.contains('display-block')) {
        modal.classList.add('display-none');
        modal.classList.remove('display-block');
      }
    
});

  document.getElementById("modalFormMotDePasseOublie").classList.add("display-block");
  document.getElementById("modalFormMotDePasseOublie").classList.remove("display-none");
      body.classList.add("accueilWithoutModalAndResearch");
    mainAccueil.classList.add("accueil");
    mainAccueil.classList.remove("accueilDuringOpeningModal");
     updateFooterPositionnement();
 
});


document.getElementById("openModalConditionsUtilisation").addEventListener("click", function (e) {
  e.preventDefault(); // empêche le lien de naviguer ailleurs
  document.querySelectorAll('.modal').forEach(modal => {
         if (modal.classList.contains('display-block')) {
        modal.classList.add('display-none');
        modal.classList.remove('display-block');
      }

});
   body.classList.remove("accueilWithoutModalAndResearch");
  document.getElementById("modalConditionsUtilisation").classList.add("display-block");
  
    body.classList.add("accueilWithoutModalAndResearch");
    mainAccueil.classList.add("accueil");
    mainAccueil.classList.remove("accueilDuringOpeningModal");
     updateFooterPositionnement();
});

document.getElementById("closeModalBtn").addEventListener("click", function () {

    document.getElementById("modalFormConnexion").classList.add("display-block");
    document.getElementById("modalFormConnexion").classList.remove("display-none");


});

window.addEventListener("click", function (e) {
  const modal = document.getElementById("modalForm");
  if (e.target === modal) {
    modal.style.display = "none";
  }
});