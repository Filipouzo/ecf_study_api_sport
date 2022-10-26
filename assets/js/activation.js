

// fonction toggle du Bouton switch validé 
window.onload = () => {
  let activer = document.querySelectorAll('.inputUser')
  for(let bouton of activer){
    bouton.addEventListener("click",function(){
        let xmlhttp = new XMLHttpRequest;
        xmlhttp.open("get", `/administrateur/activer/${this.dataset.id}`)
        xmlhttp.send()
    })
  }
  
  let activerGlobalOption = document.querySelectorAll('.inputGlobalOption')
  for(let boutonOptionGlobal of activerGlobalOption){
    boutonOptionGlobal.addEventListener("click",function(){
        let xmlhttp = new XMLHttpRequest;
        xmlhttp.open("get", `GlobalOption/${this.dataset.id}`)
        xmlhttp.send()
    })
  }
}

