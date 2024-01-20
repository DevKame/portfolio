<template>
    <div class="messageContent position-absolute overflow-hidden d-flex flex-column justify-content-start align-items-center">
        <language-header @choose-language="toggleLanguage"></language-header>
        <div class="formWrapper ub-med-500 mt-3 mt-lg-0 pt-3 ps-xl-5 d-flex justify-content-center justify-content-xl-start align-items-start">

            <div class="formContent p-2 pt-3 overflow-hidden position-relative text-prim d-flex flex-column justify-content-start align-items-start">
                <div class="progressHolder position-absolute d-flex justify-content-center align-items-center">
                    <div class="position-relative">
                        <div class="progressBar position-absolute" ref="progressBar"></div>
                    </div>
                </div>
                <header class="w-100 mb-3 d-flex justify-content-between align-items-center">
                    <h3 class="tek-reg-400 m-0">{{ headline }}</h3>
                    <button class="btn-sec"><router-link :to="{name: 'Start'}">Homepage</router-link></button>
                </header>
                
                <transition name="forms" mode="out-in">
                    <first-form v-if="formHolder === 1 && showContent === 'forms'"
                    @load="toggleLoading"
                    @userdata-valid="addUserData"
                    @userdata-invalid="setProgressBarValue('0%')"
                    @next-form="next"></first-form>

                    <second-form v-else-if="formHolder === 2 && showContent === 'forms'"
                    @load="toggleLoading"
                    @desc-valid="addUserDesc"
                    @desc-invalid="setProgressBarValue('33.3%')"
                    @prev-form="prev"
                    @next-form="next"></second-form>

                    <third-form v-else-if="formHolder === 3 && showContent === 'forms'"
                    @load="toggleLoading"
                    @show-user-entries="showUserEntries"
                    @prev-form="prev"
                    @update-domain-value="updateDomainValue"
                    @update-db-value="updateDbValue"
                    @update-self-value="updateDeployValue"
                    @update-data-value="updateDataValue"
                    @boxvalues-valid="setProgressBarValue('100%')"
                    @boxvalues-invalid="setProgressBarValue('66.6%')"
                    @submit="submitUserEntries"
                    @show-datapolicy="toggleDataPolicy"></third-form>

                    <div v-else-if="showContent === 'success'" class="border border-3 border-success mt-4 p-2 rounded-2">
                        <h4>{{ successHeader }}</h4>
                        <p class="mt-3">{{ successText }}</p>
                    </div>
                    
                    <div v-else-if="showContent === 'too-soon'" class="border border-3 border-warning mt-4 p-2 rounded-2">
                        <h4>{{ soonHeader }}</h4>
                        <p class="mt-3">{{ soonText }}</p>
                    </div>

                    <div v-else-if="showContent === 'unknown'" class="border border-3 border-danger mt-4 p-2 rounded-2">
                        <h4>{{ errorHeader }}</h4>
                        <p class="mt-3">{{ errorText }}</p>
                    </div>
                </transition>
            </div>
            
        </div>
        <teleport to="body">
            <div v-if="isLoading" class="loadingWrapper position-fixed d-flex justify-content-center">
                <div class="loadingBackdrop d-flex justify-content-center align-items-center">
                    <div class="animationWrapper d-flex justify-content-between align-items-center">
                        <div class="bg-prim"></div>
                        <div class="bg-tert"></div>
                        <div class="bg-prim"></div>
                    </div>
                </div>
            </div>
        </teleport>
        <teleport to="body">
            <data-policy v-if="readDataPolicy"
            @close-datapolicy="toggleDataPolicy"></data-policy>
        </teleport>
    </div>
</template>

<script setup>
//TODO: API ENDPOINTS AN PRODUCTION ANPASSEN
import LanguageHeader from './LanguageHeader.vue';
import FirstForm from './FirstForm.vue';
import SecondForm from './SecondForm.vue';
import ThirdForm from './ThirdForm.vue';
import DataPolicy from './DataPolicy.vue';

import { ref,reactive, computed, provide, onMounted, watch } from 'vue';
// BACKEND - COLLECTION OF BACKEND API-ENDPOINTS
////////////////////////////////////////////////
// ENTRY VALIDATION - FOR VALIDATING USER ENTRIES
let API_VALIDATE = ref("../backend/validation/validate.php");
let API_SAVE_REQUEST = ref("../backend/requests/requests.php");
let API_MAIL = ref("../backend/mailing/mailing.php");
// received by [<FirstForm>, <SecondForm>, <ThirdForm>]
provide("api_val", API_VALIDATE);

// BACKEND - DETERMINES WHAT CONTENT TO SHOW. VALUES ARE:
// "forms"      : shows the form for the request
// "too-soon"   : if last request from same mail is not older than 6 hours
// "success"    : request was successfully sent
// "unknown"    : something else occured to make the sending impossible at the moment
let showContent = ref("forms");

let successHeader = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "Question sent!";
            break;
        case "ger":
            result = "Frage gesendet!";
            break;
    }
    return result;
});
let successText = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "If that Email exists, you will shortly hear from me!\nDont forget to check your spam folder, too.";
            break;
        case "ger":
            result = "Wenn die angegebene Email Adresse existiert, wirst du in Kürze benachrichtigt.\nVergiss nicht, deinen Spam - Ordner zu checken";
            break;
    }
    return result;
});
let soonHeader = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "Too soon!";
            break;
        case "ger":
            result = "Zu früh!";
            break;
    }
    return result;
});
let soonText = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "You last request was less than 6 hours ago. Please wait until you get an answer.";
            break;
        case "ger":
            result = "Deine letzte Anfrage ist weniger als 6 Stunden alt. Bitte warte eine Antwort ab.";
            break;
    }
    return result;
});
let errorHeader = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "Something went wrong!";
            break;
        case "ger":
            result = "Da lief etwas schief!";
            break;
    }
    return result;
});
let errorText = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "Something went wrong regarding the connection with the data base. Try again later.";
            break;
        case "ger":
            result = "Da lief etwas mit der Verbindung schief. Versuche es einfach zu einem späteren Zeitpunkt erneut.";
            break;
    }
    return result;
});

// DATA MANAGEMENT - COLLECTION OF ALL USER ENTRIES
let user_entries = reactive({
    lastname: "",
    firstname: "",
    email: "",
    desc: "",
    hasdomain: "",
    hasdb: "not-clickable",
    selfdeploy: "",
    datapolicy: "",
});
// DATA POLICY - SHOWS POLICY WINDOW IF TRUE
let readDataPolicy = ref(false);
function toggleDataPolicy(val) {
    readDataPolicy.value = val;
}

// PROGRESS BAR - INDICATES THE PROGRESS OF USERS ENTRIES
let progress = ref("0%");
let progressBar = ref();
// PROGRESS BAR - INITIALL SET TO 0%
onMounted(() => {
    changeProgressbarWidth();
});
// PROGRESS BAR - WHENEVER PROGRESS CHANGES, BAR GETS ADJUSTED
watch(progress, () => {
    changeProgressbarWidth();
});

// LOADING SCREEN - INDICATES WHEN TO SHOW LOADING SCREEN (true = loading, false = no loading)
let isLoading = ref(false);
function toggleLoading(val) {
    isLoading.value = val;
}

// DATA MANAGEMENT - USER ENTRIES, CONNECTED TO DOM WITH V-MODEL ((<FirstForm>))
let requestLastname = ref("");
let requestFirstname = ref("");
let requestEmail = ref("");
provide("requestLastname", requestLastname);
provide("requestFirstname", requestFirstname);
provide("requestEmail", requestEmail);

// DATA MANAGEMENT - USER ENTRIES, CONNECTED TO DOM WITH V-MODEL ((<SecondForm>))
let requestDesc = ref("");
provide("requestDesc", requestDesc);

// DATA MANAGEMENT - USER ENTRIES, CONNECTED TO DOM WITH V-MODEL ((<ThirdForm>))
let domainValue = ref("none");
let dbValue = ref("not-clickable");
let deployValue = ref("none");
let dataValue = ref("");
provide("domainValue", domainValue);
provide("dbValue", dbValue);
provide("deployValue", deployValue);
provide("dataValue", dataValue);



// INTERFACE LANGUAGE - DETERMINES IF 'ENG' OR 'GER'
let language_setting = ref("eng");
// received by [<FirstForm>, <SecondForm>, <ThirdForm>]
provide("language-setting", language_setting);

// INTERFACE STRUCTURE - DETERMINES WHICH FORM TO SHOW
// POSSIBLE VALUES ARE (1, 2, 3)
let formHolder = ref(1);

// INTERFACE LANGUAGE - SHOWS HEADLINE IN 'ENG' OR 'GER'
let headline = computed(() => {
    let result = "";
    switch(language_setting.value) {
        case "eng":
            result = "Ask a question";
            break;
        case "ger":
            result = "Stelle eine Frage";
            break;
    }
    return result;
});

/** INTERFACE LANGUAGE - TOGGLES LANGUAGE BETWEEN 'ENG' AND 'GER'
 * @param {String} lang => "eng" or "ger" */
function toggleLanguage(lang) {
    switch(lang) {
        case "eng":
            if(language_setting.value === "ger") language_setting.value = "eng";
            break;
        case "ger":
            if(language_setting.value === "eng") language_setting.value = "ger";
            break;
    }
}

/** INTERFACE STRUCTURE - SWITCHES TO PREVIOUS FORM
 * @param {number} val => 1, 2 or 3 */
function prev(val) {
    formHolder.value = val;
}
/** INTERFACE STRUCTURE - SWITCHES TO NEXT FORM
 * @param {number} val => 1, 2 or 3 */
function next(val) {
    formHolder.value = val;
}
/** DATA MANAGEMENT - RECEIVES VALID USER DATA AND ADDS IT TO user_entries FROM <FirstForm>
 * @param {Object} data => last-/firstname and email as Strings */
function addUserData(data) {
    progress.value = "33.3%";
    user_entries.lastname = data.ln;
    user_entries.firstname = data.fn;
    user_entries.email = data.em;
}
// PROGRESS BAR - SETS THE VALUE OF PROGRESSBAR TO 'val'
function setProgressBarValue(val) {
    progress.value = val;
}
// PROGRESS BAR - CHANGES PROGRESS BAR WIDTH TO ITS VALUE
function changeProgressbarWidth() {
    progressBar.value.style.width = progress.value;
}
// DATA MANAGEMENT - RECEIVES VALID USER DESC AND ADDS IT TO user_entries FROM <SecondForm>
function addUserDesc(data) {
    progress.value = "66.6%";
    user_entries.desc = data.desc;
}
// DEVELOPMENT - SHOWING ALL ENTERED VALUES USING user_entries
function showUserEntries() {
}

// DATA MANAGEMENT - RECEIVES VALID BOX VALUES AND ADDS IT TO user_entries FROM <ThirdForm>
function updateDomainValue(val) {
    domainValue.value = val;
    user_entries.hasdomain = val;
    showUserEntries();
}
function updateDbValue(val) {
    dbValue.value = val;
    user_entries.hasdb = val;
    showUserEntries();
}
function updateDeployValue(val) {
    deployValue.value = val;
    user_entries.selfdeploy = val;
    showUserEntries();
}
function updateDataValue(val) {
    dataValue.value = val;
    user_entries.datapolicy = val;
    showUserEntries();
}

// BACKEND - SAVES REQUEST IN DATABASE AND SENDS EMAILS
async function submitUserEntries() {
    toggleLoading(true);
    showUserEntries();
    let response = await fetch(API_SAVE_REQUEST.value, {
        method: "post",
        body: JSON.stringify({
            ...user_entries,
            task: "save_user_request",
            timestamp: Date.now().toString().slice(3)
        }),
        headers: {"Content-Type": "application/json"},
    });

    let data = await response.json();

    if(data.success) {
        showContent.value = "success";
        if(!document.location.href.includes("localhost"))
        {
            sendEmailToMe();
        }
    }
    else {
        if(data.reason && data.reason === "wait-6")
        {
            showContent.value = "too-soon";
        } else {
            showContent.value = "unknown";
        }
    }



    toggleLoading(false);
}


async function sendEmailToMe() {
    let response = await fetch(API_MAIL.value, {
        method: "post",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({...user_entries, task: "mail-after-question"}),
    });

    let data = await response.json();
    console.table(data);
}
</script>

<style scoped>
.animationWrapper div:first-child {
    animation: loads 1s linear infinite;
}
.animationWrapper div:nth-child(2) {
    animation: loads 1s linear infinite .4s;
}
.animationWrapper div:last-child {
    animation: loads 1s linear infinite;
}
@keyframes loads {
    0% {
        transform: translate(0, 0) scale(1);
    }
    25% {
        transform: translate(0, -50%) scale(1.2);
    }
    50% {
        transform: translate(0, 0) scale(1);
    }
    75% {
        transform: translate(0, 50%) scale(.8);
    }
    100% {
        transform: translate(0, 0) scale(1);
    }
}
.animationWrapper div {
    width: clamp(50px, 25%, 75px);
    aspect-ratio: 1;
}
.animationWrapper {
    width: clamp(200px, 30vw, 400px);
    aspect-ratio: 1.5;
}
.loadingBackdrop {
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,.7);
}
.loadingWrapper {
    width: 100%;
    height: 100vh;
    top: 0;
    left: 0;
}
.progressBar {
    top: 0;
    left: 0;
    height: 100%;
    background-image: linear-gradient(to top, var(--tert), white);
    transition: width .2s linear;
}
.progressHolder > div {
    width: 100%;
    height: 100%;
}
.progressHolder {
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
}
.forms-enter-from {
    opacity: 0;
    transform: translate(150%, -30%);
}
.forms-enter-active {
    transition: all .3s ease-out;
}
.forms-enter-to {
    opacity: 1;
    transform: translate(0, 0);
}
.forms-leave-from {
    opacity: 1;
    transform: translate(0, 0);
}
.forms-leave-active {
    transition: all .3s ease-in;
}
.forms-leave-to {
    opacity: 0;
    transform: translate(-150%, 30%);
}

button a {
    all: unset;
    font-size: 16px;
}
.formContent {
    width: 90%;
    max-width: 600px;
    height: 95%;
    border: 1px solid var(--form-content-border-color);
    border-radius: 15px;
}
.formWrapper {
    width: 100%;
    height: 80vh;
}
.messageContent {
    width: 100%;
    height: 100vh;
}
@media screen and (min-width: 768px) {
    button a {
        font-size: 18px;
    }
}
</style>
