

// fonction toggle du Bouton switch validé 
window.onload = () => {
  let activer = document.querySelectorAll('.form-check-input')
  for(let bouton of activer){
    bouton.addEventListener("click",function(){
        let xmlhttp = new XMLHttpRequest;
        xmlhttp.open("get", `/administrateur/activer/${this.dataset.id}`)
        xmlhttp.send()
    })
  }
}

// fonction search

