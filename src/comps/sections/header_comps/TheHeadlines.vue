<template>
    <div class="headlineWrapper position-absolute p-md-0 d-flex flex-column justify-content-start align-items-start">
        <transition>
            <h2 v-if="readyToAnimate" class="smallHeadline headlines m-0 d-flex jsutify-content-center align-items-between">
                <span>K</span>
                <span>A</span>
                <span>M</span>
                <span>E</span>
                <span>D</span>
                <span>I</span>
                <span>N</span>
            </h2>
        </transition>
            <h1 class="bigHeadline headlines d-flex justify-content-between align-items-between">
                <transition name="l1">
                    <span v-if="readyToAnimate">W</span>
                </transition>
                <transition name="l2">
                    <span v-if="readyToAnimate">E</span>                    
                </transition>
                <transition name="l3">
                    <span v-if="readyToAnimate">B</span>                   
                </transition>
                <transition name="l4">
                    <span v-if="readyToAnimate">D</span>                   
                </transition>
                <transition name="l5">
                    <span v-if="readyToAnimate">E</span>                   
                </transition>
                <transition name="l6">
                    <span v-if="readyToAnimate">S</span>                  
                </transition>
                <transition name="l7">                 
                    <span v-if="readyToAnimate">I</span>
                </transition>
                <transition name="l8">
                    <span v-if="readyToAnimate">G</span>                   
                </transition>
                <transition name="l9">
                    <span v-if="readyToAnimate">N</span>                  
                </transition>
            </h1>
    </div>
</template>

<script setup>
import {computed, ref,onMounted} from "vue";

//HANDLES THE FADING IN ANIMATION OF BOTH HEADLINES:
let isMounted = ref(false);
let readyToAnimate = computed(() => {return isMounted.value});
onMounted(() => {isMounted.value = true});
//##################################################

</script>



<style scoped>
.v-enter-from {
    opacity: 0;
}
.v-enter-to {
    opacity: 1;
}
.v-enter-active {
    transition: opacity .5s ease-in 3s;
}
.l1-enter-from,
.l2-enter-from,
.l3-enter-from,
.l4-enter-from,
.l5-enter-from,
.l6-enter-from,
.l7-enter-from,
.l8-enter-from,
.l9-enter-from {
    transform: translate(0, 50%);
    opacity: 0;
}
.l1-enter-active {
    transition: transform 1s ease-out .2s, opacity 1s ease-in .4s;
}
.l2-enter-active {
    transition: transform 1s ease-out .4s, opacity 1s ease-in .6s;
}
.l3-enter-active {
    transition: transform 1s ease-out .6s, opacity 1s ease-in .8s;
}
.l4-enter-active {
    transition: transform 1s ease-out .8s, opacity 1s ease-in 1s;
}
.l5-enter-active {
    transition: transform 1s ease-out 1s, opacity 1s ease-in 1.2s;
}
.l6-enter-active {
    transition: transform 1s ease-out 1.2s, opacity 1s ease-in 1.4s;
}
.l7-enter-active {
    transition: transform 1s ease-out 1.4s, opacity 1s ease-in 1.6s;
}
.l8-enter-active {
    transition: transform 1s ease-out 1.6s, opacity 1s ease-in 1.8s;
}
.l9-enter-active {
    transition: transform 1s ease-out 1.8s, opacity 1s ease-in 2s;
}
.l1-enter-to,
.l2-enter-to,
.l3-enter-to,
.l4-enter-to,
.l5-enter-to,
.l6-enter-to,
.l7-enter-to,
.l8-enter-to,
.l9-enter-to {
    transform: translate(0);
    opacity: 1;
}
.bigHeadline span {
    background-image: linear-gradient(160deg, rgb(186, 193, 222) -20%, var(--prim) 70%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    filter: drop-shadow(0 0 3px black);
}
.smallHeadline span {
    background-image: linear-gradient(145deg, rgba(186, 193, 222, .3), rgba(186, 193, 222, 0) 80%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.smallHeadline {
    font-family: "Tektur Regular 400", sans-serif;
    letter-spacing: 4px;
    font-size: 20px;
    line-height: .8;
}
.bigHeadline {
    font-family: "Tektur Bold 700", sans-serif;
    letter-spacing: 10px;
    font-size: 40px;
}
.headlineWrapper {
    top: calc(241px + 10%);
    left: 50%;
    transform: translate(-50%, 0);
}

@media screen and (min-width: 576px) {
    .headlineWrapper {
        top: calc(241px + 10%);
        left: 50%;
        transform: translate(-50%, 0);
    }
    .smallHeadline {
        font-size: 25px;
    }
    .bigHeadline {
        font-size: 45px;
    }
}
@media screen and (min-width: 768px) {
    .headlineWrapper {
        top: calc(301px + 10%);
        left: 50%;
        transform: translate(-50%, 0);
    }
    .smallHeadline {
        font-size: 30px;
    }
    .bigHeadline {
        font-size: 50px;
    }
}
@media screen and (min-width: 992px) {
    .headlineWrapper {
        top: 50%;
        left: calc(276px + 3%);
        transform: translate(0, 10%);
    }
    .smallHeadline {
        font-size: 30px;
    }
    .bigHeadline {
        font-size: 50px;
    }
}
@media screen and (min-width: 1200px) {
    .headlineWrapper {
        top: 50%;
        left: calc(276px + 7.5%);
        transform: translate(0, 10%);
    }
    .smallHeadline {
        font-size: 40px;
    }
    .bigHeadline {
        font-size: 60px;
    }
}
@media screen and (min-width: 1400px) {
    .headlineWrapper {
        top: 50%;
        left: calc(413px + 10%);
        transform: translate(0, 20%);
    }
    .smallHeadline {
        font-size: 50px;
    }
    .bigHeadline {
        font-size: 70px;
    }
}
</style>