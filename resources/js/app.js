require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'vuex'
import storeVuex from './store/index'
import VueChatScroll from 'vue-chat-scroll'
import filter from './filter'
Vue.use(Vuex)
Vue.use(VueChatScroll)
const store = new Vuex.Store(storeVuex)

// window.moment = require('moment');

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('main-app', require('./components/MainApp.vue').default);
const app = new Vue({
    el: '#app',
    store
});
