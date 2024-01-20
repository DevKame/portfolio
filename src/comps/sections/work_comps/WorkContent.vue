<template>
    <div class="workContent d-flex flex-column justfiy-content-end justify-content-lg-start align-items-center align-items-lg-start ps-xxl-5">

        <div class="menuDescWrapper d-flex flex-column justify-content-between align-items-center mt-auto mt-lg-0 pt-3 pt-md-3 pt-lg-5">





            <div class="workInterface position-relative overflow-hidden d-flex flex-column justify-content-start align-items-center p-1 p-lg-2">
                <work-interface></work-interface>
                
                <transition name="work-interface" mode="out-in">
                    <div v-if="showWork === 'vocabs'" class="headerLinksWrapper d-flex flex-column justify-content-start align-items-center">

                        <div class="workHeaderWrapper d-flex justify-content-center align-items-center">
                            <h3 class="workTitle">{{ allWorks[0].title }}</h3>
                        </div>
                        <div class="workLinksWrapper position-relative d-flex justify-content-center align-items-center">
                            <a :href="allWorks[0].github" target="_blank" class="me-2">
                                <div class="iconLinkWrapper d-flex flex-column justify-content-start align-items-center">
                                    <fa-icon class="workInterfaceIcons" icon="fa-brands fa-github" size="xl"></fa-icon>
                                    <p class="m-1">GitHub</p>
                                </div>
                            </a>
                            
                            <a :href="allWorks[0].work" target="_blank" class="ms-2">
                                <div class="iconLinkWrapper d-flex flex-column justify-content-start align-items-center">
                                    <fa-icon class="workInterfaceIcons" icon="fa-solid fa-up-right-from-square" size="xl"></fa-icon>
                                    <p class="m-1">Visit</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div v-else-if="showWork === 'money'" class="headerLinksWrapper d-flex flex-column justify-content-start align-items-center">

                        <div class="workHeaderWrapper d-flex justify-content-center align-items-center">
                            <h3 class="workTitle">{{ allWorks[1].title }}</h3>
                        </div>
                        <div class="workLinksWrapper position-relative d-flex justify-content-center align-items-center">
                            <a :href="allWorks[1].github" target="_blank" class="me-2">
                                <div class="iconLinkWrapper d-flex flex-column justify-content-start align-items-center">
                                    <fa-icon class="workInterfaceIcons" icon="fa-brands fa-github" size="xl"></fa-icon>
                                    <p class="m-1">GitHub</p>
                                </div>
                            </a>
                            
                            <a :href="allWorks[1].work" target="_blank" class="ms-2">
                                <div class="iconLinkWrapper d-flex flex-column justify-content-start align-items-center">
                                    <fa-icon class="workInterfaceIcons" icon="fa-solid fa-up-right-from-square" size="xl"></fa-icon>
                                    <p class="m-1">Visit</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </transition>


                <div @click="getPrevWork" class="previousWork position-absolute d-flex justiofy-content-center align-items-center">
                    <fa-icon class="workInterfaceIcons" icon="fa-solid fa-chevron-left" size="2xl"></fa-icon>

                </div>
                
                <div  @click="getNextWork" class="nextWork position-absolute d-flex justiofy-content-center align-items-center">
                    <fa-icon class="workInterfaceIcons" icon="fa-solid fa-chevron-right" size="2xl"></fa-icon>
                    
                </div>
            </div>

            <div class="workDesc overflow-hidden mb-5 mt-md-5 p-2 p-lg-3 p-xl-4 d-flex justify-content-start align-items-center">
                <transition name="work-desc" mode="out-in">
                    <p v-if="showWork === 'vocabs'" class="m-0 pe-none">{{allWorks[0].desc}}</p>
                    <p v-else-if="showWork === 'money'" class="m-0 pe-none">{{allWorks[1].desc}}</p>
                </transition>
            </div>

        </div>

    </div>
</template>

<script setup>
import {ref} from "vue";

import WorkInterface from "./WorkInterface.vue";

const currentWorkIndex = ref(0);
const workArray = ref([
    "vocabs",
    "money",
]);
const showWork = ref("vocabs");

function getPrevWork() {
    if(currentWorkIndex.value - 1 < 0) {
        currentWorkIndex.value = workArray.value.length - 1;
    } else {
        currentWorkIndex.value--;
    }
    showWork.value = workArray.value[currentWorkIndex.value];
}
function getNextWork() {
    if(currentWorkIndex.value + 1 === workArray.value.length) {
        currentWorkIndex.value = 0;
    } else {
        currentWorkIndex.value++;
    }
    showWork.value = workArray.value[currentWorkIndex.value];
}
let allWorks =
ref(
    [
        {
        title: "Vocabulary - Trainer",
        github: "https://github.com/DevKame/vocabs",
        work: "https://vocabs.kamed.in/",
        desc: "This webapplication is a digital vocabulary box. It allows you to create and learn your vocabulary. Creat your vocabularys within your topics and use the learning mode to practise. The learning mode tracks the wrongs and rights so you have a level displayed for every card to have an eye on the ones you may need to learn more often.",
        },
        {
        title: "Moneytracker",
        github: "https://github.com/DevKame/moneytracker",
        work: "https://money.kamed.in/",
        desc: "Moneytracker is an application where you can keep track on your finances for your personal overview about how much you have spend this month. How much budget is left for this month and per week. You can create your own categories to structure your dashboard. You can create different users (family, business, etc) to isolate spendings that not belong together",

        },
    ]
);

</script>


<style scoped>
/* WHEN CLICKING PREV/NEXT I DONT WANT THE DESCRIPTION TO BE SELECTED */
p::selection {
    background-color: var(--prim);
    color: #bac1de;
}
.workDesc p {
    font-size: 14px;
    line-height: 1.5;
}
.workDesc {
    border: 3px solid var(--tert);
    border-radius: 15px;
    width: 80%;
    min-height: 50%;
}
.work-desc-enter-from {
    transform: scaleX(.3);
    opacity: 0;
}
.work-desc-enter-active {
    transition: transform .3s ease-out, opacity .2s ease-out;
}
.work-desc-enter-to {
    transform: scaleX(1);
    opacity: 1;
}
.work-desc-leave-from {
    transform: scale(1);
    opacity: 1;
}
.work-desc-leave-active {
    transition: transform .3s ease-out, opacity .2s ease-out;
}
.work-desc-leave-to {
    transform: scaleX(1.5);
    opacity: 0;
}
.work-interface-enter-from {
    transform: translate(0, -150%) scale(.7);
    opacity: 0;
}
.work-interface-enter-active {
    transition: transform .3s ease-out, opacity .2s ease-out;
}
.work-interface-enter-to {
    transform: translate(0, 0) scale(1);
    opacity: 1;
}
.work-interface-leave-from {
    transform: translate(0, 0) scale(1);
    opacity: 1;
}
.work-interface-leave-active {
    transition: transform .3s ease-out, opacity .2s ease-out;
}
.work-interface-leave-to {
    transform: translate(0, 150%) scale(.7);
    opacity: 0;
}
.workTitle {
    background-image: linear-gradient(to bottom, var(--tert) 50%, rgb(200,200,200));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 16px;
}
.workHeaderWrapper,
.workLinksWrapper {
    width: 100%;
}
.workLinksWrapper a {
    font-size: 12px;
}
.headerLinksWrapper {
    width: 100%;
    height: 100%;
}
a,
.workInterfaceIcons {
    color: var(--tert);
    text-decoration: none;
}
.nextWork,
.previousWork {
    transform: translate(0, -50%);
    cursor: pointer;
}
.nextWork {
    top: 50%;
    right: 5%;
}
.previousWork {
    top: 50%;
    left: 5%;
}
.workInterface {
    width: 60%;
}











.menuDescWrapper {
    height: 80%;
    width: 100%;
}
.workContent {
    width: 100%;
    height: 100vh;
}
@media screen and (min-width: 768px) {
    .workDesc p {
        font-size: 16px;
        line-height: 1.5;
    }
    .workTitle {
        font-size: 20px;
    }
    .workLinksWrapper a {
        font-size: 16px;
    }
    .workInterface {
        width: 70%;
    }





    .menuDescWrapper {
        height: 80%;
        width: 90%;
    }
}
@media screen and (min-width: 992px) {
    .workTitle {
        font-size: 20px;
    }









    .menuDescWrapper {
        height: 100%;
        width: 50%;
    }
}
@media screen and (min-width: 1200px) {
    .workDesc p {
        font-size: 20px;
        line-height: 2;
    }
    .workTitle {
        font-size: 24px;
    }
    .workInterface {
        width: 50%;
    }
}
@media screen and (min-width: 1400px) {
    .workDesc p {
        font-size: clamp(22px, 2vmax, 24px);
        line-height: 2;
    }
    .workTitle {
        font-size: 28px;
    }
}
</style>