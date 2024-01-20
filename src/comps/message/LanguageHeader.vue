<template>
    <div class="languageHeader mb-5 mb-lg-1 ps-2 bg-sec d-flex justify-content-start align-items-center">
        <p class="m-0 text-prim">language:</p>
        <p class="m-0 ms-3 languageSetters">
            <span class="engSetter" @click="chooseLanguage('eng')">ENG</span> |
            <span class="gerSetter" @click="chooseLanguage('ger')">GER</span>
        </p>
    </div>
</template>

<script setup>
import { defineEmits } from 'vue';
const emits = defineEmits([
    // INTERFACE LANGUAGE - EVENT FOR PARENT TO SET LANGUAGE
    "choose-language",
]);

/** INTERFACE LANGUAGE - CALLBACK FOR SETTING NEW INTERFACE LANGUAGE
 * @param {String} val => "eng" or "ger" */
function chooseLanguage(val) {
    // listened to by <TheMessage>
    emits("choose-language", val);
}
</script>


<style scoped>
.gerSetter {
    background-image: url("@/assets/img/flags/ger_flag_100.png");
    background-size: 80%;
    background-position: center;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    filter: drop-shadow(0 0 3px black);
    cursor: pointer;
}
.engSetter {
    background-image: url("@/assets/img/flags/eng_flag_100.png");
    background-size: 80%;
    background-position: center;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    filter: drop-shadow(0 0 3px black);
    cursor: pointer;
}
.languageSetters {
    font-weight: bold;
    font-size: 24px;
}
.languageHeader {
    width: 100%;
    height: 30px;
    box-shadow: 0 2px 10px 1px black;
}
</style>