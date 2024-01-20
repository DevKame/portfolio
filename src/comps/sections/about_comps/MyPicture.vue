<template>
    <img class="myPicture pe-none ms-auto" src="" ref="myImage"/>
</template>

<script setup>
import {ref, onMounted} from "vue";
let myImage = ref();
onMounted(() => {
    switch(true) {
        case innerWidth > 1400:
            myImage.value.setAttribute("src", require("@/assets/img/kamedin-1500.png"));
            break;
        case innerWidth > 1200 && innerWidth < 1400:
            myImage.value.setAttribute("src", require("@/assets/img/kamedin-1000.png"));
            break;
        case innerWidth < 1200:
            myImage.value.setAttribute("src", require("@/assets/img/kamedin-600.png"));
            break;
    }
});

//TODO: make <img> un-absolute
</script>

<style scoped>
.myPicture {
    transform: scaleX(-1);
    width: 60%;
    margin-top: 80px;
}
@media screen and (min-width: 992px) {
    .myPicture {
        width: 30%;
        margin-top: -10vh;
    }
}
@media screen and (min-width: 1400px) {
    .myPicture {
        margin-top: -13vh;
    }
}
</style>