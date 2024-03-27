import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// const faveButtons = document.querySelectorAll(".fave-button");
// faveButtons.forEach((faveButton) => faveButton.addEventListener("click", () => {
//     console.log('before', faveButton.dataset.fave);
//     faveButton.setAttribute('data-fave', Number(faveButton.dataset.fave) ? '0' : '1');
//     console.log('after', faveButton.dataset.fave);
// }))

const testButtons = document.querySelectorAll(".test");
testButtons.forEach((testButton) => {
    testButton.addEventListener("click", () => {
        console.log('click');
        testButton.classList.toggle("fa-regular");
        testButton.classList.toggle("fa-solid");
    })

}
);

