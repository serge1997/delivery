<template>
    <div class="row">
        <div class="col-md-10 m-auto">
            <div class="row">
                <div class="col-md-6 mb-3 d-flex flex-column">
                    <label for="form-label">Nom</label>
                    <InputText v-model="menuitem.name" class="p-1" placeholder="nom de la promotion" />
                </div>
                <div class="col-md-6 mb-3 d-flex flex-column">
                    <label for="form-label">Prix</label>
                    <InputText v-model="menuitem.price"  class="p-1" placeholder="nom de la promotion" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3 d-flex flex-column">
                    <label for="form-label">Type de plats</label>
                    <Dropdown :options="foodTypes" optionLabel="name" v-model="menuitem.food_type_id" placeholder="nom de la promotion" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3 d-flex flex-column">
                    <label for="form-label">Descrition du plat</label>
                    <Textarea v-model="menuitem.description" class="p-1" placeholder="Descrition du plat" />
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
                <Button label="Enregistrer" />
            </div>
        </div>
    </div>
</template>
<script>
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
                restaurant_id: this.Auth.authId()
            },
            formErrors: null,
            imageUrl: null,
            foodTypes: null
        }
    },
    methods: {
        handleImageUpload(e){
            let file = e.target.files[0];

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
        }
    },
    mounted(){
        this.listRestaurantFoodTypes()
    }
}
</script>
