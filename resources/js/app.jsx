// import './bootstrap';
// import Alpine from 'alpinejs';
import { createInertiaApp } from '@inertiajs/react';
import { createRoot } from 'react-dom/client';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true })
        return pages[`./Pages/${name}.jsx`]
    },
    setup({ el, App, props }) {
        console.log('create root')
        createRoot(el).render(<App {...props} />)
    },
});

// window.Alpine = Alpine;
// Alpine.start();

// const faveButtons = document.querySelectorAll(".fave-toggle-button");
// faveButtons.forEach((faveButton) => {
//     faveButton.addEventListener("click", () => {
//         faveButton.classList.toggle("fa-regular");
//         faveButton.classList.toggle("fa-solid");
//     })
// }
// );

// const toggleCommentsButton = document.querySelector(".toggle-comments");
// const publicComments = document.querySelector('.public-comments');
// const userComments = document.querySelector('.user-comments');
//
// toggleCommentsButton.addEventListener("click", () => {
//     if (toggleCommentsButton.innerHTML === "Display Public Comments") {
//         toggleCommentsButton.innerHTML = "Display Your Comments"
//     } else {
//         toggleCommentsButton.innerHTML = "Display Public Comments"
//     }
//     publicComments.classList.toggle("hidden");
//     userComments.classList.toggle("hidden");
// })
