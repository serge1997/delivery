<template>
   <NavbarComponent>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <Button @click="visibleCreateAddressAdmModal = true" class="general-btn" icon="pi pi-plus-circle" label="Nouvelle address" />
            </div>
        </div>
        <div class="row">
           <Dialog v-model:visible="visibleCreateAddressAdmModal" class="w-75">
                <CreateAddressAdmComponent
                    @update-ui="closeModal"
                />
           </Dialog>
        </div>
    </div>
   </NavbarComponent>
</template>
<script>
import { defineAsyncComponent } from 'vue';
export default {

    components: {
        CreateAddressAdmComponent: defineAsyncComponent(() =>
            import('../../../components/Administration/CreateAddressAdmComponent.vue')
        )
    },

    data(){
        return{
            visibleCreateAddressAdmModal: false
        }
    },
    methods: {
        closeModal(){
            this.visibleCreateAddressAdmModal = false;
        }
    }
}
</script>
