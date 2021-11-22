import FeatureBoard from "./Components/FeatureBoard";
import {createRouter, createWebHashHistory} from "vue-router";

const router = [
    {path: '/', name: 'shortcode', component: FeatureBoard},
    {path: '/feature-board', name: 'featureBaord', component: FeatureBoard},
]

export default createRouter({
    history: createWebHashHistory(),
    routes: router
})