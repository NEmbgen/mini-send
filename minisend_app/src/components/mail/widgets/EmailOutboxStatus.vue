<template>
  <Widget :loading="$store.getters['emailStatistics/outboxStatusLoading']">
    <template v-slot:title>
      Email Outbox Status
    </template>
    <template v-slot:content>
      <div class="tags" v-if="$store.getters['emailStatistics/outboxStatus']">
        <div class="tag is-danger">Failed: {{ $store.getters['emailStatistics/outboxStatus']['FAILED'] }}</div>
        <div class="tag is-warning">Posted: {{ $store.getters['emailStatistics/outboxStatus']['POSTED'] }}</div>
        <div class="tag is-success">Sent: {{ $store.getters['emailStatistics/outboxStatus']['SENT'] }}</div>
      </div>
    </template>
  </Widget>
</template>

<script>
import Vue from 'vue';
import Widget from "@/components/mail/widgets/Widget";

export default Vue.extend({
  name: "EmailOutboxStatus",
  components: {Widget},
  mounted() {
    this.$store.dispatch('emailStatistics/loadOutboxStatus');
  }
});
</script>

<style scoped>

</style>
