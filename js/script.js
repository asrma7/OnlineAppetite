var scrollBtn = document.getElementById('gotoTop');
var navbar = document.getElementById('navbar');
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 65 || document.documentElement.scrollTop > 65) {
    scrollBtn.style.display = "block";
    navbar.style.position = "fixed";
  } else {
    scrollBtn.style.display = "none";
    navbar.style.position = "absolute";
  }
}

// When the user clicks on the button, scroll to the top of the document
function gotoTop() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}