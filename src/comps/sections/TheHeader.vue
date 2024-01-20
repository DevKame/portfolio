<template>
    <header class="theHeader position-relative" ref="theHeader" id="section-the-header">
        <the-logo></the-logo>
        <the-headlines></the-headlines>
    </header>
</template>

<script setup>
import TheLogo from "./header_comps/TheLogo.vue";
import TheHeadlines from "./header_comps/TheHeadlines.vue";

import { ref, reactive, onMounted, inject, watch, defineEmits } from "vue";
// HEXAMENU ANIMATION - TELLS PARENT-COMP. THAT <TheHeader> ALMOST COMPLETLY IN VIEWPORT
let emits = defineEmits([
    "section-header-on-view",
]);
// HEXAMENU ANIMATION - HEIGHT/TOP VALUES OF <TheHeader>
let theHeader = ref();
let header_data = reactive({
    bot: 0,
    height: 0,
});
// HEXAMENU ANIMATION - INITIAL COMPUTING OF <TheHeader>´s HEIGHT/TOP VALUES
onMounted((updateHeaderData));
// HEXAMENU ANIMATION - CALLBACK FOR COMPUTING HEIGHT/TOP VALUES OF <TheHeader>
function updateHeaderData() {
    let data = theHeader.value.getBoundingClientRect();
    header_data.height = data.height;
    header_data.bot = data.height + data.top;
}
// HEXAMENU ANIMATION - TRACKS THE GLOBAL SCROLL Y VALUE
let globalScrollvalue = inject("global-scrollvalue");
watch(globalScrollvalue, () => {
    updateHeaderData();
    if(header_data.bot >= header_data.height * .4)
    {
        emits("section-header-on-view", "start");
    }
});







</script>


<style scoped>
header {
    min-height: 100vh;
}
</style>