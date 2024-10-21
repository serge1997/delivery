<template>
    <div class="container-fluid">
        <div class="row header">
            <h2>LOGO</h2>
        </div>
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-8 m-auto img-3d-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <img class="mw-100" src="/images/delivery-3d.png" alt="">
                        </div>
                        <div class="col-sm-9 d-flex align-items-center flex-column justify-content-center">
                            <div class="d-flex align-items-center flex-column justify-content-center">
                                <h4 class="fw-bold img-3d-box-text-content">Enregistrer votre restaurant et commencer a livrer.</h4>
                                <p>Nous offrons la meilleure <span class="fw-bold img-3d-box-text-content">experiance d'utilisateur</span> !!!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
           <div class="col-md-10 m-auto">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="mb-3 d-flex flex-column">
                            <label for="exampleFormControlInput1" class="form-label">Nom complet du responsable</label>
                            <InputText @input="onInputValidation" @blur="onBlurInputValidation" v-model="restaurant.created_by_name" class="p-1 required" placeholder="Informez votre nom" />
                            <small class="text-danger d-none">votre nom est obligatoire</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 d-flex flex-column">
                            <label for="exampleFormControlInput1" class="form-label">Telephone du responsable</label>
                            <InputText @input="onInputValidation" v-model="restaurant.created_by_phone" @blur="onBlurInputValidation" class="p-1 required" placeholder="Informez votre e-mail" />
                            <small class="text-danger d-none">votre telephone est obligatoire</small>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="mb-3 d-flex flex-column">
                            <label for="created_by_email" class="form-label">E-mail du responsable</label>
                            <InputText v-model="restaurant.created_by_email" class="p-1" placeholder="Informez votre e-mail" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 d-flex flex-column">
                            <label for="exampleFormControlInput1" class="form-label">Nom du restaurant</label>
                            <InputText @input="onInputValidation" @blur="onBlurInputValidation" v-model="restaurant.name" class="p-1 required" placeholder="Informez le nom du restaurant" />
                            <small class="text-danger d-none">nom du restaurant est obligatoire</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 d-flex flex-column">
                            <label for="phone" class="form-label">Telephone du restaurant</label>
                            <InputText @input="onInputValidation" v-model="restaurant.phone" @blur="onBlurInputValidation" class="p-1 required" placeholder="Informez le telephone du restaurant" />
                            <small class="text-danger d-none">telephone du restaurant est obligatoire</small>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="mb-3 d-flex flex-column">
                            <label for="exampleFormControlInput1" class="form-label">E-mail du restaurant</label>
                            <InputText v-model="restaurant.email" class="p-1" placeholder="Informez l'e-mail du restaurant" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3 d-flex flex-column">
                            <label for="password" class="form-label">Mot de passe</label>
                            <InputText type="password" @input="onInputValidation" v-model="restaurant.password" @blur="onBlurInputValidation" class="p-1 required" placeholder="Informez le mot de passe" />
                            <small class="text-danger d-none">mot de passe est obligatoire</small>
                        </div>
                    </div>
                </div>
                <div class="row mb-2 d-none">
                    <div class="col-md-12">
                        <div class="mb-3 d-flex flex-column">
                            <label for="regist-number" class="form-label">Numero de régistre</label>
                            <InputText v-model="restaurant.enterprise_register_number" class="p-1" placeholder="Informez le numero de registre du restaurant" />
                        </div>
                    </div>
                </div>
                <div class="row p-0 mb-3">
                    <div class="col-md-4 px-4">
                        <img style="max-width: 12rem;" class="img-thumbnail" :src="imageb64.logo" alt="">
                    </div>
                    <div class="col-md-4 px-4">
                        <img style="max-width: 12rem;" class="img-thumbnail" :src="imageb64.cover" alt="">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="mb-3 d-flex flex-column w-100">
                            <input @change="handleImageUpload" class="d-none" type="file" id="restaurant-logo-image" />
                            <Button @click="openFileWindow" class="w-100 rounded-3 btn-file-upload" label="Logo" icon="pi pi-image" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 d-flex flex-column">
                            <input @change="handleImageUpload" class="d-none" type="file" id="restaurant-cover-image" />
                            <Button @click="openFileWindow" class="w-100 btn-file-upload rounded-3" label="Image de couverture" icon="pi pi-image" />
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="mb-3 d-flex flex-column">
                            <Button @click="postRestaurant" class="w-100 rounded-3 p-disabled" id="submitDataBtn" label="Enregistrer" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 d-flex flex-column">
                            <Button class="w-100 border" text>
                                <router-link class="text-center text-dark w-100" :to="{name: 'RestaurantLogin'}">Sign-up</router-link>
                            </Button>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</template>
<script>
import { ElMessage } from 'element-plus';
import { ElNotification } from 'element-plus';
export default {
    name: 'Register.Restaurant',

    data(){
        return {
            restaurant: {
                created_by_name: null,
                created_by_phone: null,
                created_by_email: null,
                enterprise_register_number: null,
                is_active: null,
                name: null,
                email: null,
                password: null,
                phone: null,
                cover_image: null,
                logo: null,
                is_active: false
            },
            formErrosBeug: [
                {creator_name: "Votre nom est obligatoire"}
            ],
            imageb64:{
                logo: null,
                cover: null,
                accept: ['jpg', 'jpeg', 'png']
            }
        }
    },
    methods: {
        onBlurInputValidation(e) {
            let input = e.target;
            let parent = input.parentElement;
            if (input.classList.contains('required') && !input.value){
                input.classList.add('border-danger')
                input.classList.add('required-input')
                parent.querySelector('small').classList.remove('d-none')
            }else{
                input.classList.remove('border-danger');
                input.classList.remove('required-input')
                parent.querySelector('small').classList.add('d-none')
            }
        },
        onInputValidation(){
            let submitBtn = document.querySelector('#submitDataBtn')
            let requiredInputs = document.querySelectorAll('.required');
            requiredInputs.forEach(el => {
                if (!el.value){
                    submitBtn.classList.add('p-disabled')
                }else{
                    submitBtn.classList.remove('p-disabled')
                }
            })
        },
        openFileWindow(e){
            let parent = e.target.parentElement;
            let div = parent.parentElement;
            div.querySelector('input[type=file]').click()
        },
        handleImageUpload(e){
            let file = e.target.files[0];
            let extension = file.type.split('/').pop();
            if (!this.imageb64.accept.includes(extension)){
                return ElNotification({
                    title: "Erreur",
                    message: "Type de fichier non autorisé",
                    type: "error"
                })
            }
            let targetId = e.target.getAttribute('id');
            const reader = new FileReader();
            reader.onload = () => {
                if (targetId.includes("logo")){
                    ElMessage({
                        message: "Logo telechargé avec succés",
                        type: "success"
                    })
                    this.restaurant.logo = file;
                    return this.imageb64.logo = reader.result
                }
                ElMessage({
                    message: "Couverture telechargée avec succés",
                    type: "success"
                })
                this.restaurant.cover = file;
                this.imageb64.cover = reader.result

            }
            reader.onerror = () => {
                ElMessage({
                    message: "Une erreure survenue en telechargeant l'image",
                    type: "error"
                })
            }
            reader.readAsDataURL(file)
        },
        postRestaurant(){
            this.Api.post('/v1/restaurant', this.restaurant)
            .then(async response => {
                this.Notify.success(await response.data.message)
                this.$router.push('/login/@auth-restaurant')
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
}
</script>
<style>
.img-3d-box{
    background-color: #eff6ff;
}
.img-3d-box-text-content, .form-label{
    color: #4b5563;
}
.required-input{
    animation: shakeInput .3s .9s;
}
@keyframes shakeInput{
    0% { transform: translate(1px, 1px) rotate(0deg); }
    10% { transform: translate(-1px, -2px) rotate(-2deg); }
    20% { transform: translate(-6px, 10px) rotate(1deg); }
    30% { transform: translate(3px, 2px) rotate(0deg); }
    40% { transform: translate(1px, -1px) rotate(-2deg); }
}
</style>
