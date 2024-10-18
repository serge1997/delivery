<template>
    <NavbarComponent>
        <div class="container-fluid">
            <div class="row">
                <div class="colmd-8">
                    <Button @click="clearInputs" class="general-btn" icon="pi pi-plus-circle" label="Nouvelle category" />
                    <Dialog v-model:visible="visibleCreateCategoryModal" modal :style="{ width: '45rem', borderRadius: '4rem' }">
                        <div class="row">
                            <div class="col-md-10 m-auto">
                                <div class="mb-3 d-flex flex-column">
                                    <input type="hidden" v-model="category.id" />
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
                                    <img v-if="!category.id" class="w-25 image-thumbnail rounded-circle mb-3" :src="imageUrl" alt="">
                                    <input @change="handleImageUpload" class="d-none" type="file" id="restaurant-category-file" />
                                    <Button v-if="!category.id" class="w-25 mb-1" @click="onOuputFileWindow" label="image" icon="pi pi-image" />
                                    <small v-if="formErrors && formErrors.image" class="text-danger" v-text="formErrors.image.toString()"></small>
                                </div>
                                <div class="mb-3 w-25 d-flex flex-column">
                                    <el-checkbox v-model="category.is_active" label="Activer ?" size="large" border />
                                </div>
                                <div class="mb-3 w-25 d-flex flex-column">
                                    <Button @click="handleCategoryFormSubmit" icon="pi pi-save" />
                                </div>
                            </div>
                        </div>
                    </Dialog>
                </div>
            </div>
            <div class="row">
                <Dialog v-model:visible="visibleUpdateImageModal" modal :style="{ width: '45rem', borderRadius: '4rem' }">
                    <UpdateImageComponent
                        :old-url="`/images/categories/${category.image}`"
                        api-url="/v1/category/update/image"
                        :entity-id="category.id"
                     />
                </Dialog>
            </div>
            <div class="container mt-3">
                <div class="row">
                   <div class="col-md-12 m-auto">
                        <el-table class="m-auto" :data="categories" style="width: 100%">
                            <el-table-column prop="name" label="Nom" width="180"/>
                            <el-table-column show-overflow-tooltip width="180" prop="description" label="Descrition"/>
                            <el-table-column prop="active_status" label="Active" />
                            <el-table-column prop="created_at" label="Créer le" />
                            <el-table-column label="images">
                                <template #default="scope">
                                    <div class="w-50">
                                        <img class="w-50" :src="`/images/categories/${scope.row.image}`" alt="">
                                    </div>
                                </template>
                            </el-table-column>
                            <el-table-column fixd="right" label="Actions" width="300">
                                <template  #default="scope">
                                    <el-button @click="findCategory(scope); visibleCreateCategoryModal = true">
                                        <i class="pi pi-file-edit"></i>
                                    </el-button>
                                    <el-popconfirm @confirm="handleToggleCategoryStatus(scope)" :title="popCategoryIsActiveMessage(scope.row.is_active)" width="220">
                                        <template #reference>
                                            <el-button class="p-0">
                                                <i v-if="scope.row.is_active" class="pi pi-lock-open text-warning"></i>
                                                <i v-else class="pi pi-lock text-success"></i>
                                            </el-button>
                                        </template>
                                    </el-popconfirm>
                                    <el-button @click="findCategory(scope);visibleUpdateImageModal=true">
                                        <i class="pi pi-image"></i>
                                    </el-button>
                                    <el-button class="d-none">
                                        <i class="pi pi-trash text-danger"></i>
                                    </el-button>
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
import { isNullOrWhiteSpace, when } from '../../../core/Utilities';
export default{
    name: 'Administration.Category',

    data(){
        return {
            visibleCreateCategoryModal: false,
            visibleUpdateImageModal: false,
            category:{
                id: null,
                is_active: true,
                name: null,
                description: null,
                image: null,
            },
            categories: null,
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
        },
        formaData(){
            const data = new FormData();
            data.append('name', isNullOrWhiteSpace(this.category.name) ? "" :this.category.name);
            data.append('description', isNullOrWhiteSpace(this.category.description) ? "" : this.category.description);
            data.append('image', this.category.image);
            data.append('is_active', this.category.is_active);
            data.append('id', this.category.id);
            return data;
        },
        createCategory(){
            const data = this.formaData();
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
        updateCategory(){
            this.Api.put('/v1/category', null, this.category)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.formErrors = null;
                this.clearInputs(false);
                this.visibleCreateCategoryModal = false;
                this.listAllCategories()
            })
            .catch(error => {
                if (error.response.status == 422){
                    return this.formErrors = error.response.data.errors;
                }
                this.Notify.error(error.response.data.message)
            })
        },
        handleCategoryFormSubmit(){
            when(!this.category.id, this.createCategory, this.updateCategory);
        },
        listAllCategories(){
            this.Api.get('/v1/category')
            .then(async response => {
                this.categories = await response.data.data;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message);
            })
        },
        findCategory(category){
            this.Api.get(`/v1/category/${category.row.id}`)
            .then(async response => {
                this.category = await response.data.data;
                this.category.is_active = response.data.data.is_active == 1 ? true : false;
                this.imageUrl = "/images/categories/" + this.category.image;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message);
            })
        },
        handleToggleCategoryStatus(category){
            this.Api.put(`/v1/category/status/${category.row.id}`)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.listAllCategories();
            })
            .catch(error => {
                this.Notify.error(error.response.data.message);
            })
        },
        clearInputs(openModal = true){
            this.category.name = null;
            this.category.description = null;
            this.category.is_active = false;
            this.category.image = null;
            this.imageUrl = null;
            this.category.id = null;
            when(openModal, this.visibleCreateCategoryModal = true);
        },
        popCategoryIsActiveMessage(status){
            return status === 1 ?
                "voulez vous desactiver cette categorie" :
                    "voulez vous activer cette categorie"
        },
    },
    mounted(){
        this.listAllCategories()
        let val = when(false, 10);
        console.log(val);
    }
}
</script>
