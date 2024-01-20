<template>
    <div @scroll="handleScrolling" class="allSections text-prim overflow-x-hidden overflow-y-scroll">

        <the-header @section-header-on-view="changePos"></the-header>
        <the-about @section-about-on-view="changePos"></the-about>
        <the-work @section-work-on-view="changePos"></the-work>
        <the-stack @section-stack-on-view="changePos"></the-stack>
        
        <div class="hexagon-wrapper position-fixed pe-none" :class="positionClass">
            <div class="relative-wrapper position-relative">
                <menu-hexa id="hexamenu_about" :pos="menu_position" icon-type="fa-regular fa-user" link-to="#section-the-about" text="Who am i?"></menu-hexa>
                <menu-hexa id="hexamenu_work" :pos="menu_position" icon-type="fa-solid fa-laptop-code" link-to="#section-the-work" text="My Work"></menu-hexa>
                <menu-hexa id="hexamenu_stack" :pos="menu_position" icon-type="fa-solid fa-microchip" link-to="#section-the-stack" text="Tech Stack"></menu-hexa>
                <menu-hexa id="hexamenu_message" :pos="menu_position" icon-type="fa-regular fa-message" link-to="#" text="Message me..."></menu-hexa>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, provide, computed } from "vue";
import TheHeader from "./sections/TheHeader.vue";
import TheAbout from "./sections/TheAbout.vue";
import TheWork from "./sections/TheWork.vue";
import TheStack from "./sections/TheStack.vue";
import MenuHexa from "./menu_hexas/MenuHexa.vue";


// ANIMATE ONSCROLL - USED TO DETERMINE WHEN TO ANIMATE ANIMATED ELEMENTS
let globalScrollvalue = ref(0);
// -- received by: [<TheAbout>, <TextwrapperAbout>, <TheHeader>]:
provide("global-scrollvalue", globalScrollvalue);

// ANIMATE ONSCROLL - RECOMPUTES CURRENT SCROLL VALUE FOR CHILD COMPONENTS TO INJECT
function handleScrolling(e) {
    globalScrollvalue.value = e.target.scrollTop;
}
// HEXAMENU ANIMATION - CLASS-SUFFIX FOR THE MENU HEXAGONS
let menu_position = ref("start");
// -- received by[<MenuHexa>]
provide("menu-position", menu_position);


/** HEXAMENU ANIMATION - CALLBACK FOR WHEN SECTIONS ARE IN VIEWPORT
 *  CHANGES CLASSES FOR MENU HEXAGONS
 * @param {String} val => CLASS-SUFFIX FOR MENU HEXAGONS
 * CLASSES CAN BE:
 *  -- "start"  -> SCROLLY IS ALMOST AT TOP OF DOCUMENT
 *  -- "about"  -> <TheAbout> IS IN VIEWPORT
 *  -- "work"   -> <TheWork> IS IN VIEWPORT
 *  -- "stack"  -> <TheStack> IS IN VIEWPORT */
function changePos(val) {
    menu_position.value = val;
}

let positionClass = computed(() => {
    return "pos-" + menu_position.value;
});
</script>


<style>
.allSections {
    width: 100%;
    height: 100vh;
    scroll-behavior: smooth;
}
.hexagon-wrapper {
    transition: all .2s linear;
}
.hexagon-wrapper.pos-start {
    width: 100%;
    height: 30vh;
    top: 70%;
    left: 0;
}
.hexagon-wrapper.pos-about {
    width: 100%;
    height: 30vh;
    top: 0;
    left: 0;
}
.hexagon-wrapper.pos-work {
    width: 100%;
    /* BECAUSE menuDescWrapper OF <WorkContent> IS 80vh */
    height: 20vh;
    top: 0;
    left: 0;
}
.hexagon-wrapper.pos-stack {
    width: 40%;
    height: 100vh;
    top: 0;
    left: 60%;
}
@media screen and (min-width: 992px) {
    .hexagon-wrapper.pos-start {
        width: 100%;
        height: 100vh;
        top: 0;
        left: 0;
    }
    .hexagon-wrapper.pos-about {
        width: 50%;
        height: 100vh;
        top: 0;
        left: 0;
    }
    .hexagon-wrapper.pos-work {
        width: 50%;
        height: 100vh;
        top: 0;
        left: 50%;
    }
    .hexagon-wrapper.pos-stack {
        width: 40%;
        height: 100vh;
        top: 0;
        left: 60%;
    }
}
</style>