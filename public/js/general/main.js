/**
 * Background dropdown sidebar focused while dropdown-menu opened
 */
let buttons = document.querySelectorAll('.sidebar_butttons');

for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", function () {
        buttons[i].classList.toggle('bg-blue-200');
        buttons[i].classList.toggle('shadow');
    })
}

document.addEventListener('DOMContentLoaded', function() {
    window.scrollTo(0, 0);
});
