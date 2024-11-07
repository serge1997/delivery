<template>
    <div class="row">
        <div class="col-md-10 m-auto">
            <div class="row mb-3">
                <OverlayPanel ref="overlay_category">
                    <ul class="list-group border-0">
                        <li @click="selectCategory" v-for="category in categories" class="list-group-item list-category-item d-flex gap-3 align-items-center border-0" :data-id="category.id" :data-name="category.category">
                            <span class="w-25">
                                <img style="width: 40px;" class="rounded-circle" :src="`/images/categories/${category.image}`" alt="">
                            </span>
                            <span>
                                {{category.category}}
                            </span>
                        </li>
                    </ul>
                </OverlayPanel>
                <div class="col-md-10 d-flex gap-2">
                    <Button class="d-flex gap-2 align-items-center border-red-btn-white rounded-pill" text>
                        <span><i class="pi pi-box gold-btn-icon"></i></span>
                        <span class="btn-text-small">Faites une promotions sur cet item</span>
                    </Button>
                    <Button @click="toggleOverlayCategory" class="d-flex gap-2 align-items-center border-red-btn-white rounded-pill" text>
                        <span><i class="pi pi-table gold-btn-icon"></i></span>
                        <span class="btn-text-small">Addicionez une category a cet item</span>
                    </Button>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-8" v-if="isCategorySelect">
                    <small class="btn-text-small">Category selecionnée: </small>
                    <Tag class="rounded-3" icon="pi pi-check" severity="success" :value="selectedCategoryName"></Tag>
                    <Tag @click="isCategorySelect = !isCategorySelect; menuitem.category_id = null" class="bg-transparent text-danger cursor-p" icon="pi pi-times"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3 d-flex flex-column">
                    <label for="form-label">Nom</label>
                    <InputText v-model="menuitem.name" class="p-1" placeholder="nom de la promotion" />
                    <small class="text-danger" v-if="formErrors && formErrors.name" v-text="formErrors.name.toString()"></small>
                </div>
                <div class="col-md-6 mb-3 d-flex flex-column">
                    <label for="form-label">Prix</label>
                    <InputText v-model="menuitem.price"  class="p-1" placeholder="nom de la promotion" />
                    <small class="text-danger" v-if="formErrors && formErrors.price" v-text="formErrors.price.toString()"></small>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3 d-flex flex-column">
                    <label for="form-label">Type de plats</label>
                    <Dropdown :options="foodTypes" optionLabel="name" v-model="menuitem.food_type_id" placeholder="nom de la promotion" />
                    <small class="text-danger" v-if="formErrors && formErrors.restaurant_food_type_id" v-text="formErrors.restaurant_food_type_id.toString()"></small>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3 d-flex flex-column">
                    <label for="form-label">Descrition du plat</label>
                    <Textarea v-model="menuitem.description" class="p-1" placeholder="Descrition du plat" />
                    <small class="text-danger" v-if="formErrors && formErrors.description" v-text="formErrors.description.toString()"></small>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3 w-25 d-flex flex-column">
                        <el-checkbox v-model="menuitem.is_active" label="Activer ?" size="large" border />
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="mb-3 d-flex flex-column">
                    <img v-if="!menuitem.id" class="w-25 image-thumbnail rounded-circle mb-3" :src="imageUrl" alt="">
                    <input @change="handleImageUpload" class="d-none" type="file" id="menuitem-image-input" />
                    <Button v-if="!menuitem.id" text class="w-25 mb-1 d-flex flex-column file-upload rounded-3" @click="onOuputFileWindow">
                        <span class="fw-light d-flex gap-2">
                            <span><i class="pi pi-image"></i></span>
                            <span>Upload image</span>
                        </span>
                        <span>
                            <small class="fw-light">PNG, JPEG</small>
                        </span>
                    </Button>
                    <small v-if="formErrors && formErrors.image" class="text-danger" v-text="formErrors.image.toString()"></small>
                </div>
            </div>
            <div class="row">
                <Button @click="createMenuitem" class="rounded-pill" label="Enregistrer" />
            </div>
        </div>
    </div>
</template>
<script>
import { ref } from 'vue';
import { isNull, when } from '../../core/Utilities';


export default {
    name: 'CreateMenuitemComponent',

    data(){
        return {
            menuitem: {
                id: null,
                name: null,
                food_type_id: null,
                image: null,
                price: null,
                description: null,
                category_id: null,
                restaurant_id: this.Auth.authId(),
                is_active: false
            },
            formErrors: {},
            imageUrl: null,
            foodTypes: null,
            categories: null,
            isCategorySelect: false,
            overlay_category: ref(null),
            selectedCategoryName: null,
            post_data: new FormData()
        }
    },
    methods: {
        handleImageUpload(e){
            let file = e.target.files[0];
            let file_extension = file.type.split('/').pop();
            let extensions = ['png', 'jpeg', 'jpg'];
            if (!extensions.includes(file_extension)){
                let error = `extension non autorisé, seulement (${extensions.toString()})`;
                this.formErrors.image = error;
                return this.Notify.error(error);
            }
            const reader = new FileReader();
            reader.onload = () => {
                this.imageUrl = reader.result;
                this.menuitem.image = file;
            }
            reader.onloadend = () => {
                when(!isNull(this.imageUrl), this.Notify.success("l'image télécharge avec succes"));
            }
            reader.readAsDataURL(file)
        },
        onOuputFileWindow(){
            document.querySelector('#menuitem-image-input').click();
        },
        listRestaurantFoodTypes(){
            this.Api.get(`/v1/restaurant-food-type/list-by-restaurant/${this.menuitem.restaurant_id}`)
            .then(async response => {
                this.foodTypes = await response.data.data;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        },
        listRestaurantCategoryByRestaurant(){
            this.Api.get(`/v1/restaurant-category/list-by-restaurant/${this.menuitem.restaurant_id}`)
            .then(async response => {
                this.categories = await response.data.data;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        },
        toggleOverlayCategory(event){
            this.overlay_category.toggle(event);
        },
        selectCategory(event){
            let evTarget = event.target;
            this.isCategorySelect = true;
            let self = this;
            when(evTarget.nodeName !== 'LI',
                () => {
                    self.selectedCategoryName = evTarget.parentElement.getAttribute('data-name')
                    self.menuitem.category_id = evTarget.parentElement.getAttribute('data-id')
                },
                () => {
                    self.selectedCategoryName = evTarget.getAttribute('data-name')
                    self.menuitem.category_id = evTarget.getAttribute('data-id')
                }
            )
            this.toggleOverlayCategory(event)
        },
        createMenuitem(){
           try{
               this.post_data.append('restaurant_category_id', this.menuitem.category_id ?? '');
               this.post_data.append('description', this.menuitem.description ?? '');
               this.post_data.append('name', this.menuitem.name ?? '');
               this.post_data.append('restaurant_food_type_id', this.menuitem.food_type_id != null ? this.menuitem.food_type_id.id : '');
               this.post_data.append('price', this.menuitem.price ?? '');
               this.post_data.append('image', this.menuitem.image);
               this.post_data.append('restaurant_id', this.menuitem.restaurant_id ?? '');
               this.post_data.append('is_active', this.menuitem.is_active == true ? 1 : '');

               this.Api.post('/v1/menuitem', this.post_data)
               .then(async response => {
                    this.formErrors = null;
                    this.clearInputs();
                    this.Notify.success(await response.data.message);
                    this.$emit('listMenuitemsByRestaurant')
               })
               .catch(error => {
                    when(error.response.status == 500, this.Notify.error(error.response.data.message))
                    this.formErrors = error.response.data.errors;
               })
           }catch(error){
                console.log(error)
           }
        },
        clearInputs(){
            this.menuitem.category_id = null;
            this.menuitem.food_type_id = null;
            this.menuitem.name = null;
            this.menuitem.description = null;
            this.menuitem.price = null;
            this.isCategorySelect = false;
            this.imageUrl = null;
            this.menuitem.is_active = false;
            this.post_data = new FormData();
        }
    },
    mounted(){
        this.listRestaurantFoodTypes()
        this.listRestaurantCategoryByRestaurant();
        this.overlay_category = this.$refs.overlay_category;
    },
    setup(){
        return {

        };
    }
}
</script>
<style>
.list-category-item{
    cursor: pointer;
    transition: 0.3 ease-in-out;
}
.list-category-item:hover{
    background-color: aliceblue;
}
</style>
