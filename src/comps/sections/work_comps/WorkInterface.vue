<template>
    <svg class="interfaceHexaSVG position-absolute" ref="interfaceHexaSVG">
        <path stroke="#996913" stroke-width="3" fill="none" ref="interfaceHexaPath"
        d=""></path>
    </svg>
</template>

<script setup>
import { ref, onMounted } from "vue";

let interfaceHexaSVG = ref();
let interfaceHexaPath = ref();
onMounted(() => {
drawHexa();
});
function drawHexa() {
let data = interfaceHexaSVG.value.getBoundingClientRect();
let w = data.width;
let h = data.height;
let half = h / 2;
let d = `
M${3} ${half}
L${w * .05} ${3}
L${w * .95} ${3}
L${w - 3} ${half}
L${w * .95} ${h - 3}
L${w * .05} ${h - 3}
Z`;
interfaceHexaPath.value.setAttribute("d", d);
}
</script>


<style scoped>


.interfaceHexaSVG {
top: 0;
left: 0;
width: 100%;
height: 100%;
}
</style>