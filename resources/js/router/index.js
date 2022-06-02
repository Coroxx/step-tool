import { createRouter, createWebHistory } from "vue-router";

import MainPage from "../components/MainPage.vue";


const routes = [
    {
        path:'/',
        name : 'home',
        component : MainPage
    }
];

export default createRouter({
    history : createWebHistory(),
    routes
})