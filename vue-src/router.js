import Shortcode from "./Components/Shortcode";
import {createRouter, createWebHashHistory} from "vue-router";

const router = [
    {path: '/', name: 'shortcode', component: Shortcode},
]

export default createRouter({
    history: createWebHashHistory(),
    routes: router
})