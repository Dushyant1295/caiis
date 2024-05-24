import "./smooth-scrollbar.scss";
import SmoothScrollbar from "smooth-scrollbar";
import SoftScrollPlugin from "./SoftScrollPlugin";

SmoothScrollbar.use(SoftScrollPlugin);

var scroll;

function smooth(sContainer) {
    const currentScrollContainer = sContainer.querySelector(
        "[data-scroll-container]"
    );
    scroll = SmoothScrollbar.init(currentScrollContainer, {
        renderByPixels: true,
        damping: 0.075,
    });
}

export { scroll, smooth };



















/*
import DisableScrollPlugin from "./disableScrollPlugin";
import  AnchorPlugin  from "./AnchorPlugin";


 scroll.addListener(({ offset }) => {
            if (!lastOffset) {
                lastOffset = offset;
                return;
            }

            const dir = [];

            if (offset.y < lastOffset.y) {
                dir[0] = 'up';
            } else if (offset.y > lastOffset.y) {
                dir[0] = 'down';
            } else {
                dir[0] = 'still';
            }

            lastOffset = offset;

            switch (dir[0]) {
                case 'up':
                    console.log("up")
                    break;
                case 'down':
                    console.log("down")
                    break;
                case 'still':
                    console.log("stoped")
                    break;
            }

        });



*/
