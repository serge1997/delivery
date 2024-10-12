<template>
    <NavbarComponent>
        <div class="container-fluid">
            <div class="row">
                <div class="colmd-8">
                    <Button @click="visibleCreateFoodTypeModal = true" class="general-btn" icon="pi pi-plus-circle" label="Nouveaux type de plat" />
                    <Dialog v-model:visible="visibleCreateFoodTypeModal" modal :style="{ width: '45rem', borderRadius: '4rem' }">
                        <div class="row">
                            <div class="col-md-10 m-auto">
                                <div class="mb-3 d-flex flex-column">
                                    <label for="form-label">Nom</label>
                                    <InputText class="p-1" placeholder="nom de la promotion" />
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label for="form-label">Description</label>
                                    <Textarea class="p-1" placeholder="nom de la promotion" />
                                </div>
                                <div class="mb-3 w-25 d-flex flex-column">
                                    <el-checkbox v-model="promotion.active" label="Activer ?" size="large" border />
                                </div>
                            </div>
                        </div>
                    </Dialog>
                </div>
            </div>
            <div class="container mt-3">
                <div class="row">
                   <div class="col-md-10 m-auto">
                        <el-table class="m-auto" :data="promotions" style="width: 95%">
                            <el-table-column prop="name" label="Nom" />
                            <el-table-column show-overflow-tooltip prop="description" label="Descrition"/>
                            <el-table-column prop="active" label="Active" />
                            <el-table-column prop="created_at" label="Créer le" />
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
        </div>
    </NavbarComponent>
</template>
<script>
export default{
    name: 'Administration.FoodType',

    data(){
        return {
            visibleCreateFoodTypeModal: false,
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
