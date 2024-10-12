<template>
    <div class="container-fluid">
        <div class="row header">
            <h2>Save your restaurant</h2>
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
                            <label for="exampleFormControlInput1" class="form-label">Votre Nom</label>
                            <InputText @blur="onBlurInputValidation" :class="inputInvalid" class="p-1 required" placeholder="Informez votre nom" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 d-flex flex-column">
                            <label for="exampleFormControlInput1" class="form-label">Votre Telephone</label>
                            <InputText @blur="onBlurInputValidation" class="p-1 required" placeholder="Informez votre e-mail" />
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="mb-3 d-flex flex-column">
                            <label for="exampleFormControlInput1" class="form-label">Votre E-mail</label>
                            <InputText class="p-1" placeholder="Informez votre e-mail" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 d-flex flex-column">
                            <label for="exampleFormControlInput1" class="form-label">Nom du restaurant</label>
                            <InputText @blur="onBlurInputValidation" class="p-1 required" placeholder="Informez le nom du restaurant" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 d-flex flex-column">
                            <label for="exampleFormControlInput1" class="form-label">Whatsapp du restaurant</label>
                            <InputText @blur="onBlurInputValidation" class="p-1 required" placeholder="Informez le whatsapp du restaurant" />
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="mb-3 d-flex flex-column">
                            <label for="exampleFormControlInput1" class="form-label">E-mail du restaurant</label>
                            <InputText class="p-1" placeholder="Informez l'e-mail du restaurant" />
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="mb-3 d-flex flex-column">
                            <label for="exampleFormControlInput1" class="form-label">Numero de régistre</label>
                            <InputText class="p-1" placeholder="Informez le numero de registre du restaurant" />
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="mb-3 d-flex flex-column w-100">
                             <input class="d-none" type="file" id="restaurant-category-file" />
                             <Button class="w-100 rounded-3 btn-file-upload" label="Logo" icon="pi pi-image" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 d-flex flex-column">
                             <input class="d-none" type="file" id="restaurant-category-file" />
                             <Button class="w-100 btn-file-upload rounded-3" label="Image de couverture" icon="pi pi-image" />
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Register.Restaurant',

    data(){
        return {
            restaurant: {
                creator_name: null,
                creator_phone: null,
                name: null,
                phone: null,
                inputInvalid: null
            }
        }
    },
    methods: {
        onBlurInputValidation(e) {
            let input = e.target;
            if (input.classList.contains('required') && !input.value){
                input.classList.add('border-danger')
                input.classList.add('required-input')
            }else{
                input.classList.remove('border-danger');
                input.classList.remove('required-input')
            }
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
