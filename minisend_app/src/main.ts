import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import App from './App.vue'
import router from './router'
import store from './store'

Vue.config.productionTip = false
Vue.use(VueAxios, axios)
Vue.use(Buefy)

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
