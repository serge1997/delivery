<template>
    <NavbarComponent>
        <div class="container-fluid">
            <div class="row mb-3">
                <Toolbar>
                    <template #start>
                        <div class="w-100 d-flex gap-2">
                            <Button @click="visibleCreateMenuitemModal = true" class="general-btn" icon="pi pi-plus-circle" label="Nouveaux" />
                            <Button @click="visibleCreateSideDishModal = true" class="toolbar-btn border-0 rounded-pill" icon="pi pi-plus-circle" label="Nouveaux acompagnement" />
                        </div>
                    </template>
                </Toolbar>
            </div>
            <div class="row mb-3">
                <Dialog v-model:visible="visibleCreateMenuitemModal" header="Nouveau item" modal maximizable :style="{ width: '75rem', borderRadius: '4rem' }">
                    <CreateMenuitemComponent
                        @list-menuitems-by-restaurant="listAuthMenuitens"
                    />
                </Dialog>
                <Dialog v-model:visible="visibleCreateSideDishModal" header="Nouveau acompagnement" modal maximizable :style="{ width: '75rem', borderRadius: '4rem' }">
                    <CreateSideDishComponent
                        @close-modal="() => visibleCreateSideDishModal = false"
                    />
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
                        @updateModalUi="findMenuitem"
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
import CreateSideDishComponent from '../../../components/Configuration/CreateSideDishComponent.vue';
export default {
    name: 'Menuitem',

    components: {
        CreateMenuitemComponent,
        MenuitemsDatableComponent,
        UpdateMenuitemComponent,
        CreateSideDishComponent
    },

    data(){
        return {
            visibleCreateMenuitemModal: false,
            visibleUpdateMenuitemModal: false,
            menuitems: null,
            menuitem: null,
            visibleCreateSideDishModal: false
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
            let id = param.row ? param.row.id : param;
            this.Api.get(`/v1/menuitem/${id}`)
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
