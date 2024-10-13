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
       <Dialog v-model:visible="visibleListAllCategoryModal" modal :style="{ width: '65rem', borderRadius: '4rem' }">
            <div class="row">
                <el-table class="m-auto mb-3" :data="promotions" style="width: 95%">
                    <el-table-column sortable prop="name" label="Nom" />
                    <el-table-column show-overflow-tooltip prop="description" label="Descrition"/>
                    <el-table-column fixd="right" label="Actions">
                        <template  #default>
                            <el-popconfirm @confirm="onInactivatePromotion" title="voulez vous addicionner cette categorie ?" width="220">
                                <template #reference>
                                    <el-button>
                                        <i class="pi pi-plus-circle text-success"></i>
                                    </el-button>
                                </template>
                            </el-popconfirm>
                        </template>
                    </el-table-column>
                </el-table>
            </div>
        </Dialog>
    </div>
</template>
<script>
export default{
    name: 'EstablishmentCategoryComponent',

    data(){
        return {
            visibleListAllCategoryModal: false,
            promotion:{
                active: false
            },
            promotions: [
                {name: "promo1", active: "Oui", description: "Desc placeholder", created_at: "04/10/2024"}
            ]
        }
    },
    methods: {
        onInactivatePromotion(){
            alert("Hey")
        }
    }
}
</script>
