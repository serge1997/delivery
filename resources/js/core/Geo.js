export class Geo {
    constructor(){
        this.latitude = null;
        this.longitude = null;
    }
    async getLatLng(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                this.latitude = position.coords.latitude;
                this.longitude = position.coords.longitude;
            });
        }
    }
    getGeoAddress(url){
        return axios.get(`${url}lat=5.295636&lon=-3.988541&format=json`)
    }
}
