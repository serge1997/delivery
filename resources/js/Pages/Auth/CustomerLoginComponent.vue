<template>
    <div class="row">
        <div v-if="registerSuccessMessage" class="row">
            <div class="card p-0 border-0">
                <div class="card-body">
                    <Tag class="p-2" icon="pi pi-check-circle" :value="registerSuccessMessage" severity="success"/>
                </div>
            </div>
        </div>
        <div v-if="mustBeConnected" class="row">
            <div class="card p-0 border-0">
                <div class="card-body d-flex justify-content-center">
                    <Tag class="p-2" icon="pi pi-exclamation-triangle" value="Connectez vous pour continuer..." severity="warning"/>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card border-0 text-dark mt-3">
                <div class="card-header bg-transparent border-0 d-flex flex-wrap flex-column justify-content-center p-0">
                    <div class="login_card_header_image_box">
                        <img class="delivey_boy_image" src="/images/delivery-boy-moto.png" />
                    </div>
                    <div class="login_card_header_text_box w-100 text-center">
                        <small class="fw-light">restez connectez et profitez des promotions!</small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column gap-1 mb-4">
                        <small class="text-danger" v-if="typeof formErrors == 'string'">{{ formErrors }}</small>
                        <small v-if="formErrors && formErrors.phone" class="text-danger" v-text="formErrors.phone.toString()"></small>
                        <InputText v-model="login.phone" class="w-100" />
                        <label class="form-label" for="typeEmailX">Telephone</label>
                    </div>
                    <div class="form-outline">
                        <small v-if="formErrors && formErrors.password" class="text-danger" v-text="formErrors.password.toString()"></small>
                        <InputText type="password" v-model="login.password" class="w-100" />
                        <label class="form-label" for="typeEmailX">Mot de passe</label>
                    </div>
                    <div class="row p-2 mb-4">
                        <Button @click="customerAuth" class="rounded-pill" label="se connecter"/>
                    </div>
                    <div v-if="!registerSuccessMessage">
                        <p class="mb-0">Vous n'avez pas de compte?
                            <router-link :to="{name: 'CustomerRegister'}" class="fw-bold">Creez-en !</router-link>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {

    components: {

    },
    props: {
        registerSuccessMessage: String,
        mustBeConnected: Boolean
    },
    data(){
        return {
            login: {
                phone: null,
                password: null
            },
            formErrors: null
        }
    },
    methods: {
        customerAuth(){
            this.Api.post('/v1/auth-customer/auth-login', this.login)
            .then(async response => {
               try{
                    const result = await response.data.data;
                    this.Auth.attempt(
                       result.token,
                       result.id,
                       result.name,
                       result.role
                    );
                    this.formErrors = null;
                    location.assign('/');
               }catch(error){
                    this.Notify.error(error)
               }
            })
            .catch(error => {
                if(error.response.status == 422){
                    return this.formErrors = error.response.data.errors
                }
                this.formErrors = error.response.data.message
            })
        }
    },
    mounted(){
    }
}
</script>
<style scoped>
.login_card_header_image_box{
    width: 60%;
}
.delivey_boy_image{
    width: 100%;
}
</style>
