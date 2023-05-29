
document.querySelector("#search form").addEventListener("submit", search);


  function jsonMovie(json) {
    // svuoto i risultati
    console.log(json);
    const container = document.getElementById('results');
    container.innerHTML = '';
   
    if (!json.results.length) {noResults(); return;}
      const result = json.results;
      
    for (let i = 0;i<result.length;i++) {
    const card = document.createElement('div');
     const data = result[i];
     const id= data.id;
     const title = data.title;
     const image = data.image;
     const genre= data.genreList[0].value;
     const idcontainer = document.createElement('h1');
     const titlecontainer = document.createElement('h2');
     const buttoncontainer = document.createElement('button');
     const imagecontainer = document.createElement('img');
     const genrecontainer = document.createElement('p');
     idcontainer.textContent=id;
     titlecontainer.textContent=title;
     imagecontainer.src=image;
     buttoncontainer.textContent="Salva tra i preferiti!"
     genrecontainer.textContent=genre;
     card.appendChild(idcontainer);
     card.appendChild(titlecontainer);
    card.appendChild(imagecontainer);
    card.appendChild(buttoncontainer);
    card.appendChild(genrecontainer);
    genrecontainer.classList.add("hidden");
    idcontainer.classList.add("hidden");
   card.classList.add('movie');
   container.appendChild(card);
    const button=card.querySelector('button');
  button.addEventListener('click',saveFilm);
    }
 
  }

function noResults() {
  // Definisce il comportamento nel caso in cui non ci siano contenuti da mostrare
  const container = document.getElementById('results');
  container.innerHTML = '';
  const nores = document.createElement('div');
  nores.className = "loading";
  nores.textContent = "Nessun risultato.";
  container.appendChild(nores);
}

function clickLike(event){
  event.stopPropagation();
}

function search(event){
    // Leggo il tipo e il contenuto da cercare e mando tutto alla pagina PHP
    const form_data = new FormData(document.querySelector("#search form"));
    // Mando le specifiche della richiesta alla pagina PHP, che prepara la richiesta e la inoltra
    fetch("search_content.php?q="+encodeURIComponent(form_data.get('search'))).then(searchResponse).then(jsonMovie);
    // Evito che la pagina venga ricaricata
    event.preventDefault();
}

function searchResponse(response){
    console.log(response);
    return response.json();
}


 function saveFilm(event){

   console.log("Salvataggio")
   
  const formData = new FormData();
  id=event.currentTarget.parentNode.querySelector('h1');
  console.log(event.currentTarget.parentNode);
  title=event.currentTarget.parentNode.querySelector('h2');
  img=event.currentTarget.parentNode.querySelector('img');
  genre=event.currentTarget.parentNode.querySelector('p');
  formData.append('id',id.textContent);
  formData.append('title',title.textContent);
  formData.append('image', img.src);
  formData.append('genre',genre.textContent);
  fetch("save_movie.php", {method: 'post', body: formData}).then(dispatchResponse, dispatchError);
  fetch("save_preference.php", {method: 'post', body: formData}).then(dispatchResponse, dispatchError);
   button= event.currentTarget.parentNode.querySelector("button");
   button.textContent="Salvato tra i preferiti!";
 }

 function dispatchResponse(response) {

   console.log(response);
   return response.json().then(databaseResponse); 
 }

 function dispatchError(error) { 
   console.log("Errore");
}

 function databaseResponse(json) {
   if (!json.ok) {
      dispatchError();
      return null;
   }}
 
