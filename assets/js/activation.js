

// A l'appui sur le bouton switch, le controleur Activer est appelé avec l'id de l'utilisateur 
window.onload = () => {
  let activer = document.querySelectorAll('.inputUser')
  for(let bouton of activer){
    bouton.addEventListener("click",function(){
        let xmlhttp = new XMLHttpRequest;
        xmlhttp.open("get", `/administrateur/activerUser/${this.dataset.id}`)
        xmlhttp.send()
    })
  }
  
  // A l'appui sur le bouton switch, le controleur Activer est appelé avec l'id de l'option globale
  let activerGlobalOption = document.querySelectorAll('.inputGlobalOption')
  for(let boutonOptionGlobal of activerGlobalOption){
    boutonOptionGlobal.addEventListener("click",function(){
        let xmlhttp = new XMLHttpRequest;
        xmlhttp.open("get", `/administrateur/activerGlobalOption/${this.dataset.id}`)
        xmlhttp.send()
    })
  }

    // A l'appui sur le bouton switch, le controleur Activer est appelé avec l'id de l'option
  let activerOption = document.querySelectorAll('.inputOption')
  for(let boutonOption of activerOption){
    boutonOption.addEventListener("click",function(){
        let xmlhttp = new XMLHttpRequest;
        xmlhttp.open("get", `/administrateur/activerOption/${this.dataset.id}`)
        xmlhttp.send()
    })
  }
}

