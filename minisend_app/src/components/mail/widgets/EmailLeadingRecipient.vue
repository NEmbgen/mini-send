<template>
  <Widget :loading="$store.getters['emailStatistics/leadingRecipientLoading']">
    <template v-slot:title>Leading Recipient</template>
    <template v-slot:content>
      <div v-if="$store.getters['emailStatistics/leadingRecipient']" class="recipient-text">
        {{ $store.getters['emailStatistics/leadingRecipient'].to }} <span
          class="muted">({{ $store.getters['emailStatistics/leadingRecipient'].count }})</span>
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
  mounted() {
    this.$store.dispatch('emailStatistics/loadLeadingRecipient');
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
