<template>
    <div class="row">
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
                        <InputText class="w-100" />
                        <label class="form-label" for="typeEmailX">Telephone</label>
                    </div>
                    <div class="form-outline">
                        <InputText class="w-100" />
                        <label class="form-label" for="typeEmailX">Mot de passe</label>
                    </div>
                    <div class="row p-2 mb-4">
                        <Button class="rounded-pill" label="se connecter"/>
                    </div>
                    <div>
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
    data(){
        return {

        }
    },
    methods: {

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