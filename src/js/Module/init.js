import "splitting/dist/splitting.css"

import { isMobile } from "./Helper";
import Splitting from "splitting";
import { appearTitle } from "./animations/animation";
import { charSplit } from './animations/text-animation';
import { createLazyLoad, destroyLazyLoad } from "./animations/lazyLoad";


import { menu1, menuClose, preventReload } from "./menu/menu";
menu1();


const pagelinks = document.querySelectorAll("header a[href], .menu-wrapper a[href]");
pagelinks.forEach(link => link.addEventListener("click", preventReload));


var swiperSliders = [];
import { Slider } from "./sliders/slider";




/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            Init  👉 after() & Once()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/


function init() {
    createLazyLoad();    
    charSplit();
    appearTitle();
    Splitting();


    const sliders = document.querySelectorAll(".slider");
    sliders.forEach((slider) => {
        const sliderSwiper = slider.querySelector(".swiper");
        const slides = slider.getAttribute("data-slides");
        const slsw = new Slider(sliderSwiper, slides);
        swiperSliders.push(slsw);
    });


}



function initBeforeEnter() {
    window.scrollTo(0, 0);
    menuClose();
}



function destroyBeforeLeave() {
    swiperSliders.forEach(slider => { slider?.destroy() });
    swiperSliders.length = 0;
    destroyLazyLoad();
}

export { init, initBeforeEnter, destroyBeforeLeave }