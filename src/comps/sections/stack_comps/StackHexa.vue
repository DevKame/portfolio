<template>
    <div class="hexaWrapper position-relative d-flex justify-content-center align-items-center">
        <div class="hexaShadow position-absolute"></div>
        <div class="hexaBackground position-absolute bg-sec"></div>
        <fa-icon class="position-relative orange-icons" :icon="iString"></fa-icon>
    </div>
</template>

<script setup>
import { defineProps, computed } from "vue";

let props = defineProps([
    "iconString",
]);

let iString = computed(() => {
    return props.iconString;
})
</script>

<style scoped>
.orange-icons {
    color: var(--tert);
    width: 40%;
    height: 40%;
    filter: drop-shadow(0 0 2px black);
}
.hexaBackground {
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 85%;
    height: 85%;
    clip-path: polygon(0 50%, 15% 7.5%, 85% 7.5%, 100% 50%, 85% 92.5%, 15% 92.5%, 0 50%);
}
.hexaShadow {
    background-color: black;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    clip-path: polygon(0 50%, 15% 7.5%, 85% 7.5%, 100% 50%, 85% 92.5%, 15% 92.5%, 0 50%);
    filter: blur(25px);
}
.hexaWrapper {
    aspect-ratio: .93;
}
.hexaWrapper {
    width: 70px;
}

</style>