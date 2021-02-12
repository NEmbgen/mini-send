<template>
  <div class="card">
    <div class="card-content">
      <h1 class="is-size-3 mb-4">New Email</h1>
      <form action="">
        <b-field label="To">
          <b-input v-model="to"></b-input>
        </b-field>
        <b-field label="Subject">
          <b-input v-model="subject"></b-input>
        </b-field>
        <b-field label="Message">
          <b-input v-model="body" type="textarea"></b-input>
        </b-field>

        <div class="actions mt-4">
          <b-button icon-left="send" type="is-primary" @click="sendMail()">Send</b-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "WriteEmail",
  data: () => {
    return {
      to: '',
      subject: '',
      body: ''
    }
  },
  methods: {
    sendMail() {
      this.$store.dispatch('email/sendMail', {to: this.to, subject: this.subject, body: this.body}).then(() => {
        //
      })
    }
  }
}
</script>

<style scoped>
.card {
  width: 900px;
}
</style>
