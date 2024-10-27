<template>
   <NavbarComponent>
        <div class="container-fluid">
            <div class="row d-flex flex-column">
                <div class="col-md-2 col-sm-12">
                    <div class="row profile-sidebar-header" style="background-image: url('/images/restaurant-card.png'); height: 180px;">
                        <div class="col-md-12 p-1">
                           <div class="w-100 d-flex justify-content-between">
                                <Button class="rounded-circle border-0 p-3 btn-restaurant-sidebar-back">
                                    <i class="pi pi-angle-left fw-bold"></i>
                                </Button>
                                <Button class="rounded-circle text-white border-0 p-3 btn-restaurant-sidebar-info">
                                    <i class="pi pi-info-circle fw-bold"></i>
                                </Button>
                           </div>
                        </div>
                    </div>
                    <div class="row profile-sidebar-body d-none d-md-inline-block">
                        <div class="w-100">
                            <h2>{{name}}</h2>
                            <small class="fw-light">Info address</small>
                        </div>
                        <div class="w-100">
                            <ul class="list-group">
                                <li class="list-group-item border-0 fw-bold">
                                    Planche de fromage
                                </li>
                                <li class="list-group-item border-0 fw-bold">
                                    Salades
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </NavbarComponent>
</template>
<script>
export default {
    name: 'RestaurantProfile',
    data(){
        return {
            name: this.$route.params.slug
        }
    }
}
</script>
<style>
.profile-sidebar-header{
    background-repeat: no-repeat;
    background-size: cover;
}
.btn-restaurant-sidebar-info{
    background-color: #334155;
    color: #cbd5e1;
}
.btn-restaurant-sidebar-back{
    background-color: #e2e8f0;
    color: #334155;
}
</style>
