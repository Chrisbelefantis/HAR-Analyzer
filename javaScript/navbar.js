function myFunction() {
    var x = document.getElementById("myLinks");
    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
  
    var navbar=document.getElementById("vnav-brand");
    var menuButton=document.getElementById("menu-button");
    navbar.classList.toggle("opened");
    navbar.classList.toggle("closed");
    menuButton.classList.toggle("opened");
}

var links=document.getElementById("myLinks");
links.style.display = "none";

var url = document.URL;
currentHref = url.split("/").slice(-1)[0];
currentLinks = document.querySelectorAll('a[href="'+currentHref+'"]');

currentLinks.forEach((link)=> {
    link.className += ' current-link'
});