<template>
    <div class="d-flex mobile-food-type-box-div mt-2 overflow-scroll m-auto mb-2 p-1">
        <div class="w-100" v-for="type in foodTypes">
            <Button @click="$emit('listByResraurantFoodType', type.id)" class="mobile-food-type-btn" text>
                <span>{{ type.name }}({{ type.count_menuitems }})</span>
            </Button>
        </div>
    </div>
</template>
<script>
export default {
    name: 'ListFoodTypeMobileComponent',
    props: {
        foodTypes: Object
    }
}
</script>
<style scoped>
.btn {
    white-space: nowrap;
}
.mobile-food-type-btn{
    color: #52525b;
    white-space: nowrap;
    font-weight: 600;
    border-right: 1px solid #d1d5db;
}

.mobile-food-type-box-div{
    background-color: #f5f5f5;
    overflow: scroll;
}
@media only screen and (max-width: 600px) {
    *{
        box-sizing: border-box;
    }
    .mobile-food-type-btn{
        font-size: .8em;
    }
}
</style>
