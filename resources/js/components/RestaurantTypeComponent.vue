<template>
    <div class="container-fluid mt-2" id="restaurant-type-box">
        <div class="d-flex" id="restaurant-type-box-content">
            <div>
                <Button style="max-width: 6rem;" class="d-flex flex-column align-items-center resturant-type-btn justify-content-center px-0" text>
                    <img class="w-75 img-thumbnail rounded-circle" src="images/italiana.png" alt="">
                    <span class="restaurant-type-description">Italien</span>
                </Button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'RestaurantTypeComponent'
}
</script>
<style>
#restaurant-type-box-content{
    overflow: scroll;
    transition: .3s ease-in;
}

.resturant-type-btn{
    transition: .4s ease-in;
}
.resturant-type-btn:hover{
    transform: scale(1.1);
}
.restaurant-type-description{
    color: #374151;
    font-weight: 600;
}
</style>
