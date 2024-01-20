<template>
    <div class="formHolderOne w-100 d-flex flex-column justify-content-start align-items-start">
                <div class="inputWrapper mt-2 mt-sm-3 mb-1 mt-lg-1 mb-sm-2 mt-xxl-4 mb-xxl-4">
                    <label for="lastname">{{ lastnameLabel }}</label>
                    <input @blur="toggleProgress" type="text" id="lastname" v-model="requestLastname" />
                    <small v-if="!lastnameValid" class="text-dgr">{{ nameSmalls }}</small>
                </div>
                
                <div class="inputWrapper my-1 my-sm-2 my-xxl-4">
                    <label for="lastname">{{ firstnameLabel }}</label>
                    <input @blur="toggleProgress" type="text" id="firstname" v-model="requestFirstname" />
                    <small v-if="!firstnameValid" class="text-dgr">{{ nameSmalls }}</small>
                </div>
                
                <div class="inputWrapper my-1 my-sm-2 my-xxl-4">
                    <label for="lastname">E-Mail</label>
                    <input @blur="toggleProgress" type="email" id="lastname" v-model="requestEmail" />
                    <small v-if="!emailValid" class="text-dgr">{{ emailSmall }}</small>
                </div>

                <button @click="checkEntries" class="btn-prim px-5 ms-auto mt-5 mt-lg-1">{{ continueButton }}</button>
            </div>
</template>

<script setup>
import { ref, computed, inject, defineEmits } from 'vue';

let emits = defineEmits([
    // INTERFACE STRUCTURE - SWITCHES TO NEXT FORM
    "next-form",
    // DATA MANAGEMENT - SENDS VALID USERDATA
    "userdata-valid",
    // DATA MANAGEMENT - SENDS INFO ABOUT INVALID USERDATA
    "userdata-invalid",
    // LOADING SCREEN - STARTS/STOPS LOADING DEPENDING ON ITS VALUE
    "load",
]);
// ENTRY VALIDATION - RECEIVED API ENDPOINT
let API_VALIDATION = inject("api_val");
// INTERFACE LANGUAGE - DETERMINES LANGUAGE OF INTERFACE
// received by <TheMessage>
let language_setting = inject("language-setting");

// DATA MANAGEMENT - USER ENTRIES, CONNECTED TO DOM WITH V-MODEL
// -- received from <TheMessage>
let requestLastname = inject("requestLastname");
let requestFirstname = inject("requestFirstname");
let requestEmail = inject("requestEmail");
// DATA MANAGEMENT - DETERMINES IF ENTRIES ARE VALID
let lastnameValid = ref(true);
let firstnameValid = ref(true);
let emailValid = ref(true);

////////////////////////////////////////    INTERFACE LANGUAGE
let lastnameLabel = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "Lastname";
            break;
        case "ger":
            result = "Nachname";
            break;
    }
    return result;
});
let nameSmalls = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "No spaces, min. 2, max. 20 characters";
            break;
        case "ger":
            result = "Keine Leerstellen, min. 2, max. 20 Zeichen";
            break;
    }
    return result;
});
let firstnameLabel = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "Firstname";
            break;
        case "ger":
            result = "Vorname";
            break;
    }
    return result;
});
let emailSmall = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "No spaces, valid email adress";
            break;
        case "ger":
            result = "Keine Leerstellen, valide Email Adresse";
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

async function checkEntries() {
    emits("load", true);
    let response = await fetch(API_VALIDATION.value, {
        method: "post",
        body: JSON.stringify({
            lastname: requestLastname.value,
            firstname: requestFirstname.value,
            email: requestEmail.value,
            task: "msg_validate_userdata",
        }),
        headers: {
            "Content-Type": "application/json"
        },
    });
    let data = await response.json();
    setAllValid();

    if(data.validation_result.invalid_entries === 0)
    {
        emits("userdata-valid", {ln: requestLastname.value, fn: requestFirstname.value, em: requestEmail.value});
        nextForm();
    }
    else {
        emits("userdata-invalid");
        for(let en in data.validation_result) {
            if(!data.validation_result[en]) {
                switch(en) {
                    case "lastname_valid":
                        lastnameValid.value = false;
                        break;
                    case "firstname_valid":
                        firstnameValid.value = false;
                        break;
                    case "email_valid":
                        emailValid.value = false;
                        break;
                }
            }
        }
    }
    
    emits("load", false);
}
// ENTRY VALIDATION - RESETS ALL VALUES TO VALID BEFORE RE-VALIDATING A NEW TRY
function setAllValid() {
    lastnameValid.value = true;
    firstnameValid.value = true;
    emailValid.value = true;
}
// INTERFACE STRUCTURE - SWITCHES TO NEXT FORM
// listened to by <TheMessage>
function nextForm() {
    emits("next-form", 2);
}
</script>


<style scoped>
.inputWrapper small {
    font-size: .6em;
}
.inputWrapper input {
    width: 100%;
    padding-left: 4px;
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
    input {
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
    input {
        font-size: 20px;
    }
    button {
        font-size: 22px;
    }
}
</style>