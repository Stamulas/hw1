function fetchComingSoon() {
    fetch("search_incoming.php").then(fetchResponse).then(fetchIncomingJson);
    
}
function fetchResponse(response) {
    if (!response.ok) {return null};
    return response.json();
}
function getDate(data){
    const d = new Date(data);
    const d1 = new Date();
    const difftime = Math.abs(d-d1);
    const diffdays = Math.ceil(difftime/(1000*60*60*24));
    
    return diffdays;
}
function fetchIncomingJson(json) {
    console.log("Fetching...");
    console.log(json);
    if (!json.items.length) {noResults(); return;}
    
    const container = document.getElementById('results');
    container.innerHTML = '';
    container.className = 'movie';
    result =json.items;
    for (let i = 0;i<result.length;i++) {
        const card = document.createElement('div');
         const data = result[i];
         const id= data.id;
         const title = data.title;
         const image = data.image;
         const genres = data.genres;
         const release =data.releaseState;
         const idcontainer = document.createElement('h1');
         const titlecontainer = document.createElement('h2');
         const genrecontainer = document.createElement('p');
         const releasecontainer = document.createElement('date');
         const dayscontainer = document.createElement('p');
         const imagecontainer = document.createElement('img');
         titlecontainer.classList.add("title");
         
         genrecontainer.textContent=genres;
         releasecontainer.textContent=release;
         dayscontainer.textContent=getDate(releasecontainer.textContent) + " giorni all'uscita";
         idcontainer.textContent=id;
         titlecontainer.textContent=title;
         imagecontainer.src=image;
         card.appendChild(genrecontainer);
         card.appendChild(releasecontainer);
         card.appendChild(dayscontainer);
         card.appendChild(idcontainer);
         card.appendChild(titlecontainer);
        card.appendChild(imagecontainer);
       
        idcontainer.classList.add("hidden");
       card.classList.add('movie');
       container.appendChild(card)
       const button= document.querySelector(".incoming");
       button.removeEventListener('click',fetchComingSoon);
        }
     
      }


function noResults() {
    // Definisce il comportamento nel caso in cui non ci siano contenuti da mostrare
    const container = document.getElementById('results');
    container.innerHTML = '';
    const nores = document.createElement('div');
    nores.className = "nores";
    nores.textContent = "Nessun risultato.";
    container.appendChild(nores);
  }

  const button= document.querySelector(".incoming");
  button.addEventListener('click',fetchComingSoon);