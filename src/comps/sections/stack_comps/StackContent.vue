<template>
    <div class="stackContent ps-lg-5 pt-5 pt-xl-3 d-flex d-lg-row justify-content-lg-start align-items-lg-center">
        <div class="stackColumn d-flex flex-column d-lg-row justify-content-start justify-content-lg-center align-items-start align-items-lg-start">
            <stack-item v-for="item in techStack" :key="item.name"
            :tech-item="item"></stack-item>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

import StackItem from "./StackItem.vue";

let techStack = ref(
    [
        {
            name: "JavaScript",
            icon: "fa-brands fa-js",
        },
        {
            name: "Vue 3 (OPTIONS & COMPOSITION)",
            icon: "fa-brands fa-vuejs",
        },
        {
            name: "CSS",
            icon: "fa-brands fa-css3-alt",
        },
        {
            name: "PHP",
            icon: "fa-brands fa-php",
        },
        {
            name: "Bootstrap",
            icon: "fa-brands fa-bootstrap",
        },
        {
            name: "Python",
            icon: "fa-brands fa-python",
        },
        {
            name: "Sass",
            icon: "fa-brands fa-sass",
        },
        {
            name: "Django",
            icon: "fa-brands fa-python",
        },
        {
            name: "HTML",
            icon: "fa-brands fa-html5",
        },
        {
            name: "Git",
            icon: "fa-brands fa-git",
        },
        {
            name: "TypeScript",
            icon: "fa-brands fa-js",
        },
    ]
);
</script>



<style scoped>
.stackContent {
    min-height: 100vh;
}
.stackColumn {
    width: 60%;
    flex-wrap: nowrap;
}
@media screen and (min-width: 992px) {
    .stackColumn {
        flex-wrap: wrap;
    }
}
</style>