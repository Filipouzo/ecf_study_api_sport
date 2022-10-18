
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

