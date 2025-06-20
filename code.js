const header = document.querySelector('.header');

function fixedNavbar() {
    header.classList.toggle('scroll', window.scrollY > 0);
}


fixedNavbar();
window.addEventListener('scroll', fixedNavbar);

let menu = document.querySelector('#menu-btn');
let navbar=document.querySelector('.navbar');
let userBtn = document.querySelector('#user-btn');


menu.addEventListener('click', function () {
    navbar.classList.toggle('active');
});


userBtn.addEventListener('click', function () {
    let userBox = document.querySelector('.user-box');
    userBox.classList.toggle('active');
});