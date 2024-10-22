<template>
    <div class="container-fluid">
        <div class="row d-flex justify-content-end p-0 min-vh-100">
        </div>
        <div class="row d-flex justify-content-end">
            <div class="col-sm-4 bg-white mt-3 rounded-3 p-3 form-col">
                <div class="card w-100 border-0">
                    <div class="card-header bg-transparent">
                        <h5 class="fw-bold">Welcome Portal Partner!</h5>
                        <h6>Sign-up Portal</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 d-flex flex-column">
                            <small class="text-danger" v-text="errorMessage"></small>
                        </div>
                        <div class="mb-3 d-flex flex-column">
                            <label for="regist-number" class="form-label">Numero de telephone</label>
                            <InputText v-model="auth.phone" @input="validateInputs" style="border: 1px solid #e5e7eb" class="p-2 required" placeholder="numero telephone" />
                        </div>
                        <div class="mb-4 d-flex flex-column">
                            <label for="regist-number" class="form-label">Mot de passe</label>
                            <InputText v-model="auth.password" @input="validateInputs" style="border: 1px solid #e5e7eb" type="password" class="p-2 required" placeholder="mot de passe" />
                        </div>
                        <div class="mb-3d-flex flex-column">
                            <Button @click="login" class="w-100 rounded-3 p-disabled" id="submitDataBtn" label="Sign-up" />
                            <Button class="w-100 border-0" text>
                                <router-link class="text-center text-dark w-100" :to="{name: 'Register.Restaurant'}">Créer un compte</router-link>
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'RestaurantLogin',
    components:{

    },
    data(){
        return{
            auth:{
                phone: null,
                password: null
            },
            errorMessage: null
        }
    },
    methods: {
        validateInputs(e){
            let submitBtn = document.querySelector('#submitDataBtn')
            let requiredInputs = document.querySelectorAll('.required');
            let input = e.target;
            let parent = input.parentElement;
            requiredInputs.forEach(el => {
                if (!el.value){
                    submitBtn.classList.add('p-disabled')
                }else{
                    submitBtn.classList.remove('p-disabled')
                }
            })
        },
        login(){
            this.Api.post('/v1/auth-restaurant/auth', this.auth)
            .then(async response => {
                try{
                    const result = await response.data.data;
                    this.Auth.attempt(result.token, result.name, result.role);
                    location.assign('/administration/configuration/establishment')
                }catch(error) {
                    this.Notify.error(error.message)
                }
            })
            .catch(error => {
                console.log(error)
                this.errorMessage = error.response.data.message
            })
        }
    },
    mounted(){
    }
}
</script>
<style scoped>
*{
    box-sizing: border-box;
}
.min-vh-100{
    background-image: url('/images/rest-login-bg.jpg');
    background-repeat:no-repeat;
    background-position:center;
    background-size: cover;
    filter:blur(3px)
}
.form-col{
    position: absolute;
    z-index: 1000;
    top: 8%;
    right: 2%;
    z-index: 2;
}

</style>
