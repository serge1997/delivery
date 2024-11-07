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
                            <span class="w-50">
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
                        <span class="btn-text-small">Actualiser la category de cet item</span>
                    </Button>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-8" v-if="menuitem.category || isCategorySelect">
                    <small class="btn-text-small">Category: </small>
                    <Tag class="rounded-3" icon="pi pi-check"
                        :severity="menuitem.category.includes('Non infor') && selectedCategoryName == null ? 'danger' : 'success'"
                        :value="selectedCategoryName ?? menuitem.category"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3 d-flex flex-column">
                    <label for="form-label">Nom</label>
                    <InputText v-model="menuitem.name" id="menuitem_name" class="p-1" placeholder="nom de la promotion" />
                    <small class="text-danger" v-if="formErrors && formErrors.name" v-text="formErrors.name.toString()"></small>
                </div>
                <div class="col-md-6 mb-3 d-flex flex-column">
                    <label for="form-label">Prix</label>
                    <InputText v-model="menuitem.price" id="menuitem_price"  class="p-1" placeholder="nom de la promotion" />
                    <small class="text-danger" v-if="formErrors && formErrors.price" v-text="formErrors.price.toString()"></small>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3 d-flex flex-column gap-2">
                    <label for="form-label">Type de plats <Tag v-if="menuitem.food_type" class="rounded-3" icon="pi pi-check" :severity="menuitem.food_type.includes('Non infor') && selected_food_type == null ? 'danger' : 'success'" :value="`${selected_food_type ? selected_food_type.name : menuitem.food_type}`"></Tag></label>
                    <Dropdown @change="onSelectFoodType" :options="foodTypes" optionLabel="name" v-model="selected_food_type" placeholder="nom de la promotion" />
                    <small class="text-danger" v-if="formErrors && formErrors.restaurant_food_type_id" v-text="formErrors.restaurant_food_type_id.toString()"></small>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3 d-flex flex-column">
                    <label for="form-label">Descrition du plat</label>
                    <Textarea v-model="menuitem.description" id="menuitem_description" class="p-1" placeholder="Descrition du plat" />
                    <small class="text-danger" v-if="formErrors && formErrors.description" v-text="formErrors.description.toString()"></small>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3 w-25 d-flex flex-column">
                        <el-checkbox v-model="menuitem.is_active" id="menuitem_is_active" label="Activer ?" size="large" border />
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="mb-3 d-flex flex-column">
                    <img v-if="!imageUrl" class="w-25 image-thumbnail rounded-circle mb-3" :src="`/images/menuitems/${menuitem.image}`" alt="menu item image">
                    <img v-else class="w-25 image-thumbnail rounded-circle mb-3" :src="imageUrl" alt="">
                    <input @change="handleImageUpload" class="d-none" type="file" id="menuitem-image-input" />
                    <Button text class="w-25 mb-1 d-flex flex-column file-upload rounded-3 d-none" @click="onOuputFileWindow">
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
                <Button @click="updateMenuitem" class="rounded-pill" label="Enregistrer" />
            </div>
        </div>
    </div>
</template>
<script>
import { ref } from 'vue';
import { isNull, when } from '../../core/Utilities';
export default {
    name: 'UpdateMenuitemComponent',
    props: {
        menuitem: Object
    },
    data(){
        return {
            formErrors: {},
            imageUrl: null,
            foodTypes: null,
            categories: null,
            isCategorySelect: false,
            overlay_category: ref(null),
            selectedCategoryName: null,
            selected_food_type: null,
            category_id: null,
            imageUrl: null,
            put_data: null
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
            this.Api.get(`/v1/restaurant-food-type/list-by-restaurant/${this.Auth.authId()}`)
            .then(async response => {
                this.foodTypes = await response.data.data;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        },
        listRestaurantCategoryByRestaurant(){
            this.Api.get(`/v1/restaurant-category/list-by-restaurant/${this.Auth.authId()}`)
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
                    self.category_id = evTarget.parentElement.getAttribute('data-id')
                },
                () => {
                    self.selectedCategoryName = evTarget.getAttribute('data-name')
                    self.menuitem.category_id = evTarget.getAttribute('data-id')
                }
            )
            this.toggleOverlayCategory(event)
        },
        clearInputs(){
        },
        onSelectFoodType(){

        },
        updateMenuitem() {
            let menuitem_price = document.getElementById('menuitem_price').value;
            let menuitem_is_active = document.getElementById('menuitem_is_active').checked ? true : false;
            this.put_data = {
                id: this.menuitem.id,
                restaurant_id: this.menuitem.restaurant_id,
                price: menuitem_price.replaceAll(/\D/g, ''),
                name: document.getElementById('menuitem_name').value,
                description: document.getElementById('menuitem_description').value,
                restaurant_food_type_id: this.selected_food_type ? this.selected_food_type.id : this.menuitem.restaurant_food_type_id,
                restaurant_category_id: this.category_id ?? this.menuitem.restaurant_category_id,
                is_active: menuitem_is_active
            }
            this.Api.put('/v1/menuitem', null, this.put_data)
            .then(async response => {
                this.Notify.success(await response.data.message)
                this.$emit('listAllMenuitem');
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
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
