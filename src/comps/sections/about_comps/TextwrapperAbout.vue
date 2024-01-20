<template>
    <div class="textWrapper position-relative" ref="textWrapper">
        <div class="svgHolder position-absolute">
            <text-graphic :wrapper-in-view="onView"></text-graphic>
        </div>
        <div class="textHolder position-absolute d-flex flex-column justify-content-center align-items-center">

            <transition>
                <p v-if="onView" class="my-1 my-md-3">Its been 4 years when i started my journey as a <span class='text-tert'>webdeveloper</span></p>
            </transition>
            <transition>
                <p v-if="onView" class="my-1 my-md-3">At that time i stumbled across a magazine that offered courses for personal training and development, from which i chose the developer course.</p>
            </transition>
            <transition>
                <p v-if="onView" class="my-1 my-md-3">Over the following period of time i developed a big portfolio of skillsets, that made me quit my job and today webdevelopment has become my profession.</p>
            </transition>
            <transition>
                <p v-if="onView" class="my-1 my-md-3">
                    <ul>
                        <li>i build <span class='text-tert'>interfaces</span> for staff and material <span class='text-tert'>management</span></li>
                        <li>i separate functionality depending on access rights</li>
                        <li>i build interfaces to analyse, cut, save and mark snippets 	from AI - generated audio data</li>
                        <li>i also are assigned to edit functionality of existing <span class='text-tert'>backend</span></li>
                    </ul>
                </p>
            </transition>
            <transition>
                <p v-if="onView" class="my-3">Feel free to checkout my skillset or <span class='text-tert'>send me a request</span>. Cant wait to create your next website / blog / application</p>
            </transition>
        </div>
    </div>
</template>

<script setup>
import TextGraphic from "./TextGraphic.vue";

import { ref, reactive, onMounted, watch, inject } from "vue";

// ANIMATE ONSCROLL - DETERMINES IF <p>´s get animated in
let onView = ref(false);
// ANIMATE ONSCROLL - VALUES OF TEXTWRAPPER DETERMINE VALUE OF onView
let textWrapper = ref();
let textwrapper_data = reactive({
    top: 0,
    height: 0,
});
// ANIMATE ONSCROLL - INITIALL COMPUTING OF textWrappers´s VALUES
onMounted(() => {
    let data = textWrapper.value.getBoundingClientRect()
    textwrapper_data.height = data.height;
    textwrapper_data.top = data.top;
});
// ANIMATE ONSCROLL - UPDATES textWrappers´s VALUES ON SCROLLING
let globalScrollvalue = inject("global-scrollvalue");
watch(globalScrollvalue, updateWrapperData);

// ANIMATE ONSCROLL - CALLBACK TO RECOMPUTE textWrapper´s VALUES
function updateWrapperData() {
    let threshold =
    innerWidth < 768 ?
    .4 : .2;
    let data = textWrapper.value.getBoundingClientRect()
    textwrapper_data.height = data.height;
    textwrapper_data.top = data.top;
    if(textwrapper_data.height * threshold >= textwrapper_data.top) {
        toggleOnView();
    }
}
// ANIMATE ONSCROLL - CHANGES THE onView VALUE
function toggleOnView() {
    onView.value = true;
}
</script>

<style scoped>

.v-enter-from {
    opacity: 0;
    transform: scaleX(.1);
}
.v-enter-active {
    transition: all .5s ease;
}
.v-enter-to {
    opacity: 1;
    transform: scaleX(1);
}
p, ul {
    text-shadow: 0 0 5px black;
    width: 80%;
    font-size: 12px;
}
.svgHolder,
.textHolder {
    top: 20%;
    right: 0;
    width: 100%;
    height: 80vh;
    transform: translate(0, 0);
}
.textWrapper {
    width: 100%;
    height: 100vh;
}
@media screen and (min-width: 576px) {
    .svgHolder,
    .textHolder {
        height: 80vh;
    }
    p, ul {
        width: 80%;
        font-size: 15px;
    }
}
@media screen and (min-width: 768px) {
    .svgHolder,
    .textHolder {
        width: 80%;
        height: 80vh;
        transform: translate(-12.5%, 0);
    }
    p, ul {
        width: 80%;
        font-size: 15px;
    }
}
@media screen and (min-width: 992px) {
    .svgHolder,
    .textHolder {
        top: 0;
        width: 60%;
        height: 100vh;
        transform: translate(0, 0);
    }
    p, ul {
        width: 80%;
        font-size: 15px;
    }
}
@media screen and (min-width: 1400px) {
    .svgHolder,
    .textHolder {
        width: 60%;
    }
    p, ul {
        width: 80%;
        font-size: 20px;
    }
}
</style>