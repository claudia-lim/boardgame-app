import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const faveButtons = document.querySelectorAll(".fave-toggle-button");
faveButtons.forEach((faveButton) => {
    faveButton.addEventListener("click", () => {
        faveButton.classList.toggle("fa-regular");
        faveButton.classList.toggle("fa-solid");
    })

}
);

