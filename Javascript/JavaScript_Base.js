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
  