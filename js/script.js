var scrollBtn = document.getElementById('gotoTop');
var navbar = document.getElementById('navbar');
// When the user clicks on the button, scroll to the top of the document
function gotoTop() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

window.onscroll = function () { scrollFunction() };

function scrollFunction() {
  if (window.scrollY > 60) {
    navbar.classList.add('fixed-top');
    navbar.querySelector('.nav-right').classList.remove('d-lg-none');
  } else {
    navbar.classList.remove('fixed-top');
    navbar.querySelector('.nav-right').classList.add('d-lg-none');
  }
}

var date = new Date();
var months = [
  'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
]
var dd = date.getDate();
var mm = months[date.getMonth()];
var yyyy = date.getFullYear();
if (dd % 10 == 1) {
  ddsuffix = "st";
} else if (dd % 10 == 2) {
  ddsuffix = "nd";
} else if (dd % 10 == 3) {
  ddsuffix = "rd";
}
else {
  ddsuffix = "th";
}
var fulldate = dd + ddsuffix + ' ' + mm + ', ' + yyyy;
document.getElementById('date').innerText = fulldate;

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    var response = JSON.parse(xhttp.responseText);
    var address = response['city'] + ', ' + response['country']
    document.getElementById("address").innerHTML = address;
  }
};
xhttp.open("GET", "http://ip-api.com/json", true);
xhttp.send();


divEl = document.getElementById('collapsible-search');

function showSearch() {
  if (divEl.style.display != "flex")
    divEl.style.display = "flex";
  else
    divEl.style.display = "none";
}