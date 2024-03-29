window.Vue = require('vue');
window.axios = require('axios');
// IMPORTO L'APP PER FARLA VISUALIZZARE NELLA VISTA
import App from './views/App';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    render: h=>h(App)
});