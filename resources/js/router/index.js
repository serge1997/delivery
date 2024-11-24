import component from "element-plus/es/components/tree-select/src/tree-select-option.mjs";
import { createRouter, createWebHistory } from "vue-router";


const routes = [
    {
        path: '/',
        component: () => import("../Pages/Home.vue"),
        name: 'Home',
        meta: {guest: true}
    },
    {
        path:'/administration/restaurant',
        meta: {requiresAuth: true},
        children: [
            {
                path: 'promotion',
                component: () => import("../Pages/Administration/Restaurant/Promotion.vue"),
                name: 'Administration.Promotion'},
            {
                path: 'category',
                component: () => import("../Pages/Administration/Restaurant/Category.vue"),
                name: 'Administration.Category'},
            {
                path: 'food-type',
                component: () => import("../Pages/Administration/Restaurant/FoodType.vue"),
                name: 'Administration.FoodType'
            }
        ]
    },
    {
        path: '/register',
        children: [
            {
                path: 'restaurant',
                component: () => import("../Pages/Register/RestaurantRegister.vue"),
                name: 'Register.Restaurant'
            },
            {
                path: 'customer',
                component: () => import("../Pages/Register/CustomerRegister.vue"),
                name: 'CustomerRegister'
            }
        ]
    },
    {
        path: '/administration/configuration',
        meta: {requiresAuth: true},
        children: [
            {
                path: 'establishment',
                component: () => import("../Pages/Administration/Configuration/Establishment.vue"),
                name: 'Config.Establishment'
            },
            {
                path: 'menuitem',
                component: () => import("../Pages/Administration/Configuration/Menuitem.vue"),
                name: 'Config.Menuitem'
            }
        ]
    },
    {
        path: '/login',
        children: [
            {
                path: '@auth-restaurant',
                component: () => import("../Pages/Auth/RestaurantLogin.vue"),
                name: 'RestaurantLogin'
            }
        ]
    },
    {
        path: '/order/profile/:id/:slug',
        name: 'RestaurantProfile',
        component: () => import("../Pages/Order/RestaurantProfile.vue")
    },
    {
        path: '/order/checkout',
        name: 'Checkout',
        component: () => import("../Pages/Order/Checkout.vue")
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
