<template>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 p-0">
                    <router-link class="p-0" :to="{name: 'Home'}">Logo</router-link>
                </div>
                <div class="col-md-8 m-auto d-flex align-items-center vh-100">
                    <div class="card m-auto border shadow-sm p-3">
                        <div class="card-header bg-transparent border-0 p-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <img class="w-75 delivey_boy_image m-auto" src="/images/delivery-boy-moto.png" />
                                </div>
                                <div class="col-md-6 p-3 d-flex flex-column justify-content-center align-items-center">
                                    <h4 class="fw-bold img-3d-box-text-content">Creez votre compte et profitez des restaurants de la place !</h4>
                                    <small class="img-3d-box-text-content">Restaurants ordinaires, de luxe, garba, allocodrome, boulangerie</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3 d-flex flex-column">
                                    <label class="form-label" for="">Nom complet</label>
                                    <InputText v-model="customer.name" placeholder="votre nom complet" />
                                </div>
                                <div class="col-md-6 mb-3 d-flex flex-column">
                                    <label class="form-label" for="">Numero de telephone</label>
                                    <InputMask v-model="customer.phone" mask="99-99-99-99-99" placeholder="99-99-99-99-99" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3 d-flex flex-column">
                                    <label class="form-label" for="">E-mail</label>
                                    <InputText v-model="customer.email" placeholder="votre e-mail" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 mb-3 d-flex flex-column">
                                    <label class="form-label" for="">Password</label>
                                    <InputText v-model="customer.password" type="password" placeholder="mot de passe" />
                                </div>
                            </div>
                            <div class="row p-2 mb-3">
                                <Button class="rounded-pill" label="Creez votre compte" />
                            </div>
                            <div class="row">
                                <p class="mb-0">Vous avez déja un compte?
                                    <router-link :to="{name: 'CustomerRegister'}" class="fw-bold">Connectez vous!</router-link>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {

    data(){
        return{
            customer: {
                name: null,
                phone: null,
                email: null,
                password: null
            }
        }
    },
    methods: {

    }
}
</script>
