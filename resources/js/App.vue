<template>
    <div>
        <router-view></router-view>
    </div>
</template>
<script>
import { popUpConfirmMessage } from './core/Utilities';

export default{

    data(){
        return {
        }
    },
    provide(){
        return {
            isAuthenticated: this.Auth.isAuthenticated(),
            popUpMessage: popUpConfirmMessage
        }
    }
}
</script>
<style>
.general-btn{
    border-radius: 0.8rem;
}

.btn-file-upload{
    background-color: #e5e7eb;
    color: #4b5563;
    transition: ease-in .3s;
}
.btn-file-upload:hover{
    transform: scale(1.03);
    background-color: #cbd5e1;
}
</style>
