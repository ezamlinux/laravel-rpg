window.Vue = require('vue');
window._ = require('lodash');

require('../style/rpg.scss');

Vue.component('dashboard-component', require('./pages/dashboard').default);

let app = new Vue({
    el: '#app',
});
