import { Container } from "./Container.mjs";

export default {
    install(app) {
        const container = new Container();

        app.config.globalProperties.App = container;
        app.config.globalProperties.Api = container.get('Api');
    }
}
