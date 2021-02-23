/**
 * Javascript functions for the Log Lolla Theme
 */

// Click on the hamburger menu
var menuHamburgerClick = function(ID) {
  var menuHamburger = document.querySelector('.menu-hamburger');
  var menuMain = document.querySelector('.header-menu');

  function onViewChange(event) {
    menuMain.classList.toggle('header-menu--closed');
    menuHamburger.classList.toggle('menu-hamburger--closed');
    event.stopPropagation();
  }

  menuHamburger.addEventListener('click', onViewChange, false);
}


// Run functions once the document is ready
document.addEventListener('DOMContentLoaded', function(){
  if (document.querySelector('.menu-hamburger')) {
    menuHamburgerClick('.menu-hamburger');
  }
}, false);
