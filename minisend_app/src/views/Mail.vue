<template>
  <div class="mail-container">
    <Sidebar/>
    <main class="mail-content container px-5">
      <div class="widgets">
        <EmailOutboxStatus/>
        <EmailOutboxAmount/>
        <EmailLeadingRecipient/>
      </div>
      <ShowMail :mail-id="selectedMailId"/>
    </main>
    <b-button class="create-mail-button" icon-right="plus" type="is-primary" @click="writeEmailModal = true"></b-button>
    <b-modal
        v-model="writeEmailModal"
        :can-cancel="true"
        has-modal-card>
      <WriteEmail @emailSent="emailSent()"/>
    </b-modal>
  </div>
</template>

<script>
import Vue from 'vue';
import ShowMail from "@/components/mail/ShowMail";
import Sidebar from "@/components/mail/Sidebar";
import WriteEmail from "@/components/mail/WriteEmail";
import EmailOutboxStatus from "@/components/mail/widgets/EmailOutboxStatus";
import EmailOutboxAmount from "@/components/mail/widgets/EmailOutboxAmount";
import EmailLeadingRecipient from "@/components/mail/widgets/EmailLeadingRecipient";

export default Vue.extend({
  name: "Dashboard",
  components: {EmailLeadingRecipient, EmailOutboxAmount, EmailOutboxStatus, WriteEmail, ShowMail, Sidebar},
  data: () => {
    return {
      writeEmailModal: false
    }
  },
  methods: {
    emailSent() {
      this.writeEmailModal = false;
      this.$buefy.snackbar.open({
        message: 'Email has been sent',
        type: 'is-success',
        position: 'is-bottom',
        indefinite: false,
      });
      this.$store.dispatch('email/retrieveEmails');
    }
  },
  computed: {
    selectedMailId() {
      return this.$store.getters['email/selectedEmail'] ? this.$store.getters['email/selectedEmail'].id : null;
    }
  }
});
</script>

<style lang="scss" scoped>
.mail-container {
  width: 100%;
  height: 100%;
  display: flex;
  position: relative;

  .mail-content {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .create-mail-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 1.5rem;
    padding: 0
  }

  .widgets {
    padding-top: 0.5rem;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    grid-gap: 0.5rem;
  }
}

</style>
