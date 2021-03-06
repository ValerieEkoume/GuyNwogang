/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

import $ from 'jquery';
import 'videojs-playlist';

// start the Stimulus application
import './bootstrap';
import { Modal } from 'bootstrap';
import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";




// Permet l'affichage du nom de l'image sélectionnée dans Create et Edit
$('.custom-file-input').on('change', function (e) {
    let inputFile = e.currentTarget;
    $(inputFile).parents().find('.custom-file-label').html(inputFile.files[0].name);
});

const tlm = gsap.timeline({defaults: {ease: "power1.out"}});
tlm.fromTo("nav", {opacity: 0}, { opacity: 1, duration: 1});
tlm.fromTo("#sign", {opacity: 0}, { opacity: 1, duration: 1.5});

// gsap.registerPlugin(ScrollTrigger);
//
// let tl = gsap.timeline({
//     scrollTrigger: {
//         trigger: '.about',
//         start: "top center",
//         toggleActions: "restart none none none",
//
//
//     }
// });
//
//
//
//
// tl.from(".imgabo", { x: 200, opacity: 0, duration: 1.5})
//     .from(".content", { y: 300, opacity: 0, duration: 1}, '-=1')
//
//
//
// tl.from(".content_gears", { y: 300, opacity: 0, duration: 1})
//     .from(".img_gears", { x: 200, opacity: 0, duration: 1.5})




/* --------------  Show Tabs ------------*/
const tabsContainer = document.querySelector(".show-tabs"),
showSection = document.querySelector(".show-section");

tabsContainer.addEventListener("click", (e) =>{
    if(e.target.classList.contains("tab-item") && !e.target.classList.contains("active")){
       tabsContainer.querySelector(".active").classList.remove("active");
       e.target.classList.add("active");
       const target = e.target.getAttribute("data-target");
       showSection.querySelector(".tab-content.active").classList.remove("active");
       showSection.querySelector(target).classList.add("active");
    }
});