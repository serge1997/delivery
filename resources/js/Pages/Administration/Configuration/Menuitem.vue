<template>
    <NavbarComponent>
        <div class="row">
            <div class="col-md-10 m-auto">
                <Button @click="visibleCreateMenuitemModal = true" class="general-btn" icon="pi pi-plus-circle" label="Nouveaux item de votre menu" />
            </div>
            <Dialog v-model:visible="visibleCreateMenuitemModal" header="Nouveau item" modal maximizable :style="{ width: '75rem', borderRadius: '4rem' }">
                <CreateMenuitemComponent />
            </Dialog>
        </div>
    </NavbarComponent>
</template>
<script>
import CreateMenuitemComponent from '../../../components/Configuration/CreateMenuitemComponent.vue';
export default {
    name: 'Menuitem',

    components: {
        CreateMenuitemComponent
    },

    data(){
        return {
            visibleCreateMenuitemModal: false,
            menuitems: null
        }
    },
    methods: {
        listAuthMenuitens(){
            this.Api.get('/v1/menuitem/list-by-auth-restaurant')
            .then(async response => {
                this.menuitems = await response.data.data;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        }
    },
    mounted(){
        this.listAuthMenuitens();
    }
}
</script>
