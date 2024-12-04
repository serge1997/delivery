<template>
     <div class="row">
        <div class="form-group d-flex flex-column col-md-11 mb-3">
            <label for="">informez une rue ou une reference</label>
            <AutoComplete :loading="false" class="row p-2" @complete="searchAddress" optionLabel="street_reference" v-model="street_reference" :suggestions="addresses">
                <template #value="slotProps">
                    <div v-if="slotProps.value" class="d-flex gap-2">
                        <span class="fw-bold d-flex gap-2">
                            <Tag icon="pi pi-arrow-right" severity="secondary" />
                            <span>{{ slotProps.value.street_reference }}</span>
                        </span>
                    </div>
                    <div v-else class="d-flex gap-2">
                        <span class="fw-bold d-flex gap-2">
                            <Tag icon="pi pi-minus" severity="warning" />
                            <span>{{ slotProps.placeholder}}</span>
                        </span>
                    </div>
                </template>
                <template #option="slotProps">
                    <div class="d-flex gap-2">
                        <Tag icon="pi pi-map-marker" severity="secondary" />
                        <span class="dropdown-text">{{ slotProps.option.street_reference }}</span>
                    </div>
                </template>
            </AutoComplete>
        </div>
        <div v-if="typeof street_reference == 'object' && street_reference != null" class="form-group d-flex w-75 gap-2 mb-3 align-items-center justify-content-between">
            <label for="">Numero</label>
            <InputText v-model="address.numero" />
        </div>
        <div v-if="typeof street_reference == 'object' && street_reference != null" class="form-group w-75 d-flex gap-2 align-items-center justify-content-between">
            <label for="">Complement</label>
            <InputText v-model="address.complement" />
        </div>
        <div class="w-100 d-flex">
            <div class="col-md-8 mt-3">
                <Button @click="getCurrentLocation" icon="pi pi-map-marker" class="small-text p-0" label="Voir votre localization actuelle ?" text/>
            </div>
            <div class="col-md-4 mt-3">
                <Button icon="pi pi-map-marker" class="small-text p-0" label="Carte" text/>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'CustomerAddressSearchComponent',

    data(){
        return {
            addresses: [],
            street_reference: null,
            address: {
                street_reference: null,
                complement: null,
                numero: null
            }
        }
    },

    methods: {
        searchAddress(){
            this.Api.get(`/v1/address/search?street_reference=${this.street_reference}`)
            .then(async response => {
                this.addresses = await response.data.data;
            })
        },
        async getCurrentLocation(){
            await this.Geo.getLatLng();
            setTimeout(() => {
                this.Geo.getGeoAddress('https://nominatim.openstreetmap.org/reverse?')
                .then(async response => {
                    this.street_reference = await response.data.address;
                    this.street_reference.street_reference =   `${this.street_reference.road} - ${this.street_reference.city} - ${this.street_reference.neighbourhood}`;
                    console.log(response);
                })
            }, 100)
            
        }
    },
    mounted(){
      
    }
}

</script>