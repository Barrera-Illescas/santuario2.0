import './bootstrap';
import { createApp } from 'vue';
import App from './web/App.vue';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import router from './router';
import { es } from 'vuetify/locale';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import Navbar from './web/publics/Navbar.vue';
import Portafolio from './web/Portafolio.vue';
import Historia from './web/Historia.vue';
import Ubicacion from './web/Ubicacion.vue';
import Colaboraciones from './web/Colaboraciones.vue';
import Denuncias  from './web/Denuncias.vue';

// import vuetify from './plugins/vuetify';


const app = createApp(App);
const vuetify = createVuetify({
  components,
  directives,
  locale: {
        locale: 'es',
        messages: { es },
    },
});

app.component('Navbar', Navbar);
app.component('Portafolio', Portafolio);
app.component('Historia', Historia);
app.component('Ubicacion', Ubicacion);
app.component('Colaboraciones', Colaboraciones);
app.component('Denuncias', Denuncias);
//app.use(VueMeta);
app.use(router);
app.use(vuetify)
app.mount('#app');
// createApp(App).use(vuetify).mount('#app');