const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.querySelector('.nav-links');
const xiconmenu = document.querySelector('.x-icon-menu');
const ctabtn = document.querySelector('.cta-button');
menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('active');
    menuToggle.style.display = 'none';
    xiconmenu.style.display = 'flex';
    // Check if screen width is at most 786px
    if (window.innerWidth >= 768) {
        menuToggle.style.display = 'none';
    }
    if (window.innerWidth <= 768) {
        ctabtn.style.display = 'flex';
    }
});
xiconmenu.addEventListener('click', () => {
    navLinks.classList.toggle('active');
    xiconmenu.style.display = 'none';
    menuToggle.style.display = 'flex';
    
  
    
});





let lastScrollPosition = 0;
const navigation = document.querySelector('.adventures-navigation');

window.addEventListener('scroll', () => {
  const currentScrollPosition = window.scrollY;

  if (currentScrollPosition > lastScrollPosition) {
    // Hide menu on scroll down
    navigation.style.transform = 'translateY(-100%)';
  } else {
    // Show menu on scroll up
    navigation.style.transform = 'translateY(0)';
  }

  lastScrollPosition = currentScrollPosition;
});