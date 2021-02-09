<template>
  <b-sidebar :fullheight="true" class="sidebar" open position="static" type="is-light">
    <div class="py-1 px-2">
      <div class="brand">Mini Send</div>

      <div class="buttons has-addons mt-4 mb-0">
        <button :class="mode === 'INBOX' ? 'is-primary' : null" :disabled="true" class="button" @click="mode = 'INBOX'">
          INBOX
        </button>
        <button :class="mode === 'OUTBOX' ? 'is-primary' : null" class="button" @click="mode = 'OUTBOX'">OUTBOX</button>
      </div>
      <b-field class="mb-0">
        <b-input v-model="search" :icon-right="search !== null ? 'close-circle' : null"
                 icon-right-clickable
                 placeholder="Search..."
                 @input="loadMails(search)"
                 @icon-right-click="clearSearch()"></b-input>
      </b-field>

      <div class="mail-list-container py-1">
        <EmailList/>
      </div>
    </div>
  </b-sidebar>
</template>

<script>
import Vue from 'vue';
import EmailList from "@/components/mail/EmailList";

export default Vue.extend({
  name: "Sidebar",
  components: {EmailList},
  data: () => {
    return {
      search: null,
      mode: 'OUTBOX'
    }
  },
  mounted() {
    this.loadMails(null);
  },
  methods: {
    loadMails(search = null) {
      this.$store.dispatch('email/retrieveEmails', search);
    },
    clearSearch() {
      this.search = null;
      this.loadMails();
    }
  }
});
</script>

<style lang="scss">
.sidebar {
  width: 350px;

  .sidebar-content {
    width: 100%;
  }

  .brand {
    font-size: 2rem;
    color: gray;
  }

  .buttons {
    > * {
      flex: 1;
    }
  }

  .mail-list-container {
    height: 100%;
    overflow: auto;
  }
}
</style>
