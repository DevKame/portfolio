<template>
    <div class="formHolderTwo w-100 d-flex flex-column justify-content-start align-items-start">
        <div class="inputWrapper mt-2 mb-1">
            <label for="desc">
                {{ descLabel }}
                <br>
                <span>{{ descChars }}</span>
            </label>
            <textarea id="desc" v-model="requestDesc" ref="descArea"></textarea>
            <small v-if="!descValid" class="text-dgr">{{ descSmall }}</small>
        </div>

        <div class="w-100 d-flex justify-content-between align-items-center mb-auto mt-3">
            <button @click="prevForm" class="btn-sec">Zurück..</button>
            <button @click="checkEntries" class="btn-prim px-5 ms-auto">{{ continueButton }}</button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, inject, defineEmits } from "vue";

let emits = defineEmits([
    // INTERFACE STRUCTURE - SWITCHES TO PREVIOUS FORM
    "prev-form",
    // INTERFACE STRUCTURE - SWITCHES TO NEXT FORM
    "next-form",
    // DATA MANAGEMENT - SENDS VALID USERDESC
    "desc-valid",
    // DATA MANAGEMENT - SENDS INFO ABOUT INVALID DESC
    "desc-invalid",
    // LOADING SCREEN - STARTS/STOPS LOADING DEPENDING ON ITS VALUE
    "load",
]);

// ENTRY VALIDATION - RECEIVED API ENDPOINT
let API_VALIDATION = inject("api_val");
// INTERFACE LANGUAGE - DETERMINES LANGUAGE OF INTERFACE
// received by <TheMessage>
let language_setting = inject("language-setting");
// DATA MANAGEMENT - USER DESCRIPTION, CONNECTED TO DOM WITH V-MODEL
// -- received from <TheMessage>
let requestDesc = inject("requestDesc");
// DATA MANAGEMENT - DETERMINES IF ENTRIES ARE VALID
let descValid = ref(true);
////////////////////////////////////////    INTERFACE LANGUAGE
let descLabel = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "Tell me a bit about your idea";
            break;
        case "ger":
            result = "Erzähle ein wenig über deine Idee";
            break;
    }
    return result;
});
let descSmall = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "No spaces at the end, max. 512 characters";
            break;
        case "ger":
            result = "Keine Leerstellen am Ende, max. 512 Zeichen";
            break;
    }
    return result;
});
let continueButton = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "Continue...";
            break;
        case "ger":
            result = "Weiter...";
            break;
    }
    return result;
});
////////////////////////////////////////    INTERFACE LANGUAGE

// INTERFACE STRUCTURE - DISPLAYS CHARACTER COUNT OF DESCRIPTION
let descChars = computed(() => {
    return "( " + requestDesc.value.length + " / 512 )";
});


async function checkEntries() {
    emits("load", true);
    let response = await fetch(API_VALIDATION.value, {
        method: "post",
        body: JSON.stringify({
            desc: requestDesc.value,
            task: "msg_validate_userdesc",
        }),
        headers: {
            "Content-Type": "application/json"
        },
    });
    let data = await response.json();
    setAllValid();
    console.table(data.validation_result);
    if(data.validation_result.desc_valid)
    {
        console.warn("requestDesc unmittelbar VOR ABSENDEN AN TheMessage:", requestDesc.value);
        emits("desc-valid", {desc: requestDesc.value});
        nextForm();
    }
    else {
        descValid.value = false;
        emits("desc-invalid");
    }
    emits("load", false);
}
// ENTRY VALIDATION - RESETS DESCRIPTION VALUE TO VALID BEFORE RE-VALIDATING A NEW TRY
function setAllValid() {
    descValid.value = true;
}


// INTERFACE STRUCTURE - SWITCHES TO PREVIOUS FORM
// listened to by <TheMessage>
function prevForm() {
    descValid.value = false;
    requestDesc.value = "";
    emits("desc-invalid", requestDesc.value);
    emits("prev-form", 1);
}
// INTERFACE STRUCTURE - SWITCHES TO NEXT FORM
// listened to by <TheMessage>
function nextForm() {
    emits("next-form", 3);
}
</script>

<style scoped>
.inputWrapper small {
    font-size: .6em;
}
.inputWrapper textarea {
    width: 100%;
    min-height: 250px;
}
.inputWrapper {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: start;
    align-items: start;
}
label {
    font-size: 16px;
}
@media screen and (min-width: 576px) {
    label {
        font-size: 20px;
    }
    textarea {
        font-size: 18px;
    }
    button {
        font-size: 20px;
    }
}
@media screen and (min-width: 768px) {
    label {
        font-size: 22px;
    }
    textarea {
        font-size: 20px;
    }
    button {
        font-size: 22px;
    }
}
</style>