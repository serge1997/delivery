<template>
    <div class="container h-50">
        <div class="row mb-3">
            <div @click="triggerClickInputFile" style="height: 300px; cursor: pointer;" class="col-sm-6 p-3 border d-flex align-items-center justify-content-center alert-secondary">
                <input @change="handleImageUpload" type="file" class="d-none" id="upload_file" />
                <img v-if="imageUrl" class="img-thumbnail w-100" :src="imageUrl" alt="">
                <Button v-if="!imageUrl" icon="pi pi-image" text />
            </div>
            <div style="height: 300px; cursor: pointer;" class="col-sm-6 p-3 d-flex align-items-center justify-content-center">
                <img v-if="oldUrl" class="img-thumbnail w-100" :src="oldUrl" alt="">
                <Button v-if="!oldUrl" icon="pi pi-image" text />
            </div>
        </div>
        <div class="row">
            <Button @click="uploadImage" class="border" label="Enregistrer" />
        </div>
    </div>
</template>
<script>
import { isNullOrWhiteSpace } from '../core/Utilities';
export default{
    name: 'UpdateImageComponent',
    props: {
        oldUrl: String,
        newUrl: String,
        baseUrl: String,
        apiUrl: String,
        entityId: Number
    },

    data(){
        return {
            imageUrl: null,
            file: null
        }
    },
    methods:{
        triggerClickInputFile(){
            document.getElementById('upload_file').click()
        },
        handleImageUpload(e){
            const fil = e.target.files[0]
            const reader = new FileReader();
            this.file = fil;
            reader.onload = () => {
                this.imageUrl = reader.result;
            }
            reader.readAsDataURL(fil);
        },
        uploadImage(){
            const data = new FormData();
            console.log(data)
            data.append('image', isNullOrWhiteSpace(this.file) ? "" : this.file);
            data.append('id', this.entityId);
            this.Api.post(this.apiUrl,data)
            .then(async response => {
                this.Notify.success(await response.data.message)
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        }

    }
}
</script>
