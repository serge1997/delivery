import { createRouter, createWebHistory } from "vue-router";

import Home from "../Pages/Home.vue";
import Promotion from "../Pages/Administration/Restaurant/Promotion.vue";
import Category from "../Pages/Administration/Restaurant/Category.vue";
import FoodType from "../Pages/Administration/Restaurant/FoodType.vue";
import RestaurantRegister from "../Pages/Register/RestaurantRegister.vue";
import Establishment from "../Pages/Administration/Configuration/Establishment.vue";
import RestaurantLogin from "../Pages/Auth/RestaurantLogin.vue";
import component from "element-plus/es/components/tree-select/src/tree-select-option.mjs";

const routes = [
    {
        path: '/',
        component: Home,
        name: 'Home'
    },
    {
        path:'/administration/restaurant/promotion',
        component: Promotion,
        name: 'Administration.Promotion'
    },
    {
        path: '/administration/restaurant/category',
        component: Category,
        name: 'Administration.Category'
    },
    {
        path: '/administration/restaurant/food-type',
        component: FoodType,
        name: 'Administration.FoodType'
    },
    {
        path: '/register/restaurant',
        component: RestaurantRegister,
        name: 'Register.Restaurant'
    },
    {
        path: '/administration/configuration/establishment',
        component: Establishment,
        name: 'Config.Establishment'
    },
    {
        path: '/login',
        children: [
            {path: '@auth-restaurant', component: RestaurantLogin, name: 'RestaurantLogin'}
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
