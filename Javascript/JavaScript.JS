// Carousel
var SlideIndex = 1;
ShowSlides(SlideIndex);
function plusSlide(N) {
  ShowSlides(SlideIndex += N);
}
function currentSlide(N) {
  ShowSlides(SlideIndex = N);
}
function ShowSlides(N) {
  var I; var Slides = document.getElementsByClassName("Slides");
  var Dots = document.getElementsByClassName("Dot");
  if (N > Slides.length) {SlideIndex = 1}
  if (N < 1) {SlideIndex = Slides.length}
  for (I = 0; I < Slides.length; I++) {
    Slides[I].style.display = "none";
  }
  for (I = 0; I < Dots.length; I++) {
    Dots[I].className = Dots[I].className.replace(" Active", "");
  }
  Slides[SlideIndex-1].style.display = "block";
  Dots[SlideIndex-1].className += " Active";
}
// Navbar
var NavSlide = () => {
  var Burger = document.querySelector('.Burger-Menu');
  var Navbar = document.querySelector('.Navbar-Menu');

  // Toggle Navbar
  Burger.addEventListener('click', () => {
    Navbar.classList.toggle('Navbar-Menu-Active');
  // Toggle animation
  Burger.classList.toggle('Toggle');
  });
}
NavSlide();
