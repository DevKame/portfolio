<template>
    <section class="theStack" ref="theStack" id="section-the-stack">
        <stack-content></stack-content>
    </section>
</template>

<script setup>
import StackContent from "./stack_comps/StackContent.vue";

import { ref, reactive, onMounted, watch, inject, defineEmits } from "vue";
// HEXAMENU ANIMATION - TELLS PARENT-COMP. THAT <TheStack> ALMOST COMPLETLY IN VIEWPORT
let emits = defineEmits([
    "section-stack-on-view",
]);
// HEXAMENU ANIMATION - HEIGHT/TOP VALUES OF <TheStack>
let theStack = ref();
let stack_data = reactive({
    top: 0,
    height: 0,
});
// HEXAMENU ANIMATION - INITIAL COMPUTING OF <TheStack>´s HEIGHT/TOP VALUES
onMounted(updateStackData);
// HEXAMENU ANIMATION - CALLBACK FOR COMPUTING HEIGHT/TOP VALUES OF <TheStack>
function updateStackData() {
    let data = theStack.value.getBoundingClientRect();
    stack_data.top = data.top;
    stack_data.height = data.height;
}
// HEXAMENU ANIMATION - TRACKS THE GLOBAL SCROLL Y VALUE
let globalScrollvalue = inject("global-scrollvalue");
watch(globalScrollvalue, updateStackData);
// HEXAMENU ANIMATION - TRACKS THE CHANGED HEIGHT/TOP VALUES AND EMITS EVENT FOR MENU MOVEMENT
watch(stack_data, val => {
    let third = val.height * .4;
    if(val.top <= third) {
        emits("section-stack-on-view", "stack");
    }
});

</script>

<style scoped>
section {
    min-height: 100vh;
    font-family: "Ubuntu Med 500";
}
</style>