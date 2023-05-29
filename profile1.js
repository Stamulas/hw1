let Count=0;


const overlay = document.getElementById("overlay");
overlay.classList.add("hidden");




function BookingForm(event){
  

box=document.querySelector(".form");
box.classList.remove('hidden');
title =box.querySelector('.title input');
title.value=event.currentTarget.querySelector(".info strong").textContent;

}

function eliminaEvento(event){
const id_evento=event.currentTarget.dataset.id;
const box = document.querySelector("ul");
box.innerHTML="";
console.log(id_evento);


fetch("agenda_del.php?q="+id_evento).then(fetchResponse).then(fetchAgenda);
event.preventDefault();
}

function fetchSongs() {
        fetch("fetch_movie.php").then(fetchResponse).then(fetchMoviesJson);
}


function fetchResponse(response) {
    if (!response.ok) {return null};
    return response.json();
}

function onJsonAgenda(json){
  console.log(json);
   const lista=document.querySelector("ul");
   for (evento of json){
     const li = document.createElement("li");
     const id = document.createElement("h4");
     const nome = document.createElement("span");
     const cinema = document.createElement("span");
     const orario = document.createElement("em");
     const data = document.createElement("date");
     const descrizione = document.createElement("span");
     id.textContent="ID prenotazione :"+evento.id;
     descrizione.textContent="Titolo film :"+evento.titolo;
     data.textContent="Data Prenotazione : "+evento.data1;
     orario.textContent="Orario :"+evento.orario;
     nome.textContent= "Nome :"+evento.nome;
     cinema.textContent = "Cinema= "+evento.cinema;
     const elimina = document.createElement("a");
     elimina.href="#";
     elimina.dataset.id=evento.id;
     elimina.textContent="Elimina prenotazione";
     elimina.classList.add("delete");
     elimina.addEventListener("click",eliminaEvento);
     li.appendChild(id);
     li.appendChild(nome);
     li.appendChild(orario);
     li.appendChild(data);
     li.appendChild(descrizione);
     li.appendChild(cinema);
     li.appendChild(elimina);
     lista.appendChild(li);
   }
}

function fetchAgenda(){
  fetch("agenda.php").then(fetchResponse).then(onJsonAgenda);
  
}



function fetchMoviesJson(json) {
    console.log("Fetching...");
    console.log(json);
    if (!json.length) {noResults(); return;}
    
    const container = document.getElementById('results');
    container.innerHTML = '';
    Count=json.length;

    

    for (let movie in json) {
        const card = document.createElement('div');
        card.dataset.id = json[movie].content.id;
        card.classList.add('movie');
        const movieInfo = document.createElement('div');
        movieInfo.classList.add('movieInfo');
        card.appendChild(movieInfo);
        const img = document.createElement('img');
        img.src = json[movie].content.image;
        movieInfo.appendChild(img);
        const infoContainer = document.createElement('div');
        infoContainer.classList.add("infoContainer");
        movieInfo.appendChild(infoContainer);
        const info = document.createElement('div');
        info.classList.add("info");
        infoContainer.appendChild(info);
        const name = document.createElement('strong');
        name.innerHTML = json[movie].content.title;
        info.appendChild(name);
        container.appendChild(card);
        card.addEventListener('click',BookingForm);
        }
        
        
}
function jsonPreferences(json){

box=document.querySelector("#preferences");
const text=document.createElement("p");

const genere=json[0].genere;
text.textContent="Sei un amante del genere "+genere;
box.appendChild(text);
}

function fetchPreferences(){
  fetch("fetch_preferences.php").then(fetchResponse).then(jsonPreferences);
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



fetchSongs();
fetchAgenda();
fetchPreferences();