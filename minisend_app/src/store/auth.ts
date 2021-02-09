import Vue from 'vue';

export const auth = {
    namespaced: true,
    state: {token: null},
    mutations: {
        login(state, token) {
            state.token = token;
        }
    },
    actions: {
        login({commit}, credentials) {
            return new Promise(resolve => {
                Vue.axios.post(process.env.VUE_APP_API_URL + 'auth/login', credentials).then((res) => {
                    if (res.data && res.data.access_token) {
                        Vue.axios.defaults.headers.common['Authorization'] = 'Bearer ' + res.data.access_token;
                        commit('login', res.data.access_token);
                        resolve();
                    }
                });
            })
        }
    },
    getters: {
        authenticated: state => {
            return !!state.token;
        }
    }
}
