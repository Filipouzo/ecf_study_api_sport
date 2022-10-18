

/*  $(document).ready(function () {
    $('#epopupRules').click(function () {

      //Afficher Le titre de popup
        $('#modal-title').html("Modifier profile");

        //path de l'action editer de fos user : formulaire de modification
        var url = '{{ path('fos_user_profile_edit') }}';

        $.ajax({
            type: 'post',
            url: url,
            success: function (data) {
               // résultat de action edit : formulaire inclure dans popup
                $('#modal_detail').html(data);

               //Affichage de nouvelle popup
                $('#dataModal').modal("show");
            }
        });

    });


}); */


/* 
function toggleSound() {
    if ($('.sound').attr('id') == 'soundOn') {
      $('.sound').attr('id', 'soundOff');
      $('.sound').attr('src', './pictures/soundOff.png');
    } else {
      $('.sound').attr('id', 'soundOn');
      $('.sound').attr('src', './pictures/soundOn.png');
    };
  } 
  */


window.onload = () => {
  let activer = document.querySelectorAll('.form-check-input')
  console.log('salut')
  for(let bouton of activer){
    bouton.addEventListener("click",function(){
        let xmlhttp = new XMLHttpRequest;
        xmlhttp.open("get", `/administrateur/activer/${this.dataset.id}`)
        xmlhttp.send()
    })
  }
}



/* window.onload = () => {
  // const filters = document.querySelector('#filters');
  const filtersList = document.querySelector('#filter-select');

  const searchBar = document.getElementById('search-bar');

  const parameters = new URLSearchParams;

  const url = new URL(window.location.href);

  searchBar.addEventListener('input', (event) =>{

      parameters.set('search', event.target.value)

      fetch(url.pathname + "?" + parameters.toString() + "&ajax=1",{
          headers: {
              "X-Requested-With": "XMLHttpRequest"
          }
      })
          .then(response => response.json()).then(data =>{
          const content = document.getElementById('content');
          content.innerHTML = data.content;
      })
          .catch(error => alert(error))
  });



  filtersList.addEventListener('change', (event)=>{

      parameters.set('filtre', event.target.value)

      fetch(url.pathname + "?" + parameters.toString() + "&ajax=1",{
          headers: {
              "X-Requested-With": "XMLHttpRequest"
          }
      })
          .then(response => response.json()).then(data =>{
          const content = document.getElementById('content');
          content.innerHTML = data.content;
      })
          .catch(error => alert(error))
  });

} */


