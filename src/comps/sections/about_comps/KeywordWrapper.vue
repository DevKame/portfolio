
<template>
    <div class="keywordWrapper d-flex flex-column justify-content-start align-items-center align-items-lg-end pe-xl-0 overflow-hidden" ref="keywordWrapper">

        <div :class="{is_outside: onFirstTimeView}" class="keyWordHolder bg-sec d-flex justify-content-between align-items-center rounded-3 border border-black py-1 py-lg-2 py-xl-2 py-xxl-3 px-2 px-xl-5 my-1 my-md-2 my-xl-2">
            <fa-icon icon="fa-regular fa-user" class="icons"></fa-icon>
            <p class="text-prim m-0">Kamedin</p>
        </div>
        <div :class="{is_outside: onFirstTimeView}" class="keyWordHolder bg-sec d-flex justify-content-between align-items-center rounded-3 border border-black py-1 py-lg-2 py-xl-2 py-xxl-3 px-2 px-xl-5 my-1 my-md-2 my-xl-2">
            <fa-icon icon="fa-solid fa-location-dot" class="icons"></fa-icon>
            <p class="text-prim m-0">Germany</p>
        </div>
        <div :class="{is_outside: onFirstTimeView}" class="keyWordHolder bg-sec d-flex justify-content-between align-items-center rounded-3 border border-black py-1 py-lg-2 py-xl-2 py-xxl-3 px-2 px-xl-5 my-1 my-md-2 my-xl-2">
            <fa-icon icon="fa-solid fa-briefcase" class="icons"></fa-icon>
            <p class="text-prim m-0">Webdeveloper</p>
        </div>
        <div :class="{is_outside: onFirstTimeView}" class="keyWordHolder bg-sec d-flex justify-content-between align-items-center rounded-3 border border-black py-1 py-lg-2 py-xl-2 py-xxl-3 px-2 px-xl-5 my-1 my-md-2 my-xl-2">
            <fa-icon icon="fa-solid fa-at" class="icons"></fa-icon>
            <p class="text-prim m-0"><a href="mailto:website@kamed.in">website@kamed.in</a></p>
        </div>
        <div :class="{is_outside: onFirstTimeView}" class="keyWordHolder bg-sec d-flex justify-content-between align-items-center rounded-3 border border-black py-1 py-lg-2 py-xl-2 py-xxl-3 px-2 px-xl-5 my-1 my-md-2 my-xl-2">
            <fa-icon icon="fa-brands fa-github" class="icons"></fa-icon>
            <p class="text-prim m-0"><a href="https://github.com/DevKame" target="_blank">DevKame</a></p>
        </div>
        <my-picture></my-picture>
    </div>
</template>

<script setup>
import MyPicture from "./MyPicture.vue";

import { inject, watch, ref, defineEmits } from "vue";

let emits = defineEmits([
    "section-about-on-view",
]);


// ANIMATE ONSCROLL - DETERMINES WHEN KEYWORDS ARE ANIMATED IN
let onFirstTimeView = ref(false);
// ANIMATE ONSCROLL - DETECTS WHEN <TheAbout> IS ALMOST FULLY IN VIEWPORT
let sectionAbout = inject("section-about-data");
watch(sectionAbout, val => {
    let threshold = .2;
    let third = val.height * threshold;
    if(val.top <= third) {
        emits("section-about-on-view", "about");
    }
    if(!onFirstTimeView.value) {
        if(val.top <= third) {
            // ANIMATE ONSCROLL - INVOKES Fn TO CHANGE onFirstTimeView VALUE
            toggleOnFirstTimeView();
        }
    }
});
// ANIMATE ONSCROLL - CHANGES THE onFirstTimeView VALUE
function toggleOnFirstTimeView() {
    onFirstTimeView.value = true;
}

</script>

<style scoped>
    .keyWordHolder {
        opacity: 0;
        transform: translate(100%, 0) skew(-10deg);
    }
    .keyWordHolder.is_outside:first-child {
        animation: slide-in1 .2s ease-in forwards;
    }
    .keyWordHolder.is_outside:nth-child(2) {
        animation: slide-in2 .25s ease-in forwards;
    }
    .keyWordHolder.is_outside:nth-child(3) {
        animation: slide-in3 .3s ease-in forwards;
    }
    .keyWordHolder.is_outside:nth-child(4) {
        animation: slide-in4 .35s ease-in forwards;
    }
    .keyWordHolder.is_outside:nth-child(5) {
        animation: slide-in5 .4s ease-in forwards;
    }
@keyframes slide-in1 {
    0% {
        opacity: 0;
        transform: translate(100%, 0) skew(-10deg);
    }
    80% {
        opacity: 1;
        transform: translate(-15%, 0) skew(5deg);
    }
    100% {
        opacity: 1;
        transform: translate(0, 0) skew(0);
    }
}
@keyframes slide-in2 {
    0% {
        opacity: 0;
        transform: translate(100%, 0) skew(-10deg);
    }
    80% {
        opacity: 1;
        transform: translate(-15%, 0) skew(5deg);
    }
    100% {
        opacity: 1;
        transform: translate(0, 0) skew(0);
    }
}
@keyframes slide-in3 {
    0% {
        opacity: 0;
        transform: translate(100%, 0) skew(-10deg);
    }
    80% {
        opacity: 1;
        transform: translate(-15%, 0) skew(5deg);
    }
    100% {
        opacity: 1;
        transform: translate(0, 0) skew(0);
    }
}
@keyframes slide-in4 {
    0% {
        opacity: 0;
        transform: translate(100%, 0) skew(-10deg);
    }
    80% {
        opacity: 1;
        transform: translate(-15%, 0) skew(5deg);
    }
    100% {
        opacity: 1;
        transform: translate(0, 0) skew(0);
    }
}
@keyframes slide-in5 {
    0% {
        opacity: 0;
        transform: translate(100%, 0) skew(-10deg);
    }
    80% {
        opacity: 1;
        transform: translate(-15%, 0) skew(5deg);
    }
    100% {
        opacity: 1;
        transform: translate(0, 0) skew(0);
    }
}
.icons {
    color: var(--tert);
    filter: drop-shadow(0 0 2px black);
}
.keywordWrapper {
    width: 100%;
    height: 100vh;
    padding-top: 30vh;
}
.keyWordHolder {
    width: 60%;
    font-size: 18px;
}
@media screen and (min-width: 576px) {
    .keyWordHolder {
        width: 50%;
        font-size: 18px;
    }
}
@media screen and (min-width: 768px) {
    .keyWordHolder {
        width: 50%;
        font-size: 20px;
    }
    .keywordWrapper {
        padding-top: 25vh;
    }
}
@media screen and (min-width: 992px) {
    @keyframes slide-in1 {
        0% {
            opacity: 0;
            transform: translate(100%, 0) skew(-10deg);
        }
        80% {
            opacity: 1;
            transform: translate(-45%, 0) skew(5deg);
        }
        100% {
            opacity: 1;
            transform: translate(-30%, 0) skew(0);
        }
    }
    @keyframes slide-in2 {
        0% {
            opacity: 0;
            transform: translate(100%, 0) skew(-10deg);
        }
        80% {
            opacity: 1;
            transform: translate(-52.5%, 0) skew(5deg);
        }
        100% {
            opacity: 1;
            transform: translate(-37.5%, 0) skew(0);
        }
    }
    @keyframes slide-in3 {
        0% {
            opacity: 0;
            transform: translate(100%, 0) skew(-10deg);
        }
        80% {
            opacity: 1;
            transform: translate(-60%, 0) skew(5deg);
        }
        100% {
            opacity: 1;
            transform: translate(-45%, 0) skew(0);
        }
    }
    @keyframes slide-in4 {
        0% {
            opacity: 0;
            transform: translate(100%, 0) skew(-10deg);
        }
        80% {
            opacity: 1;
            transform: translate(-67.5%, 0) skew(5deg);
        }
        100% {
            opacity: 1;
            transform: translate(-52.5%, 0) skew(0);
        }
    }
    @keyframes slide-in5 {
        0% {
            opacity: 0;
            transform: translate(100%, 0) skew(-10deg);
        }
        80% {
            opacity: 1;
            transform: translate(-75%, 0) skew(5deg);
        }
        100% {
            opacity: 1;
            transform: translate(-60%, 0) skew(0);
        }
    }
    .keywordWrapper {
        padding-top: 20vh;
    }
    .keyWordHolder {
        width: 40%;
        font-size: 20px;
    }
    .keyWordHolder.is_outside:first-child {
        /* margin-right: 7.5%; */
        animation: slide-in1 .6s ease-in .2s forwards;
    }
    .keyWordHolder.is_outside:nth-child(2) {
        /* margin-right: 15%; */
        animation: slide-in2 .6s ease-in .25s forwards;
    }
    .keyWordHolder.is_outside:nth-child(3) {
        /* margin-right: 22.5%; */
        animation: slide-in3 .6s ease-in .3s forwards;
    }
    .keyWordHolder.is_outside:nth-child(4) {
        /* margin-right: 30%; */
        animation: slide-in4 .6s ease-in .35s forwards;
    }
    .keyWordHolder.is_outside:nth-child(5) {
        /* margin-right: 37.5%; */
        animation: slide-in5 .6s ease-in .4s forwards;
    }
}
@media screen and (min-width: 1200px) {
    .keywordWrapper {
        padding-top: 20vh;
    }
    .keyWordHolder {
        font-size: 25px;
    }
}
@media screen and (min-width: 1400px) {
    .keywordWrapper {
        padding-top: 15vh;
    }
    .keyWordHolder {
        font-size: 30px;
    }
}
</style>