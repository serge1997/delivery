<template>
        <div class="d-flex justify-content-center">
            <Button icon="pi pi-bars" text @click="visibleSideBar = true" />
            <Sidebar v-model:visible="visibleSideBar" header="Sidebar">
                <template #header>
                    <div>
                        LOGO
                    </div>
                </template>
                <div class="row">
                    <div class="w-100">
                        <el-menu id="menu-guest">
                            <el-menu-item v-if="!isAuthenticated" class="p-1 mt-3 mb-2" index="1">
                                <Button severity="success" class="w-100 p-1 rounded-2" label="Enregistrer votre restaurant">
                                    <router-link class="text-decoration-none text-white w-100" :to="{ name: 'Register.Restaurant'} ">
                                        Enregistrer votre restaurant
                                    </router-link>
                                </Button>
                            </el-menu-item>
                        </el-menu>
                        <el-menu id="menu-customer" v-if="isAuthenticated && Auth.isCustomer()">
                            <el-menu-item index="2-1-2">
                                <router-link class="text-dark text-decoration-none d-flex align-items-center gap-2" to="/administration/restaurant/category">
                                    <i class="pi pi-truck"></i>
                                    <span>Restaurants</span>
                                </router-link>
                            </el-menu-item>
                        </el-menu>
                       <el-menu id="menu-restaurant" class="p-2" v-if="isAuthenticated && Auth.isRestaurant()">
                            <el-menu-item index="1">Processing Center</el-menu-item>
                            <el-sub-menu index="2">
                                <template class="d-flex align-items-center" #title>
                                    <i class="pi pi-cog"></i>
                                    <span class="px-2">Configuation</span>
                                </template>
                                <el-menu-item index="2-1-2">
                                    <router-link class="text-dark text-decoration-none d-flex align-items-center gap-2" :to="{ name: 'Config.Menuitem' }">
                                        <i class="pi pi-box"></i>
                                        <span>Plats</span>
                                    </router-link>
                                </el-menu-item>
                                <el-menu-item index="2-1-2">
                                    <router-link class="text-dark text-decoration-none d-flex align-items-center gap-2" to="/administration/restaurant/category">
                                        <i class="pi pi-truck"></i>
                                        <span>Livraison</span>
                                    </router-link>
                                </el-menu-item>
                                <el-menu-item index="2-1-2">
                                    <router-link class="text-dark text-decoration-none d-flex align-items-center gap-2" :to="{ name: 'Config.Establishment'}">
                                        <i class="pi pi-home"></i>
                                        <span>Etablissement</span>
                                    </router-link>
                                </el-menu-item>
                            </el-sub-menu>
                            <el-sub-menu v-if="isAuthenticated" index="3">
                                <template #title>
                                    <i class="pi pi-warehouse"></i>
                                    <span class="px-2">Administration</span>
                                </template>
                                <el-sub-menu index="3-1">
                                    <template #title>Resturant</template>
                                    <el-menu-item index="3-1-1">
                                        <router-link class="text-dark text-decoration-none" :to="{ name: 'Administration.Promotion'}">Promotion</router-link>
                                    </el-menu-item>
                                    <el-menu-item index="3-1-2">
                                        <router-link class="text-dark text-decoration-none" :to="{ name: 'Administration.Category' }">Category</router-link>
                                    </el-menu-item>
                                    <el-menu-item index="3-1-3">
                                        <router-link class="text-dark text-decoration-none" :to="{ name: 'Administration.FoodType' }">Type de plats</router-link>
                                    </el-menu-item>
                                </el-sub-menu>
                                <el-sub-menu index="4-1">
                                    <template #title>Address</template>
                                    <el-menu-item index="4-1-1">
                                        <router-link class="text-dark text-decoration-none" :to="{ name: 'Administration.Address'}">Consulter</router-link>
                                    </el-menu-item>
                                </el-sub-menu>
                            </el-sub-menu>
                       </el-menu>
                    </div>
                </div>
            </Sidebar>
        </div>
</template>
<script>
export default{
    inject: ['isAuthenticated'],
    name: 'SidebarComponent',

    data(){
        return{
            visibleSideBar: false,
        }
    }
}
</script>
<style>
.el-menu .el-menu-item {
    font-size: 1em;
}
.el-menu .el-sub-menu__title{
    font-size: 1em;
}
</style>
