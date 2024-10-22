<template>
    <div>
        <div class="container mt-4">
            <div class="row p-3">
                <div class="col-md-6">
                    <UpdateImageComponent />
                </div>
                <div class="col-md-6">
                    <UpdateImageComponent />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import UpdateImageComponent from './../UpdateImageComponent.vue'
export default {
    name: 'EstablishmentImagesComponent',

    components: {
        UpdateImageComponent
    }
}
</script>
