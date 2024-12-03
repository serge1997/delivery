<template>
    <div class="row">
        <div class="col-md-10">
            <div class="form-group col-md-4 mb-3">
                <label for="">Ville</label>
                <Dropdown v-model="address.city" @change="getMunicipalityByCity" filter :options="cities" placeholder="selectionnez une ville" option-label="name" class="w-100 p-2">
                    <template #value="slotProps">
                        <div v-if="slotProps.value" class="d-flex gap-2">
                            <span class="fw-bold d-flex gap-2">
                                <Tag icon="pi pi-check-circle" severity="success" />
                                <span>{{ slotProps.value.name }}</span>
                            </span>
                        </div>
                        <div v-else class="d-flex gap-2">
                            <span class="fw-bold d-flex gap-2">
                                <Tag icon="pi pi-minus" severity="danger" />
                                <span>{{ slotProps.placeholder}}</span>
                            </span>
                        </div>
                    </template>
                    <template #option="slotProps">
                        <div class="d-flex gap-2">
                            <span class="dropdown-text">{{ slotProps.option.name }}</span>
                        </div>
                    </template>
                </Dropdown>
                <small v-if="formErrors && formErrors.city_id" class="text-danger" v-text="formErrors.city_id.toString()"></small>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 d-flex flex-column">
                    <label for="">Commune</label>
                    <Dropdown @change="getNeighborhoodByMunicipality" class="dropdown-text" id="municipality-dropdown" filter v-model="address.municipality" :options="municipalities" option-label="name">
                        <template #value="slotProps">
                            <div v-if="slotProps.value" class="d-flex gap-2">
                                <span class="fw-bold d-flex gap-2">
                                    <Tag icon="pi pi-arrow-right" severity="secondary" />
                                    <span>{{ slotProps.value.name }}</span>
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
                                <span class="dropdown-text">{{ slotProps.option.name }}</span>
                            </div>
                        </template>
                    </Dropdown>
                    <small v-if="formErrors && formErrors.municipality_id" class="text-danger" v-text="formErrors.municipality_id.toString()"></small>
                </div>
                <div class="col-md-6 d-flex flex-column">
                    <label for="">Quartier</label>
                    <Dropdown v-model="address.neighbourhood" :options="neighbourhoods" option-label="name">
                        <template #value="slotProps">
                            <div v-if="slotProps.value" class="d-flex gap-2">
                                <span class="fw-bold d-flex gap-2">
                                    <Tag icon="pi pi-arrow-right" severity="secondary" />
                                    <span>{{ slotProps.value.name }}</span>
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
                                <span class="dropdown-text">{{ slotProps.option.name }}</span>
                            </div>
                        </template>
                    </Dropdown>
                    <small v-if="formErrors && formErrors.neighbourhood_id" class="text-danger" v-text="formErrors.neighbourhood_id.toString()"></small>
                </div>
            </div>
            <div class="row">
                <div class="form-group d-flex flex-column col-md-8 mb-3">
                    <label for="">Rue ou reference</label>
                    <AutoComplete :loading="false" class="row p-2" @complete="searchAddress" @change="populateAddressData" optionLabel="street_reference" v-model="address.street_reference" :suggestions="addresses">
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
                    <small v-if="formErrors && formErrors.street_reference" class="text-danger" v-text="formErrors.street_reference.toString()"></small>
                </div>
                <div class="form-group col-md-2 p-2 mb-3">
                    <label for="">zip code</label>
                    <InputText  class="w-100"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-5 d-flex flex-column">
                    <label for="">latitude</label>
                    <InputText v-model="address.latitude" />
                    <small v-if="formErrors && formErrors.latitude" class="text-danger" v-text="formErrors.latitude.toString()"></small>
                </div>
                <div class="col-md-5 d-flex flex-column">
                    <label for="">Longitude</label>
                    <InputText v-model="address.longitude" />
                    <small v-if="formErrors && formErrors.longitude" class="text-danger" v-text="formErrors.longitude.toString()"></small>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 w-auto d-flex flex-column">
                    <el-checkbox v-model="address.is_street" label="est-ce une rue ?" size="large" border />
                </div>
            </div>
            <div class="row mb-3 p-3 mt-3">
                <Button @click="store" label="Enregistrer" class="rounded-pill" />
            </div>
        </div>
    </div>
</template>
<script>
import { ElMessage } from 'element-plus';

export default {
    name: 'CreateAddressAdmComponent',

    data(){
        return {
            address: {
                city: null,
                municipality: null,
                neighbourhood: null,
                complement: null,
                number: null,
                street_reference: null,
                latitude: null,
                longitude: null,
                zip_code: null,
                is_street: null
            },
            cities: null,
            municipalities: null,
            neighbourhoods: null,
            addresses: [],
            formErrors: null
        }
    },
    methods: {
        populateAddressData(){
            if (typeof this.address.street_reference == 'object'){
                this.address.city = this.address.street_reference.city;
                this.address.municipality = this.address.street_reference.municipality;
                this.address.neighbourhood = this.address.street_reference.neighbourhood;
                this.address.longitude = this.address.street_reference.longitude;
                this.address.latitude = this.address.street_reference.latitude;

            }
        },
        store(){
            const data = {
                city_id: this.address.city?.id,
                municipality_id: this.address.municipality?.id,
                neighbourhood_id: this.address.neighbourhood?.id,
                street_reference: this.address.street_reference == 'object' ? this.address.street_reference?.street_reference : this.address.street_reference,
                latitude: this.address.latitude,
                longitude: this.address.longitude,
                zip_code: this.address.zip_code,
                has_municipality: this.address.street_reference?.city?.has_municipality,
                is_street: this.address.is_street ? true : false
            }
            this.Api.post('/v1/address', data)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.$emit('updateUi');
            })
            .catch(error => {
                if (error.response.status == 422){
                    return this.formErrors = error.response.data.errors;
                }
                this.Notify.error(error.response.data.message)
            })
        },
        searchAddress(){
            this.Api.get(`/v1/address/search?street_reference=${this.address.street_reference}`)
            .then(async response => {
                this.addresses = await response.data.data;
            })
        },
        getAllCities(){
            this.Api.get('/v1/city')
            .then(async response => {
                this.cities = await response.data.data;
            })
        },
        getMunicipalityByCity(){
            if (this.address.city){
                this.getNeighborhoodByCity();
                if (!this.address.city.has_municipality) return;
            }
            this.Api.get(`/v1/municipality/list-by-city/${this.address.city.id}`)
            .then(async response => {
                this.municipalities = await response.data.data;
                this.neighbourhoods = [];
            })
        },
        getNeighborhoodByCity(){
            const municipality_dropdown =  document.getElementById('municipality-dropdown');
            if (this.address.city && !this.address.city.has_municipality){
                this.municipalities = [];
                this.Api.get('/v1/neighbourhood/list-by-city/'+this.address.city.id)
                .then(async response => {
                    this.neighbourhoods = await response.data.data;
                    ElMessage({
                        message: "Selectionnez un quartier",
                        type: 'info'
                    })
                })
                if(!municipality_dropdown.classList.contains('p-disabled')){
                    municipality_dropdown.classList.add('p-disabled');
                }
            }else{
                if(municipality_dropdown.classList.contains('p-disabled')){
                    municipality_dropdown.classList.remove('p-disabled');
                }
            }
        },
        getNeighborhoodByMunicipality(){
            this.Api.get(`/v1/neighbourhood/list-by-municipality/${this.address.municipality.id}`)
            .then(async response => {
                this.neighbourhoods = await response.data.data;
            })
        }
    },
    mounted(){
        this.getAllCities();
    }
}
</script>
