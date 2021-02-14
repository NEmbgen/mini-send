<template>
  <Widget :loading="$store.getters['emailStatistics/outboxAmountLoading']">
    <template v-slot:title>Outbox Sent Amount</template>
    <template v-slot:content>
      <div class="amount-text">You have sent <span class="amount">{{ $store.getters['emailStatistics/outboxAmount'] }}</span>
        {{ $store.getters['emailStatistics/outboxAmount'] === 1 ? 'email' : 'emails' }}.
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
  mounted() {
    this.$store.dispatch('emailStatistics/loadOutboxAmount');
  },
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
