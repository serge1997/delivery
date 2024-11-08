<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="row">
                    <div class="col-md-6 mb-3 d-flex flex-column">
                        <label for="side_dish_name">Nom</label>
                        <InputText placeholder=""/>
                    </div>
                    <div class="col-md-6 mb-3 d-flex flex-column">
                        <label for="side_dish_price">Prix</label>
                        <InputText placeholder="informez le prix..."/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3 d-flex flex-column">
                        <label for="side_dish_description">Descrtion</label>
                        <Textarea placeholder="informez la description..."/>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 w-25 d-flex flex-column">
                        <el-checkbox label="Activer ?" size="large" border />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'CreateSideDishComponent',

    data(){
        return {

        }
    }
}
</script>
