<template>
   <div class="row">
        <div class="container mt-3">
            <div class="row mt-3">
                <h5>Categories</h5>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">
                    <Button @click="visibleListAllCategoryModal = true" class="border rounded-3" text icon="pi pi-plus-circle" />
                </div>
            </div>
            <div class="row mt-3">
               <div class="col-md-12 m-auto">
                    <el-table class="m-auto" :data="promotions" style="width: 95%">
                        <el-table-column prop="name" label="Nom" />
                        <el-table-column show-overflow-tooltip prop="description" label="Descrition"/>
                        <el-table-column fixd="right" label="Actions">
                            <template  #default>
                                <el-button>
                                    <i class="pi pi-trash text-danger"></i>
                                </el-button>
                                <el-popconfirm @confirm="onInactivatePromotion" title="voulez vous desactiver cette promotion" width="220">
                                    <template #reference>
                                        <el-button>
                                            <i class="pi pi-lock-open text-warning"></i>
                                        </el-button>
                                    </template>
                                </el-popconfirm>
                            </template>
                        </el-table-column>
                    </el-table>
               </div>
            </div>
       </div>
       <Dialog v-model:visible="visibleListAllCategoryModal" modal :style="{ width: '75rem', borderRadius: '4rem' }">
            <div class="row">
                <CategoryDatatableComponent
                    :categories="post_data.categories_id"
                    :is-for-admin="false"
                    @remove-category="removeCategory"
                />
            </div>
            <div class="row p-2">
                <div class="col-md-10">
                    <label for="select-foodtypes" class="form-label fw-bold">Selectionnez les categories</label>
                    <MultiSelect class="w-75" v-model="post_data.categories_id" :options="categories" option-label="name"></MultiSelect>
                </div>
                <div class="col-md-10 mt-3">
                    <Button @click="createRestaurantCategories" class="general-btn" icon="pi pi-save" label="Enregistrer" />
                </div>
             </div>
        </Dialog>
    </div>
</template>
<script>
import { when } from '../../core/Utilities';
import CategoryDatatableComponent from '../datatables/CategoryDatatableComponent.vue';
export default{
    name: 'EstablishmentCategoryComponent',

    components: {
        CategoryDatatableComponent
    },

    data(){
        return {
            visibleListAllCategoryModal: false,
            post_data:{
                restaurant_id: this.Auth.authId(),
                categories_id: []
            },
            categories: null,
            restaurantCategories: null
        }
    },
    methods: {
        onInactivatePromotion(){
            alert("Hey")
        },
        listAllCategoriesActive(){
            this.Api.get('/v1/category/actives')
            .then(async response => {
                this.categories = await response.data.data;
            })
        },
        removeCategory(data){
            this.post_data.categories_id.forEach((el, index) => {
                when(el.id === data.row.id, () => this.post_data.categories_id.splice(index, 1))
            })
        },
        createRestaurantCategories(){
            this.post_data.categories_id = this.post_data.categories_id.map(cat => cat.id);
            this.Api.post('/v1/restaurant-category', this.post_data)
            .then(async response => {
                this.Notify.success(await response.data.message)
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        }
    },
    mounted(){
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.Auth.getToken()}`
        this.listAllCategoriesActive();
    }
}
</script>
