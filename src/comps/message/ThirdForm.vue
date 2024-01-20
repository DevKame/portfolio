<template>
    <div class="formHolderTwo w-100 d-flex flex-column justify-content-start align-items-start">
        <div class="inputWrapper mt-2 mb-1 mb-xxl-3">
            <label class="mb-xxl-3">{{ hasdomainLabel }}</label>
            <div class="w-100 d-flex justify-content-between align-items-center">

                <div class="d-flex flex-column justify-content-start align-items-center">
                    <input @input="setDomainValue('yes')" type="radio" name="has-domain" id="domain-yes"/>
                    <label for="domain-yes">{{ yesLabel }}</label>
                </div>

                <div class="d-flex flex-column justify-content-start align-items-center">
                    <input @input="setDomainValue('no')" type="radio" name="has-domain" id="domain-no"/>
                    <label for="domain-no">{{ noLabel }}</label>
                </div>

                <div class="d-flex flex-column justify-content-start align-items-center">
                    <input @input="setDomainValue('unsure')" type="radio" name="has-domain" id="domain-unsure"/>
                    <label for="domain-unsure">{{ unsureLabel }}</label>
                </div>

            </div>
            <small v-if="!domainValid" class="text-dgr">{{ radioSmall }}</small>
        </div>

        <div v-if="domainValue === 'yes'" class="inputWrapper my-1 my-xxl-3">
            <label class="mb-xxl-3">{{ hasdbLabel }}</label>
            <div class="w-100 mt-1 d-flex justify-content-between align-items-center">

                <div class="d-flex flex-column justify-content-start align-items-center">
                    <input @input="setDbValue('yes')" type="radio" name="has-db" id="db-yes"/>
                    <label for="db-yes">{{ yesLabel }}</label>
                </div>

                <div class="d-flex flex-column justify-content-start align-items-center">
                    <input @input="setDbValue('no')" type="radio" name="has-db" id="db-no"/>
                    <label for="db-no">{{ noLabel }}</label>
                </div>

                <div class="d-flex flex-column justify-content-start align-items-center">
                    <input @input="setDbValue('unsure')" type="radio" name="has-db" id="db-unsure"/>
                    <label for="db-unsure">{{ unsureLabel }}</label>
                </div>

            </div>
            <small v-if="!dbValid" class="text-dgr">{{ radioSmall }}</small>
        </div>
        
        <div class="inputWrapper my-1 my-xxl-3">
            <label class="mb-xxl-3">{{ deployLabel }}</label>
            <div class="w-100 mt-1 d-flex justify-content-between align-items-center">

                <div class="d-flex flex-column justify-content-start align-items-center">
                    <input @input="setdeployValue('yes')" type="radio" name="self-deploy" id="deploy-yes"/>
                    <label for="deploy-yes">{{ yesLabel }}</label>
                </div>

                <div class="d-flex flex-column justify-content-start align-items-center">
                    <input @input="setdeployValue('no')" type="radio" name="self-deploy" id="deploy-no"/>
                    <label for="deploy-no">{{ noLabel }}</label>
                </div>

                <div class="d-flex flex-column justify-content-start align-items-center">
                    <input @input="setdeployValue('unsure')" type="radio" name="self-deploy" id="deploy-unsure"/>
                    <label for="deploy-unsure">{{ unsureLabel }}</label>
                </div>

            </div>
            <small v-if="!deployValid" class="text-dgr">{{ radioSmall }}</small>
        </div>

        <div class="inputWrapper mt-5">
            <div class="w-100 d-flex justify-content-between align-items-center">
                <input @input="setDataValue" type="checkbox" />
                <p class="m-0 text-prim data-policy">{{ dataLabelFirst }}<mark @click="emits('show-datapolicy', true)">{{ markLabel }}</mark>{{ dataLabelSecond }}</p>
            </div>
            <small v-if="!dataValid" class="text-dgr">{{ dataSmall }}</small>
        </div>

        
        <div class="w-100 d-flex justify-content-between align-items-center mb-auto mt-3">
            <button @click="prevForm" class="btn-sec">{{ backButton }}</button>
            <button @click="submitForm" class="btn-prim px-5 ms-auto">{{ submitButton }}</button>
        </div>
    </div>
</template>

<script setup>
import { inject, computed, ref, defineEmits } from "vue";

let emits = defineEmits([
    // INTERFACE STRUCTURE - SWITCHES TO PREVIOUS FORM
    "prev-form",
    // DEVELOPMENT - SHOWS ALL CURRENTLY MADE ENTRIES
    "show-user-entries",
    // DATA MANAGEMENT - UPDATES CURERNTLY MADE ENTRIES ACCORDING TO USER INPUT
    "update-domain-value",
    "update-db-value",
    "update-self-value",
    "update-data-value",
    // DATA MANAGEMENT - TELLS PARENT IF ENTRIES ARE VALID OR NOT
    "boxvalues-valid",
    "boxvalues-invalid",
    // LOADING SCREEN - STARTS/STOPS LOADING DEPENDING ON ITS VALUE
    "load",
    // SAVING USER REQUESTS - TO SUBMIT ALL MADE ENTRIES
    "submit",
    // DATA POLICY - OPENS THE DATA POLICY WINDOW
    "show-datapolicy",
]);
// INTERFACE LANGUAGE - DETERMINES LANGUAGE OF INTERFACE
// received by <TheMessage>
let language_setting = inject("language-setting");


////////////////////////////////////////////// HAS DOMAIN
let domainValid = ref(false);
let domainValue = inject("domainValue");
let hasdomainLabel = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "I already have a domain and/or webspace";
            break;
        case "ger":
            result = "Ich habe bereits eine Domain und/oder Webspace";
            break;
    }
    return result;
});
let yesLabel = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "Yes";
            break;
        case "ger":
            result = "Ja";
            break;
    }
    return result;
});
let noLabel = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "No";
            break;
        case "ger":
            result = "Nein";
            break;
    }
    return result;
});
let unsureLabel = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "Unsure";
            break;
        case "ger":
            result = "Unsicher";
            break;
    }
    return result;
});
let radioSmall = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "You need to choose an option";
            break;
        case "ger":
            result = "Du musst eine Option wählen";
            break;
    }
    return result;
});
////////////////////////////////////////////// HAS DOMAIN

////////////////////////////////////////////// HAS DATABASE
let dbValid = ref(false);
let dbValue = inject("dbValue");
let hasdbLabel = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "My webspace has databases";
            break;
        case "ger":
            result = "Mein Webspace verfügt über Datenbanken";
            break;
    }
    return result;
});
////////////////////////////////////////////// HAS DATABASE

////////////////////////////////////////////// SELF DEPLOYMENT
let deployValid = ref(false);
let deployValue = inject("deployValue");
let deployLabel = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "I deploy the finished site myself";
            break;
        case "ger":
            result = "Ich kümmere mich selbst ums Deployment";
            break;
    }
    return result;
});
////////////////////////////////////////////// SELF DEPLOYMENT

////////////////////////////////////////////// DATA SECURITY

let dataValid = ref(false);
let dataValue = inject("dataValue");
let dataLabelFirst = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "I have read the ";
            break;
        case "ger":
            result = "Ich habe die ";
            break;
    }
    return result;
});
let dataLabelSecond = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = " and agree to it";
            break;
        case "ger":
            result = " gelesen und stimme zu";
            break;
    }
    return result;
});
let markLabel = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "data policy";
            break;
        case "ger":
            result = "Datenschutzbestimmung";
            break;
    }
    return result;
});
let dataSmall = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "You need to agree to the data policy";
            break;
        case "ger":
            result = "Du musst noch zustimmen, bevore du etwas senden kannst";
            break;
    }
    return result;
});
////////////////////////////////////////////// DATA SECURITY

let backButton = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "Back";
            break;
        case "ger":
            result = "Zurück";
            break;
    }
    return result;
});
let submitButton = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "Submit question";
            break;
        case "ger":
            result = "Frage senden";
            break;
    }
    return result;
});

// DATA MANAGEMENT - CALLBACKS FOR DIFFERENT BOX - INPUTS TO SET VALUES
function setDomainValue(val) {
    domainValue.value = val;
    //TODO: Kann ich hier diese if abfrage weglassen?!
    if(!domainValid.value) {
        domainValid.value = true;
    }
    if(domainValue.value !== "yes") {
        dbValue.value = "not-clickable";
        dbValid.value = false;
        emits("update-db-value", dbValue.value);
    }
    emits("update-domain-value", val);
    updateProgress();
}
function setDbValue(val) {
    dbValue.value = val;
    if(!dbValid.value) {
        dbValid.value = true;
    }
    emits("update-db-value", val);
    updateProgress();
}
function setdeployValue(val) {
    deployValue.value = val;
    if(!deployValid.value) {
        deployValid.value = true;
    }
    emits("update-self-value", val);
    updateProgress();
}
function setDataValue(e) {
    if(e.target.checked) {
        dataValue.value = "agreed";
        dataValid.value = true;
    } else {
        dataValue.value = "not-agreed";
        dataValid.value = false;
    }
    emits("update-data-value", dataValue.value);
    updateProgress();
}

// PROGRESS BAR - TELLS PARENT IF <ThirdForm>´s ENTRIES ARE ALL VALID
function updateProgress() {
    console.clear();
    console.log("domainValid:", domainValid.value);
    console.log("deployValid:", deployValid.value);
    console.log("dataValid:", dataValid.value);
    console.log("dbValid:", dbValid.value);
    let result = false;
    if(domainValid.value && deployValid.value && dataValid.value)
    {
        console.log("Die Drei Hauptdinger sind TRUE");
        if(domainValue.value === "yes") {
            if(dbValid.value) {
                result = true;
            }
        }
        else {
            result = true;
        }
    }
    if(result) {
        emits("boxvalues-valid");
    } else {
        emits("boxvalues-invalid");
    }
}

// INTERFACE STRUCTURE - SWITCHES TO PREVIOUS FORM AND RESETS <ThirdForm>´s VALUES FIRST
function prevForm() {
    domainValue.value = "";
    dbValue.value = "not-clickable";
    deployValue.value = "";
    dataValue.value = "not-agreed";

    domainValid.value = false;
    dbValid.value = false;
    deployValid.value = false;
    dataValid.value = false;
    emits("update-domain-value", domainValue.value);
    emits("update-self-value", dbValue.value);
    emits("update-db-value", deployValue.value);
    emits("update-data-value", dataValue.value);
    emits("prev-form", 2);
    emits("boxvalues-invalid");
}
function submitForm() {
    if(domainValid.value && deployValid.value && dataValid.value) {
        if(domainValue.value === "yes")
        {
            if(dbValid.value) {
                emits("submit");
            }
        }
        else {
            emits("submit");
        }
    }
}
</script>


<style scoped>
.inputWrapper small {
    font-size: .6em;
}
.inputWrapper {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: start;
    align-items: flex-start;
}
.data-policy {
    width: 80%;
}
input[type="checkbox"] {
    appearance: none;
    width: 20px !important;
    aspect-ratio: 1;
    border: 1px solid black;
    background-color: var(--sec-dark);
    box-shadow: 0 0 10px 1px black inset;
    position: relative;
}
input[type="checkbox"]::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    transition: all .1s linear !important;
    background-image: radial-gradient(var(--tert) , #442f09 160%);
}
input[type="checkbox"]:checked::before {
    width: 80%;
    height: 80%;
}
input[type="checkbox"]:not(:checked)::before {
    width: 0%;
    height: 0%;
}
input[type="radio"] {
    appearance: none;
    width: 20px !important;
    aspect-ratio: 1;
    border: 1px solid black;
    border-radius: 50%;
    background-color: var(--sec-dark);
    box-shadow: 0 0 10px 1px black inset;
    position: relative;
}
input[type="radio"]::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    transition: all .1s linear !important;
    border-radius: 50%;
    background-image: radial-gradient(var(--tert) , #442f09 160%);
}
input[type="radio"]:checked::before {
    width: 80%;
    height: 80%;
}
input[type="radio"]:not(:checked)::before {
    width: 0%;
    height: 0%;
}
input[type="radio"] + label {
    font-size: .7em;
}
label, .data-policy {
    font-size: 16px;
}
@media screen and (min-width: 576px) {
    label, .data-policy {
        font-size: 20px;
    }
    .inputWrapper small {
        font-size: 12px;
    }
    input {
        font-size: 18px;
    }
    button {
        font-size: 20px;
    }
}
@media screen and (min-width: 768px) {
    label, .data-policy {
        font-size: 22px;
    }
    input {
        font-size: 20px;
    }
    .inputWrapper small {
        font-size: 14px;
    }
    button {
        font-size: 22px;
    }
    input[type="radio"] + label {
        font-size: 16px;
    }
}
</style>