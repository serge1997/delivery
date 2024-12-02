import { Container } from "./Container.mjs";

export default {
    install(app) {
        const container = new Container();

        app.config.globalProperties.App = container;
        app.config.globalProperties.Api = container.get('Api');
        app.config.globalProperties.Notify = container.get('Notify');
        app.config.globalProperties.Auth = container.get('AuthService');
        app.config.globalProperties.Cart = container.get('Cart');
        app.config.globalProperties.Geo = container.get('Geo');
        app.config.globalProperties.latLng_url = "https://nominatim.openstreetmap.org/reverse?";
        app.config.globalProperties.Adress_ApiUrl = "https://nominatim.openstreetmap.org/search?q=";
    }
}
