<template>
    <div class="row">
        <div class="col-md-4">
            <Button @click="toggleAddressInfoOverlay" class="rounded-circle text-white border-0 p-3 btn-restaurant-sidebar-info">
                <i class="pi pi-info-circle fw-bold"></i>
            </Button>
        </div>
        <OverlayPanel :style="{width: '22rem'}" ref="addressInfoOverlayToggle">
            <div class="row">
                <div class="card border-0">
                    <div class="card-header bg-transparent border-0">
                        <h6 class="d-flex justify-content-center align-items-center gap-2">
                            <span><i class="pi pi-map-marker"></i></span>
                            <span>Abidjan</span>
                        </h6>
                    </div>
                    <div class="card-body">
                        <Tag icon="pi pi-flag" value="  Marcory, Zone 4, Rue Albert Almeida 345" severity="secondary" />
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="w-100 d-flex gap-1 align-items-center justify-content-center">
                            <a class="nav-link">
                                <i style="color: #f87171;" class="pi pi-instagram"></i>
                            </a>
                            <a class="nav-link">
                                <i class="pi pi-facebook"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </OverlayPanel>
    </div>
</template>
<script>
import { ref } from 'vue';

export default {
    name: 'AddressInfoOverlayComponent',

    data(){
        return {
            addressInfoOverlayToggle: ref(null)
        }
    },

    methods: {
        toggleAddressInfoOverlay(event){
            this.addressInfoOverlayToggle.toggle(event);
        }
    },
    mounted(){
        this.addressInfoOverlayToggle = this.$refs.addressInfoOverlayToggle;
    }
}
</script>
