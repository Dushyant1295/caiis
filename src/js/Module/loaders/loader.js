import "./loader.scss";
import { gsap } from "gsap";



function loader() {
  const tl = gsap.timeline({ delay: 0 });


  tl.to(".loading-text span", {
    opacity: 1,
    duration: 0.5,
    stagger: 0.05,
    ease: "power1.inOut",
  });


  tl.to(".loading-text span", {
    opacity: 0,
    delay:1
  });

  tl.to(".bluee", {
    duration: 1,
    attr: {
      d: "M0 502S175 272 500 272s500 230 500 230V0H0Z",
    },
    ease: "power2.in",
  },"<");

  tl.to(".bluee", {
    duration: 1.1,
    attr: {
      d: "M0 2S175 1 500 1s500 1 500 1V0H0Z",
    },
    ease: "power2.out",
  });

  tl.set(".load__container", {
    display: "none",
  });

}

export { loader };







/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        DOM  👉 include/loaders/loader.php
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/