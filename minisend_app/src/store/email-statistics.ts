import Vue from 'vue';

export const emailStatistics = {
    namespaced: true,
    state: {
        totalAttachmentSize: {
            value: 0,
            loading: false
        },
        outboxStatus: {
            value: null,
            loading: false
        },
        outboxAmount: {
            value: null,
            loading: false
        },
        leadingRecipient: {
            value: null,
            loading: false
        },
    },
    mutations: {
        totalAttachmentSize(state, {loading, value = null}) {
            if (value) {
                state.totalAttachmentSize.value = value;
            }
            state.totalAttachmentSize.loading = loading;
        },
        outboxAmount(state, {loading, value = null}) {
            if (value) {
                state.outboxAmount.value = value;
            }
            state.outboxAmount.loading = loading;
        },
        outboxStatus(state, {loading, value = null}) {
            if (value) {
                state.outboxStatus.value = value;
            }
            state.outboxStatus.loading = loading;
        },
        leadingRecipient(state, {loading, value = null}) {
            if (value) {
                state.leadingRecipient.value = value;
            }
            state.leadingRecipient.loading = loading;
        }
    },
    actions: {
        refreshStatistics({dispatch}) {
            dispatch('loadOutboxStatus');
            dispatch('loadAttachmentSize');
            dispatch('loadLeadingRecipient');
            dispatch('loadOutboxAmount');
        },
        loadAttachmentSize({commit}) {
            return new Promise((resolve) => {
                commit('totalAttachmentSize', {loading: true});
                Vue.axios.get(process.env.VUE_APP_API_URL + 'email-statistics/attachment-size').then(resp => {
                    if (resp && resp.data && resp.data.size) {
                        commit('totalAttachmentSize', {loading: false, value: resp.data.size})
                        resolve()
                    }
                });
            });
        },
        loadLeadingRecipient({commit}) {
            return new Promise((resolve) => {
                commit('leadingRecipient', {loading: true});
                Vue.axios.get(process.env.VUE_APP_API_URL + 'email-statistics/leading-recipient').then(resp => {
                    if (resp && resp.data) {
                        commit('leadingRecipient', {loading: false, value: resp.data});
                        resolve();
                    }
                });
            });
        },
        loadOutboxAmount({commit}) {
            commit('outboxAmount', {loading: true});
            return new Promise((resolve) => {
                Vue.axios.get(process.env.VUE_APP_API_URL + 'email-statistics/sent-amount').then(resp => {
                    if (resp && resp.data) {
                        commit('outboxAmount', {loading: false, value: resp.data});
                        resolve();
                    }
                });
            });
        },
        loadOutboxStatus({commit}) {
            commit('outboxStatus', {loading: true});
            Vue.axios.get(process.env.VUE_APP_API_URL + 'email-statistics/outbox-status').then(resp => {
                if (resp && resp.data) {
                    commit('outboxStatus', {loading: false, value: resp.data});
                }
            })
        }
    },
    getters: {
        totalAttachmentSize(state) {
            return state.totalAttachmentSize.value;
        },
        outboxStatus(state) {
            return state.outboxStatus.value;
        },
        outboxAmount(state) {
            return state.outboxAmount.value;
        },
        leadingRecipient(state) {
            return state.leadingRecipient.value;
        },
        totalAttachmentSizeLoading(state) {
            return state.totalAttachmentSize.loading;
        },
        outboxStatusLoading(state) {
            return state.outboxStatus.loading;
        },
        outboxAmountLoading(state) {
            return state.outboxAmount.loading;
        },
        leadingRecipientLoading(state) {
            return state.leadingRecipient.loading;
        }
    }
}
