<template>
    <div>
        <Button @click="toggleOverlayCategory" class="d-flex gap-2 align-items-center border-red-btn-white rounded-pill" text>
            <span><i class="pi pi-table gold-btn-icon"></i></span>
            <span class="btn-text-small">{{ openButtonLabel }}</span>
        </Button>
        <OverlayPanel ref="overlay_side_dish">
            <div class="card border-0">
                <div class="card-header bg-transparent border-0">
                    <h6 class="d-none">Vos acompagnements</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group p-0 w-100">
                        <li v-for="side in sideDishes"  class="list-group-item w-100 border-0 cursor-p d-flex align-items-center justify-content-between gap-4">
                            <span class="simple-small-btn">{{ side.name }}</span>
                            <span>
                                <Button class="simple-small-btn" icon="pi pi-plus-circle" text/>
                            </span>
                        </li>
                    </ul>
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
        openButtonLabel: String
    },

    data(){
        return {
            overlay_side_dish: ref(null),
            sideDishes: null
        }
    },
    methods: {
        toggleOverlayCategory(event){
            this.overlay_side_dish.toggle(event);
        },
        listAllSideDish(){
            this.Api.get('/v1/side-dish/list-by-auth-restaurant')
            .then(async response => {
                this.sideDishes = await response.data.data;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        }
    },
    mounted(){
        this.overlay_side_dish = this.$refs.overlay_side_dish;
        this.listAllSideDish()
    }
}
</script>
