import Vue from 'vue';

export const email = {
    namespaced: true,
    state: {emails: [], selectedEmail: null, reloadStatistics: false},
    mutations: {
        saveEmails(state, emails) {
            state.emails = emails;
        },
        setSelectedEmail(state, email) {
            state.selectedEmail = email;
        },
        reloadStatistics(state) {
            return state.reloadStatistics = state;
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
        },
        sendMail({commit}, data) {
            return new Promise((resolve) => {
                Vue.axios.post(process.env.VUE_APP_API_URL + 'emails/send', data).then(() => {
                    resolve();
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
