import './bootstrap';
import { createApp } from 'vue';
import router from './router';
import VueAxios from 'vue-axios';
import App from './App.vue';
import axios from 'axios';
import PrimeVue from "primevue/config";
import 'primeicons/primeicons.css'
import "primevue/resources/themes/md-light-indigo/theme.css";
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import Menubar from 'primevue/menubar';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Sidebar from 'primevue/sidebar';
import Dialog from 'primevue/dialog';
import NavbarComponent from './components/NavbarComponent.vue';
import Textarea from 'primevue/textarea';
import Provider from './core/Provider';

const app = createApp(App);

app.component('MenuBar', Menubar);
app.component('InputText', InputText)
app.component('Button', Button)
app.component('Sidebar', Sidebar)
app.component('Dialog', Dialog)
app.component('NavbarComponent', NavbarComponent);
app.component('Textarea', Textarea)
app.use(router)
    .use(VueAxios, axios)
    .use(PrimeVue)
    .use(ElementPlus)
    .use(Provider)
    .mount('#app');
