const menu = document.querySelector("#menu");
menu.addEventListener('click',LinksVisualizer);

function LinksVisualizer(event){
    
    event.currentTarget.removeEventListener('click',LinksVisualizer);
    const links=document.querySelector("#menulinks");
    links.classList.remove("hidden");
    event.currentTarget.addEventListener('click',HideLinks);

}

function HideLinks(event){
    event.currentTarget.removeEventListener('click',HideLinks);
    const links=document.querySelector("#menulinks");
    links.classList.add("hidden");
    menu.addEventListener('click',LinksVisualizer);


}