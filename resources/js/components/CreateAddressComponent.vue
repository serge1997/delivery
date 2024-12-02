<template>
    <div class="row">
        <div class="col-md-10">
            <div class="row">
                <div class="form-group col-md-4 mb-3">
                    <label for="">Rue ou reference</label>
                    <AutoComplete @complete="searchAddress" v-model="address.street_reference" />
                </div>
                <div class="form-group col-md-2 mb-3">
                    <label for="">Numero</label>
                    <InputText  class="w-100"/>
                </div>
            </div>
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
            </div>
            <div class="row mb-3">
                <div class="col-md-6 d-flex flex-column">
                    <label for="">Commune</label>
                    <Dropdown @change="getNeighborhoodByMunicipality" class="dropdown-text" id="municipality-dropdown" filter v-model="address.municipality" :options="municipalities" option-label="name">

                    </Dropdown>
                </div>
                <div class="col-md-6 d-flex flex-column">
                    <label for="">Quartier</label>
                    <Dropdown v-model="address.neighbourhood" :options="neighbourhoods" option-label="name">

                    </Dropdown>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 d-flex flex-column">
                    <label for="">Complement</label>
                    <InputText />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ElMessage } from 'element-plus';

export default {
    name: 'CreateAddressComponent',

    data(){
        return {
            address: {
                city: null,
                municipality: null,
                neighbourhood: null,
                complement: null,
                number: null,
                street_reference: null
            },
            cities: null,
            municipalities: null,
            neighbourhoods: null
        }
    },
    methods: {
        searchAddress(){
            axios.get(`${this.Adress_ApiUrl}${this.address.city.name}+${this.address.municipality.name}+${this.address.street_reference}&format=json`)
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
