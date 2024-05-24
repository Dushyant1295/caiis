import LazyLoad from "vanilla-lazyload";
import {
    textScramble,
    appearY,
    growB,
    dtextAni,
    dtextAni2,
    dtextAni3,
    paraReveal,
    imgReveal,
    imgRevealLeft,
    imgRevealRight
} from "./animation";

var lazyObj;

function createLazyLoad() {
    lazyObj = new LazyLoad({
        elements_selector: "[data-dpk-call]",
        thresholds: "0% 0% -15% 0%",
        unobserve_entered: true, // fn execute only once
        callback_enter: executeLazyFunction,
    });
}

function destroyLazyLoad() {
    lazyObj.destroy();
}

function executeLazyFunction(element) {
    const funName = element.getAttribute("data-dpk-call");
    const lazyFunction = window.lazyFunctions[funName];
    if (!lazyFunction) return;
    lazyFunction(element);
}

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     Lazy Functions will invoded on  Viewport
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

window.lazyFunctions = {
    textScr(el) {
        textScramble(el);
    },
    appearY(el) {
        appearY(el);
    },
    growB(el) {
        growB(el);
    },

    dtext(el) {
        dtextAni(el);
    },

    dtext2(el) {
        dtextAni2(el);
    },

    dtext3(el) {
        dtextAni3(el);
    },

    counter(el) {
        const countSpan = el.querySelector(".counter span");
        let counter = 0;

        function updateCounter(){
            if (counter <= 60) {
                countSpan.textContent = `${counter}%`;
                counter++;
                setTimeout(updateCounter, 25);
            }
        }
        updateCounter()
    },

    paraR(el) {
        paraReveal(el);
    },
    imgR(el) {
        imgReveal(el, 2);
    },

    imgL(el) {
        imgRevealLeft(el, 2);
    },

    imgRight(el) {
        imgRevealRight(el, 2);
    },
};

export { createLazyLoad, destroyLazyLoad };
