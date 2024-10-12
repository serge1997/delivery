<template>
    <div class="container-fluid p-0">
        <div class="w-100">
            <el-menu class="navbar-el-menu border-bottom d-flex justify-content-between p-0">
            <div class="shadow-sm d-flex gap-2 p-0 el-menu-iem-box">
                    <div class="w-25 d-flex">
                        <el-menu-item class="d-flex">
                            <SidebarComponent />
                        </el-menu-item>
                        <el-menu-item index="1" class="text-dark">
                            <router-link class="text-dark text-decoration-none" to="/">LOGO</router-link>
                        </el-menu-item>
                    </div>
                    <div class="p-0 w-75 d-flex">
                        <el-menu-item class="p-0 w-100" index="1">
                            <el-input v-model="input" placeholder="Please input" />
                        </el-menu-item>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="button-box cart-box-button">
                        <Button text icon="pi pi-cart-arrow-down"/>
                    </div>
                    <div class="button-box">
                        <Button class="d-flex gap-2" text>
                            <span><i class="pi pi-user"></i></span>
                            <span>Login</span>
                        </Button>
                    </div>
                </div>
            </el-menu>
        </div>
        <div class="w-100 mt-3">
            <slot></slot>
        </div>
    </div>
</template>
<script>
import SidebarComponent from './SidebarComponent.vue';
export default {
    name: 'NavbarComponent',

    components: {
        SidebarComponent
    },

    data(){
        return {
            input: null,
            navbarItems: [
                {
                    label: 'Home',
                    icon: 'pi pi-home'
                },
                {
                    label: 'Features',
                    icon: 'pi pi-star'
                },
            ]
        }
    }
}
</script>
<style>
.p-menuitem-content .p-menuitem-link{
    text-decoration: none;
}
.el-menu-iem-box{
    width: 60rem;
}
@media only screen and (max-width: 600px){
    .el-menu-iem-box{
        width: 16rem;
    }
}
.cart-box-button{
    border-right: 1px solid #9ca3af;
}
</style>
