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
                    :categories="categories"
                    :is-for-admin="false"
                />
            </div>
        </Dialog>
    </div>
</template>
<script>
import CategoryDatatableComponent from '../datatables/CategoryDatatableComponent.vue';
export default{
    name: 'EstablishmentCategoryComponent',

    components: {
        CategoryDatatableComponent
    },

    data(){
        return {
            visibleListAllCategoryModal: false,
            promotion:{
                active: false
            },
            categories: null,
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
        }
    },
    mounted(){
        this.listAllCategoriesActive();
    }
}
</script>
