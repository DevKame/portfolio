


//LOAD ASSETS:
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import "./assets/styles/colors.css";
import "./assets/fonts/fonts.css";

//FONTAWESOME:
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faUser } from '@fortawesome/free-regular-svg-icons';
import { faLaptopCode } from "@fortawesome/free-solid-svg-icons";
import { faMicrochip } from "@fortawesome/free-solid-svg-icons";
import { faLocationDot } from "@fortawesome/free-solid-svg-icons";
import { faBriefcase } from "@fortawesome/free-solid-svg-icons";
import { faAt } from "@fortawesome/free-solid-svg-icons";
import { faGithub } from "@fortawesome/free-brands-svg-icons";
import { faUpRightFromSquare } from "@fortawesome/free-solid-svg-icons";
import { faChevronLeft } from "@fortawesome/free-solid-svg-icons";
import { faChevronRight } from "@fortawesome/free-solid-svg-icons";
import { faJs } from "@fortawesome/free-brands-svg-icons";
import { faVuejs } from "@fortawesome/free-brands-svg-icons";
import { faCss3Alt } from "@fortawesome/free-brands-svg-icons";
import { faPhp } from "@fortawesome/free-brands-svg-icons";
import { faBootstrap } from "@fortawesome/free-brands-svg-icons";
import { faSass } from "@fortawesome/free-brands-svg-icons";
import { faPython } from "@fortawesome/free-brands-svg-icons";
import { faHtml5 } from "@fortawesome/free-brands-svg-icons";
import { faGit } from "@fortawesome/free-brands-svg-icons";
import { faMessage } from "@fortawesome/free-regular-svg-icons";
import { faXmark } from "@fortawesome/free-solid-svg-icons";

library.add(faUser);
library.add(faLaptopCode);
library.add(faMicrochip);
library.add(faLocationDot);
library.add(faBriefcase);
library.add(faAt);
library.add(faGithub);
library.add(faUpRightFromSquare);
library.add(faChevronLeft);
library.add(faChevronRight);
library.add(faJs);
library.add(faVuejs);
library.add(faCss3Alt);
library.add(faBootstrap);
library.add(faPhp);
library.add(faSass);
library.add(faPython);
library.add(faHtml5);
library.add(faGit);
library.add(faMessage);
library.add(faXmark);

//CUSTOM COMPS:
import AllSections from "./comps/AllSections.vue";
import TheMessage from "./comps/message/TheMessage.vue";



import { createApp } from 'vue'
import App from './App.vue'

//VUE ROUTER:
import { createRouter, createWebHistory } from "vue-router";
const router = createRouter({
    history: createWebHistory(),
    routes:
    [
        {
            path: "/", name: "Start", component: AllSections,
        },
        {
            path: "/message", name: "Message", component: TheMessage,
        }
    ]
})




const app = createApp(App);

app.component("fa-icon", FontAwesomeIcon);
app.use(router);

router.isReady().then(function() {
    app.mount('#app');
});

// app.mount('#app');