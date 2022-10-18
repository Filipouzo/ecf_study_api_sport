

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



