<template>
    <div class="stackItem my-1 my-lg-2 mx-xxl-2 my-xxl-4 d-flex justify-content-start align-items-center">
        <div class="hexaHolder me-3 d-flex justify-content-center align-items-center">
            <stack-hexa :icon-string="techItem.icon"></stack-hexa>
        </div>

        <div class="nameHolder d-flex justify-content-start align-items-center">
            {{ name }}
        </div>
    </div>
</template>

<script setup>
import {computed, defineProps} from "vue";

import StackHexa from "./StackHexa.vue";

let props = defineProps([
    "techItem",
]);

let name = computed(() => {
    return props.techItem.name;
})
</script>

<style scoped>
.stackItem {
    width: 100%;
    min-height: 50px;
    font-size: 12px;
}
.nameHolder {
    color: var(--tert);
}
@media screen and (min-width: 576px) {
    .stackItem {
        font-size: 14px;
    }
}
@media screen and (min-width: 992px) {
    .stackItem {
        min-height: 50px;
        font-size: 20px;
    }
}
</style>