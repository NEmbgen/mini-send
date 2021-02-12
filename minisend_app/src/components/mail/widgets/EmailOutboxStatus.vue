<template>
  <Widget :loading="emailStatus === null">
    <template v-slot:title>
      Email Outbox Status
    </template>
    <template v-slot:content>
      <div class="tags" v-if="emailStatus">
        <div class="tag is-danger">Failed: {{ emailStatus['FAILED'] }}</div>
        <div class="tag is-warning">Posted: {{ emailStatus['POSTED'] }}</div>
        <div class="tag is-success">Sent: {{ emailStatus['SENT'] }}</div>
      </div>
    </template>
  </Widget>
</template>

<script>
import Vue from 'vue';
import {mapState} from 'vuex';
import Widget from "@/components/mail/widgets/Widget";

export default Vue.extend({
  name: "EmailOutboxStatus",
  components: {Widget},
  data: () => {
    return {
      emailStatus: null
    }
  },
  methods: {
    loadOutboxStatus() {
      Vue.axios.get(process.env.VUE_APP_API_URL + 'email-statistics/outbox-status').then(resp => {
        if (resp && resp.data) {
          this.emailStatus = resp.data;
        }
      })
    }
  },
  mounted() {
    this.loadOutboxStatus();
  },
  computed: mapState(['email/reloadStatistics']),
  // watch: {
  //   'email.reloadStatistics'() {
  //     this.loadOutboxStatus();
  //     this.$store.commit('email/reloadStatistics', false);
  //   }
  // }
});
</script>

<style scoped>

</style>
