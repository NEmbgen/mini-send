<template>
  <div class="show-mail container mt-4">
    <div v-if="mail === null" class="no-email-selected">
      <b-icon icon="inbox" size="is-large"></b-icon>
      No Email selected.
    </div>
    <div v-if="mail !== null" class="card">
      <b-button class="close-email" icon-right="close" type="is-danger" @click="closeEmail()"></b-button>
      <div class="card-content">
        <div class="email-header">
          <div class="recipient">
            <div class="tag is-dark">TO:</div> <div class="tag is-primary">{{ mail.to }}</div>
          </div>
          <div class="sender">
            <div class="tag is-dark">FROM:</div> <div class="tag is-primary">{{ mail.sender.email }}</div>
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
          <div class="email-body mt-2">
            {{ mail.body }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {format, parseISO} from "date-fns";

export default {
  name: "ShowMail",
  computed: {
    mail() {
      console.log(this.$store.getters["email/selectedEmail"]);
      return this.$store.getters["email/selectedEmail"] || null;
    }
  },
  methods: {
    closeEmail() {
      this.$store.commit('email/setSelectedEmail', null);
      console.log(this.$store.getters["email/selectedEmail"]);
    },
    formatDate(date) {
      return format(parseISO(date), 'MM/dd/yyyy hh:mm');
    }
  }
}
</script>

<style lang="scss" scoped>
.show-mail {
  height: 100%;
  margin-left: 2rem;
  margin-right: 2rem;

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
    max-width: 900px;
    margin: 0 auto;
    position: relative;

    .close-email {
      position: absolute;
      top: 5px;
      right: 5px;
      cursor: pointer;
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
