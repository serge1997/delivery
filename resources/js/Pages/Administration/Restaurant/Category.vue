<template>
    <NavbarComponent>
        <div class="container-fluid">
            <div class="row">
                <div class="colmd-8">
                    <Button @click="visibleCreateCategoryModal = true" class="general-btn" icon="pi pi-plus-circle" label="Nouvelle category" />
                    <Dialog v-model:visible="visibleCreateCategoryModal" modal :style="{ width: '45rem', borderRadius: '4rem' }">
                        <div class="row">
                            <div class="col-md-10 m-auto">
                                <div class="mb-3 d-flex flex-column">
                                    <label for="form-label">Nom</label>
                                    <InputText class="p-1" placeholder="nom de la category" />
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label for="form-label">Description</label>
                                    <Textarea class="p-1" placeholder="nom de la promotion" />
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <img class="w-25 image-thumbnail rounded-circle mb-3" :src="imageUrl" alt="">
                                    <input @change="handleImageUpload" class="d-none" type="file" id="restaurant-category-file" />
                                    <Button class="w-25" @click="onOuputFileWindow" label="image" icon="pi pi-image" />
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
import { ElMessage } from 'element-plus';
export default{
    name: 'Administration.Category',

    data(){
        return {
            visibleCreateCategoryModal: false,
            promotion:{
                active: false
            },
            promotions: [
                {name: "promo1", active: "Oui", description: "Desc placeholder", created_at: "04/10/2024"}
            ],
            imageUrl: null
        }
    },
    methods: {
        onInactivatePromotion(){
            alert("Hey")
        },
        onOuputFileWindow(){
            let inputFile = document.querySelector('#restaurant-category-file');
            inputFile.click()
        },
        handleImageUpload(e){
            let file = e.target.files[0];
            let img = URL.createObjectURL(file);
            const reader = new FileReader();
            reader.onload = () => {
                this.imageUrl = reader.result
            }
            reader.onloadend = () => {
                ElMessage({
                    message: "Image chargé avec succés",
                    type: 'success'
                })
            }
            reader.onerror = () => {
                ElMessage({
                    message: "error en telechargeant l'image",
                    type: 'error'
                })
            }
            reader.readAsDataURL(file)
            //this.imageUrl = img
        }
    }
}
</script>
