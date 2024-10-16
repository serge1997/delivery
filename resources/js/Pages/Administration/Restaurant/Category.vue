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
                                    <InputText v-model="category.name" class="p-1" placeholder="nom de la category" />
                                    <small v-if="formErrors && formErrors.name" class="text-danger" v-text="formErrors.name.toString()"></small>
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label for="form-label">Description</label>
                                    <Textarea v-model="category.description" class="p-1" placeholder="nom de la promotion" />
                                    <small v-if="formErrors && formErrors.description" class="text-danger" v-text="formErrors.description.toString()"></small>
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <img class="w-25 image-thumbnail rounded-circle mb-3" :src="imageUrl" alt="">
                                    <input @change="handleImageUpload" class="d-none" type="file" id="restaurant-category-file" />
                                    <Button class="w-25 mb-1" @click="onOuputFileWindow" label="image" icon="pi pi-image" />
                                    <small v-if="formErrors && formErrors.image" class="text-danger" v-text="formErrors.image.toString()"></small>
                                </div>
                                <div class="mb-3 w-25 d-flex flex-column">
                                    <el-checkbox v-model="category.active" label="Activer ?" size="large" border />
                                </div>
                                <div class="mb-3 w-25 d-flex flex-column">
                                    <Button @click="handleCategoryFormSubmit" icon="pi pi-save" />
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
            category:{
                active: true,
                name: null,
                description: null,
                image: null,
            },
            promotions: [
                {name: "promo1", active: "Oui", description: "Desc placeholder", created_at: "04/10/2024"}
            ],
            imageUrl: null,
            formErrors: null
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
            this.category.image = file;
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
        },
        handleCategoryFormSubmit(){
            const data = new FormData();
            data.append('name', this.category.name);
            data.append('description', this.category.description);
            data.append('image', this.category.image);
            data.append('is_active', this.category.active);
            this.Api.post('/v1/category', data)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.formErrors = null;
            })
            .catch(error => {
                if (error.response.status == 422){
                    return this.formErrors = error.response.data.errors;
                }
                this.Notify.error(error.response.data.message)
            })
        },
        listAllCategories(){
            this.Api.get('/v1/category')
            .then(async response => {

            })
            .catch(error => {

            })
        }
    },
    mounted(){
        this.listAllCategories()
    }
}
</script>
