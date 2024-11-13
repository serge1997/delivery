<template>
    <div>
        <Button @click="toggleOverlayCategory" class="d-flex gap-2 align-items-center border-red-btn-white rounded-pill" text>
            <span><i class="pi pi-table gold-btn-icon"></i></span>
            <span class="btn-text-small">{{ openButtonLabel }}</span>
        </Button>
        <OverlayPanel ref="overlay_side_dish" style="width: 280px;">
            <div class="card border-0">
                <div class="card-header bg-transparent border-0">
                    <h6 class="d-none">Vos acompagnements</h6>
                </div>
                <div class="card-body p-0">
                    <MultiSelect @change="$emit('sharedData', post_data.side_dish_id)" v-model="post_data.side_dish_id" id="side_dishes" class="w-100" :options="sideDishes" option-label="name"/>
                </div>
            </div>
        </OverlayPanel>
    </div>
</template>
<script>
import { ref } from 'vue';

export default{
    name: 'SideDishOverlayComponent',
    props: {
        openButtonLabel: String,
        menuitem: Object,
        sideDishes: Object
    },

    data(){
        return {
            overlay_side_dish: ref(null),
            post_data: {
                side_dish_id: []
            }
        }
    },
    methods: {
        toggleOverlayCategory(event){
            this.overlay_side_dish.toggle(event);
        },

    },
    mounted(){
        this.overlay_side_dish = this.$refs.overlay_side_dish;
    }
}
</script>
