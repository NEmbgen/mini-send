<template>
  <Widget :loading="$store.getters['emailStatistics/totalAttachmentSizeLoading']">
    <template v-slot:title>Attachments</template>
    <template v-slot:content>
      <div class="widget-text">You have sent <span
          class="widget-value">{{ formatBytes($store.getters['emailStatistics/totalAttachmentSize']) }}</span> worth of
        attachments.
      </div>
    </template>
  </Widget>
</template>

<script>
import Vue from 'vue';
import Widget from "@/components/mail/widgets/Widget";

export default Vue.extend({
  name: "AttachmentSize",
  components: {Widget},
  mounted() {
    this.$store.dispatch('emailStatistics/loadAttachmentSize');
  },
  methods: {
    formatBytes(bytes, decimals = 2) {
      if (bytes === 0) return '0 Bytes';

      const k = 1024;
      const dm = decimals < 0 ? 0 : decimals;
      const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

      const i = Math.floor(Math.log(bytes) / Math.log(k));

      return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }
  }
});
</script>
