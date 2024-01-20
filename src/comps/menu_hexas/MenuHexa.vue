<template>

    <div :class="positionClass" class="menu-hexa-wrapper position-absolute d-flex justify-content-center align-items-center" ref="hexaWrapper">
        
        <div class="relative-holder position-relative d-flex justify-content-center align-items-center">
            <div class="hexaShadow position-absolute"></div>
            <div class="hexaBackground position-absolute bg-sec-dark"></div>

            <a @click="checkForMessage" :href="props.linkTo" class="iconWrapper text-hexa-menu position-relative d-flex flex-column justify-content-start align-items-center">
                <div class="iconHolder d-flex justify-content-center align-items-center">
                    <fa-icon :icon="props.iconType" class="hexa-icons"></fa-icon>
                </div>
                <div class="linktextHolder mt-1 d-flex justify-content-center align-items-center">
                    {{ text }}
                </div>
            </a>

        </div>

    </div>

</template>

<script setup>
import { ref, inject, computed, defineProps, onMounted } from "vue";
import { useRouter } from "vue-router";
// HEXAMENU APPEARANCE - DEFINES ICON, LINK AND TEXT OF THE PARTICULAR LINKS
let props = defineProps([
    "iconType",
    "linkTo",
    "text",
]);

let router = useRouter();
function checkForMessage(e) {
    let hexa_parent = e.currentTarget.parentElement.parentElement;
    if(hexa_parent.id === "hexamenu_message")
    {
        router.replace({name: "Message"});
    }
}
// HEXAMENU ANIMATION - RECEIVES CLASS-SUFFIX FOR MENU HEXAGONS
// CLASS SUFFIX DETERMINES THEIR POSITION
// -- received by [<AllSections>]
let menuPosition = inject("menu-position");
let positionClass = computed(() => {
    return "hexa-pos-" + menuPosition.value;
});
// HEXAMENU FIRST APPEARANCE - MAKES HEXAGONS SLOWLY FADE IN AT FIRST LOAD OF PAGE
let hexaWrapper = ref();
onMounted(() => {
    hexaWrapper.value.style.opacity = "1";
    hexaWrapper.value.style.pointerEvents = "auto";
});

</script>

<style scoped>
    .linktextHolder {
        transition: all .3s ease;
        font-weight: normal;
        width: 100%;
    }
    .hexa-icons {
        width: 100%;
        height: 100%;
        transition: all .3s ease;
    }
    .iconHolder {
        width: 30%;
        aspect-ratio: 1;
        transition: all .3s ease;
    }
    .iconWrapper {
        width: 100%;
        cursor: pointer;
        text-decoration: none;
    }
    .hexaShadow {
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: black;
        clip-path: polygon(0 20%, 50% 0, 100% 20%, 100% 80%, 50% 100%, 0 80%, 0 20%);
        opacity: .7;
        filter: blur(30px);
    }
    .hexaBackground {
        width: 95%;
        height: 95%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        clip-path: polygon(0 20%, 50% 0, 100% 20%, 100% 80%, 50% 100%, 0 80%, 0 20%);
    }
    .menu-hexa-wrapper {
        top: 0;
        right: 0;
        aspect-ratio: .93;
        transition: transform .2s linear, opacity 1s linear 2.5s;
        opacity: 0;
        pointer-events: none;
    }
    .relative-holder {
        width: 100%;
        height: 100%;
    }
    #hexamenu_stack.menu-hexa-wrapper.hexa-pos-stack .iconWrapper {
        color: var(--tert);
    }
    #hexamenu_work.menu-hexa-wrapper.hexa-pos-work .iconWrapper {
        color: var(--tert);
    }
    #hexamenu_about.menu-hexa-wrapper.hexa-pos-about .iconWrapper {
        color: var(--tert);
    }
    #hexamenu_stack.menu-hexa-wrapper.hexa-pos-stack .iconWrapper .linktextHolder{
        font-weight: 1000;
    }
    #hexamenu_work.menu-hexa-wrapper.hexa-pos-work .iconWrapper .linktextHolder{
        font-weight: 1000;
    }
    #hexamenu_about.menu-hexa-wrapper.hexa-pos-about .iconWrapper .linktextHolder{
        font-weight: 1000;
    }
    #hexamenu_about.menu-hexa-wrapper.hexa-pos-start .iconWrapper .linktextHolder{
        font-weight: normal;
    }
    .linktextHolder {
        font-size: 10px;
    }
    .menu-hexa-wrapper {
        width: 20vw;
    }
    #hexamenu_about.menu-hexa-wrapper.hexa-pos-start {
        transform: translate(-355%, 10%);
    }
    #hexamenu_work.menu-hexa-wrapper.hexa-pos-start {
        transform: translate(-280%, 100%);
    }
    #hexamenu_stack.menu-hexa-wrapper.hexa-pos-start {
        transform: translate(-130%, 100%);
    }
    #hexamenu_message.menu-hexa-wrapper.hexa-pos-start {
        transform: translate(-50%, 10%);
    }
    #hexamenu_about.menu-hexa-wrapper.hexa-pos-about {
        transform: translate(-355%, 10%);
    }
    #hexamenu_work.menu-hexa-wrapper.hexa-pos-about {
        transform: translate(-280%, 110%);
    }
    #hexamenu_stack.menu-hexa-wrapper.hexa-pos-about {
        transform: translate(-130%, 110%);
    }
    #hexamenu_message.menu-hexa-wrapper.hexa-pos-about {
        transform: translate(-50%, 10%);
    }
    #hexamenu_about.menu-hexa-wrapper.hexa-pos-work {
        transform: translate(-385%, 10%);
    }
    #hexamenu_work.menu-hexa-wrapper.hexa-pos-work {
        transform: translate(-280%, 70%);
    }
    #hexamenu_stack.menu-hexa-wrapper.hexa-pos-work {
        transform: translate(-130%, 70%);
    }
    #hexamenu_message.menu-hexa-wrapper.hexa-pos-work {
        transform: translate(-20%, 10%);
    }
    #hexamenu_about.menu-hexa-wrapper.hexa-pos-stack {
        transform: translate(-50%, 100%);
    }
    #hexamenu_work.menu-hexa-wrapper.hexa-pos-stack {
        transform: translate(-50%, 225%);
    }
    #hexamenu_stack.menu-hexa-wrapper.hexa-pos-stack {
        transform: translate(-50%, 350%);
    }
    #hexamenu_message.menu-hexa-wrapper.hexa-pos-stack {
        transform: translate(-50%, 475%);
    }
    @media screen and (min-width: 576px) {
        .linktextHolder {
            font-size: 12px;
        }
        .menu-hexa-wrapper {
            width: 15vw;
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-430%, 10%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-355%, 100%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-205%, 100%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-125%, 10%);
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-425%, 90%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-350%, 10%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-200%, 10%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-120%, 90%);
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-500%, 25%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-350%, 25%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-200%, 25%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-45%, 25%);
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-125%, 110%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-50%, 210%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-50%, 410%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-125%, 310%);
        }
    }
    @media screen and (min-width: 768px) {
        .linktextHolder {
            font-size: 14px;
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-425%, 0%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-350%, 100%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-200%, 100%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-120%, 0%);
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-425%, 110%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-350%, 10%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-200%, 10%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-120%, 110%);
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-500%, 25%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-350%, 25%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-200%, 25%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-45%, 25%);
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-125%, 110%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-50%, 210%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-50%, 410%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-125%, 310%);
        }
    }
    @media screen and (min-width: 992px) {
        .iconWrapper:hover .linktextHolder {
            color: var(--tert);
            font-weight: 1000;
        }
        .iconWrapper:hover .hexa-icons {
            color: var(--tert);
        }
        .iconWrapper:hover .iconHolder {
            width: 35%;
        }
        .menu-hexa-wrapper {
            width: 10vw;
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-350%, 60%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-225%, 160%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-100%, 60%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-100%, 260%);
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-275%, 100%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-125%, 100%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-200%, 200%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-275%, 300%);
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-275%, 100%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-200%, 200%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-125%, 100%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-125%, 300%);
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-200%, 110%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-50%, 110%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-200%, 250%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-50%, 250%);
        }
    }
    @media screen and (min-width: 1200px) {
        .linktextHolder {
            font-size: 16px;
        }
    }
    @media screen and (min-width: 1400px) {
    }
    @media screen and (min-width: 1600px) {
        .menu-hexa-wrapper {
            width: 13vw;
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-350%, 5%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-225%, 105%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-100%, 5%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-start {
            transform: translate(-100%, 225%);
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-235%, 19%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-85%, 10%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-160%, 110%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-about {
            transform: translate(-235%, 210%);
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-235%, 19%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-160%, 110%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-85%, 10%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-work {
            transform: translate(-85%, 210%);
        }
        #hexamenu_about.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-180%, 30%);
        }
        #hexamenu_work.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-30%, 30%);
        }
        #hexamenu_stack.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-180%, 170%);
        }
        #hexamenu_message.menu-hexa-wrapper.hexa-pos-stack {
            transform: translate(-30%, 170%);
        }
    }
</style>