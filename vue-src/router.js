import FeatureBoard from "./Components/FeatureBoard";
import FeatureRequestList from "./Components/FeatureRequestList";
import {createRouter, createWebHashHistory} from "vue-router";

const router = [
    {path: '/', name: 'shortcode', component: FeatureBoard},
    {path: '/feature-board', name: 'featureBaord', component: FeatureBoard},
    {path: '/feature-request-list', name: 'featureRequestList', component: FeatureRequestList},
]

export default createRouter({
    history: createWebHashHistory(),
    routes: router
})