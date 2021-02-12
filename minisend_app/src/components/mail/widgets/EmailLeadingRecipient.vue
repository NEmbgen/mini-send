<template>
  <Widget :loading="recipient === null">
    <template v-slot:title>Recipient you have sent most emails to</template>
    <template v-slot:content>
      <div v-if="recipient" class="recipient-text">{{ recipient.to }} <span class="muted">({{ recipient.count}})</span>
      </div>
    </template>
  </Widget>
</template>

<script>
import Vue from 'vue';
import Widget from "@/components/mail/widgets/Widget";

export default Vue.extend({
  name: "EmailLeadingRecipient",
  components: {Widget},
  data: () => {
    return {
      recipient: null
    }
  },
  mounted() {
    this.loadOutboxStatus();
  },
  methods: {
    loadOutboxStatus() {
      Vue.axios.get(process.env.VUE_APP_API_URL + 'email-statistics/leading-recipient').then(resp => {
        if (resp && resp.data) {
          this.recipient = resp.data;
          console.log(this.recipient);
        }
      })
    }
  }
});
</script>

<style lang="scss" scoped>
.recipient-text {
  font-weight: bold;

  .muted {
    color: darkgray;
    font-weight: normal;
  }
}
</style>
