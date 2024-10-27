import { createRouter, createWebHistory } from "vue-router";

import Home from "../Pages/Home.vue";
import Promotion from "../Pages/Administration/Restaurant/Promotion.vue";
import Category from "../Pages/Administration/Restaurant/Category.vue";
import FoodType from "../Pages/Administration/Restaurant/FoodType.vue";
import RestaurantRegister from "../Pages/Register/RestaurantRegister.vue";
import Establishment from "../Pages/Administration/Configuration/Establishment.vue";
import RestaurantLogin from "../Pages/Auth/RestaurantLogin.vue";
import RestaurantProfile from "../Pages/Order/RestaurantProfile.vue";
import Menuitem from "../Pages/Administration/Configuration/Menuitem.vue";


const routes = [
    {
        path: '/',
        component: Home,
        name: 'Home',
        meta: {guest: true}
    },
    {
        path:'/administration/restaurant',
        meta: {requiresAuth: true},
        children: [
            {path: 'promotion', component: Promotion, name: 'Administration.Promotion'},
            {path: 'category', component: Category, name: 'Administration.Category'},
            {path: 'food-type', component: FoodType, name: 'Administration.FoodType'}
        ]
    },
    {
        path: '/register',
        children: [
            {path: 'restaurant', component: RestaurantRegister, name: 'Register.Restaurant'}
        ]
    },
    {
        path: '/administration/configuration',
        meta: {requiresAuth: true},
        children: [
            {path: 'establishment', component: Establishment, name: 'Config.Establishment'},
            {path: 'menuitem', component: Menuitem, name: 'Config.Menuitem'}
        ]
    },
    {
        path: '/login',
        children: [
            {path: '@auth-restaurant', component: RestaurantLogin, name: 'RestaurantLogin'}
        ]
    },
    {
        path: '/order/profile/:id/:slug',
        name: 'RestaurantProfile',
        component: RestaurantProfile
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
