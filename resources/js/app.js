import './bootstrap';
import { createApp, defineAsyncComponent } from 'vue';
import router from './router';
import VueAxios from 'vue-axios';
import App from './App.vue';
import axios from 'axios';
import PrimeVue from "primevue/config";
import 'primeicons/primeicons.css'
import "primevue/resources/themes/aura-light-blue/theme.css";
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import Menubar from 'primevue/menubar';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Sidebar from 'primevue/sidebar';
import Dialog from 'primevue/dialog';
import Textarea from 'primevue/textarea';
import Provider from './core/Provider';
import MultiSelect from 'primevue/multiselect';
import Dropdown from 'primevue/dropdown';
import OverlayPanel from 'primevue/overlaypanel';
import Tag from 'primevue/tag';
import Chip from 'primevue/chip';
import Toolbar from 'primevue/toolbar';
import InputMask from 'primevue/inputmask';

const app = createApp(App);

function token() {
    return JSON.parse(localStorage.getItem('auth'));
}
router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)){
        if (!token()) {
            next({
                path:'/',
                query: {redirect: to.fullPath}
            })
        }else{
            next();
        }
    }else{
        next();
    }
})

app.component('MenuBar', Menubar);
app.component('InputText', InputText);
app.component('Button', Button);
app.component('Sidebar', Sidebar);
app.component('Dialog', Dialog);
app.component('NavbarComponent', defineAsyncComponent(() => import('./components/NavbarComponent.vue')));
app.component('Textarea', Textarea)
app.component('UpdateImageComponent', defineAsyncComponent(() => import('./components/UpdateImageComponent.vue')));
app.component('MultiSelect', MultiSelect);
app.component('Dropdown', Dropdown);
app.component('OverlayPanel', OverlayPanel);
app.component('Tag', Tag);
app.component('Chip', Chip);
app.component('Toolbar', Toolbar);
app.component('InputMask', InputMask)
app.use(router)
    .use(VueAxios, axios)
    .use(PrimeVue)
    .use(ElementPlus)
    .use(Provider)
    .mount('#app');
