<template>
  <Widget :loading="sentAmount === null">
    <template v-slot:title>Outbox Sent Amount</template>
    <template v-slot:content>
      <div class="amount-text">You have sent <span class="amount">{{ sentAmount }}</span>
        {{ sentAmount === 1 ? 'email' : 'emails' }}.
      </div>
    </template>
  </Widget>
</template>

<script>
import Vue from 'vue';
import Widget from "@/components/mail/widgets/Widget";

export default Vue.extend({
  name: "EmailOutboxAmount",
  components: {Widget},
  data: () => {
    return {
      sentAmount: null
    }
  },
  mounted() {
    this.loadOutboxStatus();
  },
  methods: {
    loadOutboxStatus() {
      Vue.axios.get(process.env.VUE_APP_API_URL + 'email-statistics/sent-amount').then(resp => {
        if (resp && resp.data) {
          this.sentAmount = resp.data;
        }
      })
    }
  }
});
</script>

<style lang="scss" scoped>
.amount-text {
  color: darkgray;

  .amount {
    color: black;
    font-size: 1.25rem;
  }
}
</style>
