import "../css/style.scss";
import 'swiper/css/bundle';

 
import { isMobile } from "./Module/Helper";
import barba from "@barba/core";
import barbaPrefetch from "@barba/prefetch";

import { scroll, smooth } from "./Module/smooth-scrollbar/smoothscrollBar";
 
 import { loader } from "./Module/loaders/loader";


 const loadC = document.querySelector(".load__container");
 if (loadC){
   loader();
 }
 
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    Barba
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

import { init, initBeforeEnter, destroyBeforeLeave } from "./Module/init";
import { appears, disappears } from "./Module/page-transitions/pageTransitions"
import { load } from "cheerio";
 

barba.use(barbaPrefetch);
barba.init({
  schema: { prefix: "data-dpk" },
  debug: true,
  preventRunning: true,

  transitions: [
    {
      name: "dpk-transition",

      once({ next }) {
        if (!isMobile()) smooth(next.container);
        init();
      },

      beforeEnter({ next }) {
        if (!isMobile()) smooth(next.container);
        initBeforeEnter();     
      },


      enter({ next }) {
       appears(next.container, 0.6);        
      },


      after() {
        init();
      },


      beforeLeave() {
        destroyBeforeLeave();
      },

      async leave(data) {
        const done = this.async();
        disappears(data.current.container, 0.8, done);
      },

      afterLeave() {
        if (!isMobile()) scroll.destroy();  
      }

    },
  ],
 
});
















/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
  import { lenisScroll } from "./Module/lenis/lenis";
  if (!isMobile()) lenisScroll();
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

  