import Vue from 'vue';

export const email = {
    namespaced: true,
    state: {emails: [], selectedEmail: null},
    mutations: {
        saveEmails(state, emails) {
            state.emails = emails;
        },
        setSelectedEmail(state, email) {
            state.selectedEmail = email;
        }
    },
    actions: {
        retrieveEmails({commit}, search = null) {
            return new Promise((resolve) => {
                Vue.axios.get(process.env.VUE_APP_API_URL + 'emails', {params: {q: search}}).then((resp) => {
                    if (resp && resp.data) {
                        commit('saveEmails', resp.data)
                        resolve()
                    }
                });
            });
        }
    },
    getters: {
        emails(state) {
            return state.emails;
        },
        selectedEmail(state) {
            return state.selectedEmail;
        }
    }
}
