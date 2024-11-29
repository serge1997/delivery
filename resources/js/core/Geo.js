export class Geo {
    constructor(){
        this.latitude = null;
        this.longitude = null;
    }
    getLatLng(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                this.latitude = position.coords.latitude;
                this.longitude = position.coords.longitude;
            });
        }
    }
    getAddress(url){
        axios.get(`${url}lat=${this.latitude}&lon=${this.longitude}`)
    }
}
