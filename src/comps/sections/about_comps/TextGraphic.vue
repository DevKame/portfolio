<template>
    <svg class="textGraphic" ref="textSvg">
        <defs>
            <radialGradient id="gradient" r="400%">
                <stop offset="0%" stop-color="#192145" />
                <stop offset="100%" stop-color="rgba(0,0,0,.4)" />
            </radialGradient>
        </defs>
        <path class="gradientPath" :class="{inView: props.wrapperInView}" stroke="none" stroke-width="10" stroke-linejoin="round" fill="url('#gradient')" ref="gradientPath"></path>
        <path class="textBorderPath" :class="{inView: props.wrapperInView}" stroke="#996913" stroke-width="10" stroke-linejoin="round" fill="none" ref="borderPath"></path>
    </svg>
</template>

<script setup>
import {ref, onMounted, defineProps} from "vue";

let props = defineProps([
    // ANIMATE ONSCROLL - TELLS THIS COMP WHEN TO "DRAW" THE PATH
    "wrapperInView",
]);

// ANIMATE ONSCROLL - THE SVG:
let textSvg = ref();
// ANIMATE ONSCROLL - BOTH PATHS
let borderPath = ref();
let gradientPath = ref();
// ANIMATE ONSCROLL - WILL BE USED FOR CLIENTRECT()
let data = "";
// ANIMATE ONSCROLL - RENDERS THE PATHS DEPENDANT OF SVG WIDTH/HEIGHT:
onMounted(() => {
    data = textSvg.value.getBoundingClientRect();
    let w = data.width;
    let h = data.height;
    let d = `
    M${w * .05} ${h * .01}
    L${w * .95} ${h * .01}
    Q${w - 10} ${h * .01}
    ${w - 10} ${h * .05}
    L${w - 10} ${h * .95}
    Q${w - 10} ${h - 10}
    ${w * .95} ${h * .99}
    L${w * .05} ${h * .99}
    Q${10} ${h - 10}
    ${10} ${h * .95}
    L${10} ${h * .05}
    Q${10} ${h * .01}
    ${w * .05} ${h * .01}`;
    drawPath(d);
});
// ANIMATE ONSCROLL - USED TO SET D-ATTRIBUTE TO THE PATHS:
function drawPath(d) {
    borderPath.value.setAttribute("d", d);
    gradientPath.value.setAttribute("d", d);
}

</script>


<style scoped>
.gradientPath {
    opacity: 0;
    transition: opacity 1.5s ease-out;
}
.gradientPath.inView {
    opacity: 1;
}
.textBorderPath {
    transition: all 3s ease-out;
    stroke-dasharray: 5000;
    stroke-dashoffset: 5000;
}
.textBorderPath.inView {
    stroke-dashoffset: 0;
}
.textGraphic {
    width: 100%;
    height: 100%;
}
</style>