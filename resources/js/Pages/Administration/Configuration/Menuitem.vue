<template>
    <NavbarComponent>
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-10 m-auto">
                    <Button @click="visibleCreateMenuitemModal = true" class="general-btn" icon="pi pi-plus-circle" label="Nouveaux item de votre menu" />
                </div>
                <Dialog v-model:visible="visibleCreateMenuitemModal" header="Nouveau item" modal maximizable :style="{ width: '75rem', borderRadius: '4rem' }">
                    <CreateMenuitemComponent />
                </Dialog>
            </div>
            <div class="row">
                <MenuitemsDatableComponent
                    :menuitems="menuitems"
                    @find-menuitem="findMenuitem"
                    @handle-toggle-menuitem-status="handleToggleMenuitemStatus"
                />
            </div>
            <div class="row">
                <Dialog v-model:visible="visibleUpdateMenuitemModal" header="Actualisez votre menu" modal maximizable :style="{ width: '75rem', borderRadius: '4rem' }">
                    <UpdateMenuitemComponent
                        :menuitem="menuitem"
                        @list-all-menuitem="listAuthMenuitens"
                    />
                </Dialog>
            </div>
        </div>
    </NavbarComponent>
</template>
<script>
import CreateMenuitemComponent from '../../../components/Configuration/CreateMenuitemComponent.vue';
import MenuitemsDatableComponent from '../../../components/datatables/MenuitemsDatableComponent.vue';
import UpdateMenuitemComponent from '../../../components/Configuration/UpdateMenuitemComponent.vue';
export default {
    name: 'Menuitem',

    components: {
        CreateMenuitemComponent,
        MenuitemsDatableComponent,
        UpdateMenuitemComponent
    },

    data(){
        return {
            visibleCreateMenuitemModal: false,
            visibleUpdateMenuitemModal: false,
            menuitems: null,
            menuitem: null
        }
    },
    methods: {
        listAuthMenuitens(){
            this.Api.get('/v1/menuitem/list-by-auth-restaurant')
            .then(async response => {
                this.visibleUpdateMenuitemModal = false;
                this.menuitems = await response.data.data;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        },
        findMenuitem(param){
            this.Api.get(`/v1/menuitem/${param.row.id}`)
            .then(async response => {
                this.menuitem = await response.data.data
                this.visibleUpdateMenuitemModal = true;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        },
        handleToggleMenuitemStatus(data){
            this.Api.put(`/v1/menuitem/is-active/${data.row.id}`)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.listAuthMenuitens();
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
