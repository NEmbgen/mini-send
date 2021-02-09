import Vue from 'vue'
import Vuex from 'vuex'
import {auth} from './auth';
import {email} from './email';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        auth, email
    }
})
