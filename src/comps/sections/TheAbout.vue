<template>
    <section class="theAbout position-relative" ref="theAbout" id="section-the-about">
        <keyword-wrapper @section-about-on-view="aboutOnViewCall"></keyword-wrapper>
        <textwrapper-about></textwrapper-about>
    </section>
</template>

<script setup>
import KeywordWrapper from "./about_comps/KeywordWrapper.vue";
import TextwrapperAbout from "./about_comps/TextwrapperAbout.vue";

import { ref, reactive, provide, onMounted, watch, inject, defineEmits } from "vue";
// HEXAMENU ANIMATION - TELLS PARENT-COMP. THAT <TheAbout> ALMOST COMPLETLY IN VIEWPORT
let emits = defineEmits([
    "section-about-on-view",
]);

// ANIMATE ONSCROLL - HEIGHT/TOP VALUES OF <TheAbout>
let theAbout = ref();
let the_about_data = reactive({
    top: 0,
    height: 0,
});
// ANIMATE ONSCROLL - INITIAL COMPUTING OF <TheAbout>´s HEIGHT/TOP VALUES
onMounted(() => {
    let data = theAbout.value.getBoundingClientRect()
    the_about_data.height = data.height;
    the_about_data.top = data.top;
});
// ANIMATE ONSCROLL - PROVIDES <TheAbout>´s HEIGHT/TOP VALUES
// -- injected by: [<KeywordWrapper>]:
provide("section-about-data", the_about_data);
// ANIMATE ONSCROLL - USES scrollTop VALUE TO UPDATE <TheAbouts>´s HEIGHT/TOP VALUES
let globalScrollvalue = inject("global-scrollvalue");
watch(globalScrollvalue, updateAboutData);
// ANIMATE ONSCROLL - CALLBACK TO RECOMPUTE <TheAbout>´s HEIGHT/TOP VALUES
function updateAboutData() {
    let data = theAbout.value.getBoundingClientRect()
    the_about_data.height = data.height;
    the_about_data.top = data.top;
}
// HEXAMENU ANIMATION - EMITS EVENT FOR MENU MOVEMENT
function aboutOnViewCall(val) {
    emits("section-about-on-view", val);
}

</script>

<style scoped>
section {
    min-height: 100vh;
    font-family: "Ubuntu Med 500";
}
</style>