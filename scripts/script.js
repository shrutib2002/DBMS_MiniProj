const body = document.querySelector("body"),
  sidebar = document.querySelector(".sidebar"),
  toggle = document.querySelector(".toggle"),
  modeSwitch = document.querySelector(".toggle-switch"),
  modeText = document.querySelector(".mode-text"),
  searchBtn = document.querySelector(".search-bar"),
  navText = document.querySelectorAll(".nav-link a");
modeSwitch.addEventListener("click", () => {
  body.classList.toggle("dark");
  //   document.querySelector(".mode-text").innertext=""

  if (body.classList.contains("dark")) {
    modeText.innerText = " Light Mode ";
  } else modeText.innerText = " Dark Mode ";
});

sidebar.addEventListener("mouseenter", () => {
  sidebar.classList.remove("close");
});

sidebar.addEventListener("mouseleave", () => {
  sidebar.classList.toggle("close");
});

console.log(navText);
console.log(sidebar.classList.contains("close"));


function func(){
    var email = document.getElementById('email').value;
    var pass = document.getElementById('password').value;
    if(email == 'shruti@gmail.com' && pass == '123'){
        alert("successful !");
        window.location = "./home.html"
    }
    else{
        alert('Invalid entry')
    }
    }