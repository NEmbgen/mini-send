<template>
  <div class="show-mail mt-4">
    <div v-if="mail === null" class="no-email-selected">
      <b-icon icon="inbox" size="is-large"></b-icon>
      No Email selected.
      <b-loading v-model="loading" :is-full-page="false"></b-loading>
    </div>
    <div class="card">
      <b-loading v-model="loading" :is-full-page="false"></b-loading>
      <b-button class="close-email" icon-right="close" type="is-danger" @click="closeEmail()"></b-button>
      <div class="card-content" v-if="mail !== null" >
        <div class="email-header">
          <div class="recipient">
            <div class="tag is-dark">TO:</div>
            <div class="tag is-primary">{{ mail.to }}</div>
          </div>
          <div class="sender">
            <div class="tag is-dark">FROM:</div>
            <div class="tag is-primary">{{ mail.sender.email }}</div>
          </div>
          <div class="email-meta">
            {{ formatDate(mail.created_at) }}
          </div>
        </div>
        <div class="email-content mt-4">
          <div class="email-content-header">
            <div class="subject">
              {{ mail.subject }}
            </div>
          </div>
          <div class="email-body mt-2" v-html="mail.body">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {format, parseISO} from "date-fns";
import Vue from 'vue';

export default Vue.extend({
  name: "ShowMail",
  data() {
    return {
      loading: false,
      mail: null
    }
  },
  props: ['mailId'],
  watch: {
    mailId() {
      if (this.mailId) {
        this.loading = true;
        Vue.axios.get(process.env.VUE_APP_API_URL + `emails/${this.mailId}`).then((resp) => {
          if (resp && resp.data) {
            this.mail = resp.data;
          }
        }).finally(() => this.loading = false);
      } else {
        this.mail = null;
      }
    }
  },
  methods: {
    closeEmail() {
      this.$store.commit('email/setSelectedEmail', null);
    },
    formatDate(date) {
      return format(parseISO(date), 'dd/MM/yyyy hh:mm');
    }
  }
});
</script>

<style lang="scss" scoped>
.show-mail {
  flex: 1;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
  position: relative;

  .no-email-selected {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    font-size: 2rem;
    color: rgba(0, 0, 0, 0.2)
  }

  .card {
    //max-width: 900px;
    margin: 0 auto;
    position: relative;

    .close-email {
      position: absolute;
      top: 5px;
      right: 5px;
      cursor: pointer;
    }

    .email-header {
      .recipient, .sender {
        :not(:first-child) {
          margin-left: 0.5rem;
        }
      }
    }

    .email-content {
      .email-content-header {
        display: flex;
        flex-direction: column;

        .subject {
          font-size: 1.5rem;
          font-weight: bold;
        }
      }
    }
  }
}
</style>
