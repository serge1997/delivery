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
.file-upload{
    background-color:#e4e4e7;
    color: #4b5563;
}
.gold-btn-icon{
    color: #fbbf24;
    font-size: 0.9em;
}
.border-red-btn-white{
    border: 1px solid #a1a1aa;
}
.btn-text-small{
    color: #4b5563;
    font-size: 0.9em;
}
.btn-text-small-danger{
    font-size: 0.9em;
}
.cursor-p{
    cursor: pointer;
}
.toolbar-btn{
    background-color: #e5e7eb;
    color: #374151;
    font-size: 0.8em;
}
.simple-small-btn{
    color: #6b7280;
    font-size: 0.9em;
}
.small-btn-icon{
    font-size: 0.8em;
}
.small-text {
    color: #6b7280;
    font-size: 0.9em;
}
.img-3d-box-text-content, .form-label{
    color: #4b5563;
}
.dropdown-text {
    color: #475569;
    font-weight: 600;
}
</style>
