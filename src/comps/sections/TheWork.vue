<template>
    <section class="theWork" ref="theWork" id="section-the-work">
        <!-- <h1 v-if="windowTopScroll !== null">TheWork</h1> -->
        <work-content></work-content>
    </section>
</template>

<script setup>
import WorkContent from "./work_comps/WorkContent.vue";

import { ref, reactive, onMounted, watch, inject, defineEmits } from "vue";
// HEXAMENU ANIMATION - TELLS PARENT-COMP. THAT <TheWork> ALMOST COMPLETLY IN VIEWPORT
let emits = defineEmits([
    "section-work-on-view",
]);
// HEXAMENU ANIMATION - HEIGHT/TOP VALUES OF <TheWork>
let theWork = ref();
let work_data = reactive({
    top: 0,
    height: 0,
});
// HEXAMENU ANIMATION - INITIAL COMPUTING OF <TheWork>´s HEIGHT/TOP VALUES
onMounted(updateWorkData);
// HEXAMENU ANIMATION - CALLBACK FOR COMPUTING HEIGHT/TOP VALUES OF <TheWork>
function updateWorkData() {
    let data = theWork.value.getBoundingClientRect();
    work_data.top = data.top;
    work_data.height = data.height;
}
// HEXAMENU ANIMATION - TRACKS THE GLOBAL SCROLL Y VALUE
let globalScrollvalue = inject("global-scrollvalue");
watch(globalScrollvalue, updateWorkData);
// HEXAMENU ANIMATION - TRACKS THE CHANGED HEIGHT/TOP VALUES AND EMITS EVENT FOR MENU MOVEMENT
watch(work_data, val => {
    let third = val.height * .4;
    if(val.top <= third) {
        emits("section-work-on-view", "work");
    }
});
</script>

<style scoped>
section {
    min-height: 100vh;
    font-family: "Ubuntu Med 500";
}
</style>