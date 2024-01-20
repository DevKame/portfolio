
<template>
    <div class="fullBackdrop position-fixed d-flex justify-content-center align-items-center">
        <div class="policyWindow p-3 pt-0 d-flex flex-column justify-content-start align-items-center border border-3 border-black bg-prim text-prim">
            <header class="w-100 d-flex justify-content-end align-items-center">
                <div @click="emits('close-datapolicy', false)" class="closeButton rounded-circle p-2 border border-black bg-sec d-inline-flex justify-content-center aling-items-center">
                    <fa-icon icon="fa-solid fa-xmark" class="icons"></fa-icon>
                </div>
            </header>
            <h3 class="hl me-auto mt-3">Data Policy</h3>
            <br>
            <p>The information you send will be securely saved and going to be used to contact you. If no cooperation arises, your data will be completly deleted after 10 days or after your particular request</p><br/>
            <p>You can request at any time to delete everything about your data no matter the time. Just write such a request to website@kamed.in</p>
            <br/>
            <p>By sending a request and fill ing out those forms you agree to the temporary saving of your data</p>
        </div>
    </div>
</template>

<script setup>
import { defineEmits } from 'vue';

let emits = defineEmits(["close-datapolicy"]);


</script>


<style scoped>
.closeButton {
    cursor: pointer;
}
.icons {
    color: var(--tert);
}
header {
    height: 5%;
    min-height: 50px;
}
.hl {
    font-family: "Tektur Regular 400";
    letter-spacing: 2px;
}
.policyWindow {
    width: clamp(300px, 30%, 400px);
}
.fullBackdrop {
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background-color: rgba(0,0,0,.6);
}

</style>