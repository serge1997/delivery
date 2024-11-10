<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="row">
                    <div class="col-md-6 mb-3 d-flex flex-column">
                        <label for="side_dish_name">Nom</label>
                        <InputText v-model="sideDish.name" placeholder="le nom de l'compagnement..."/>
                        <small class="text-danger" v-if="formErrors && formErrors.name" v-text="formErrors.name.toString()"></small>
                    </div>
                    <div class="col-md-6 mb-3 d-flex flex-column">
                        <label for="side_dish_price">Prix</label>
                        <InputText type="number" v-model="sideDish.price" placeholder="informez le prix..."/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3 d-flex flex-column">
                        <label for="side_dish_portion_quantity">Quantité en (g) de la portion</label>
                        <InputText v-model="sideDish.portion_quantity" placeholder="la quantité de l'acompagnement en gramme"/>
                        <small class="text-danger" v-if="formErrors && formErrors.portion_quantity" v-text="formErrors.portion_quantity.toString()"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3 d-flex flex-column">
                        <label for="side_dish_description">Descrtion</label>
                        <Textarea v-model="sideDish.description" placeholder="informez la description..."/>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="mb-3 w-25 d-flex flex-column">
                        <el-checkbox v-model="sideDish.is_active" label="Activer ?" size="large" border />
                    </div>
                </div>
                <div class="row">
                    <Button @click="handleCreateSideDish" label="Enregistrer" class="rounded-pill" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { when } from '../../core/Utilities';
import { ElMessage, ElMessageBox } from 'element-plus';

export default {
    name: 'CreateSideDishComponent',
    watch: {
        'sideDish.portion_quantity'(n, o){
            if (!Number(n)){
               this.sideDish.portion_quantity = null
            }
        },
        'sideDish.price'(n, o){
            if (!Number(n)){
               this.sideDish.price = null
            }
        }
    },
    data(){
        return {
            sideDish: {
                name: null,
                description: null,
                portion_quantity: null,
                is_active: null,
                price: null,
                restaurant_id: this.Auth.authId()
            },
            formErrors: null
        }
    },
    methods: {
        handleCreateSideDish(){
            if (this.sideDish.price == null){
                ElMessageBox.confirm(
                    "Attention !!! Vous n'avez pas renseignez le prix de l'acompagnement, ne sera donc pas faturez aux clients.",
                    'Alert',
                    {
                        confirmButtonText: 'Confirmez',
                        cancelButtonText: 'Annulez',
                        type: 'warning'
                    }
                )
                .then(() => {
                    this.createSideDish();
                })
                return;
            }
            this.createSideDish();
        },
        createSideDish(){
            this.Api.post('/v1/side-dish', this.sideDish)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.$emit('closeModal');

            })
            .catch(error => {
                when(error.response.status == 422,
                    this.formErrors = error.response.data.errors,
                    this.Notify.error(error.response.data.message)
                );
                console.log(error);
            })
        }
    },
    mounted(){
    }
}
</script>
