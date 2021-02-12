<template>
  <li :class="isSelectedEmail ? 'selected' : null" class="card mt-1 mail-item" @click="selectMail()">
    <div class="card-content p-2">
      <div class="mail-item-header">
        <div class="send-info">
          <div class="email">{{ email.to }}</div>
        </div>
        <div class="datetime">{{ dateTime }}</div>
      </div>
      <div class="mail-item-body">
        <div class="subject">{{ email.subject }}</div>
      </div>
    </div>
    <div :class="statusColor" class="tag status"></div>
  </li>
</template>

<script>
import Vue from 'vue';
import {format, parseISO} from "date-fns";

export default Vue.extend({
  name: "MailListItem",
  props: [
    'email'
  ],
  computed: {
    dateTime() {
      return format(parseISO(this.email.created_at), 'MM/dd/yyyy hh:mm');
    },
    statusColor() {
      switch (this.email.status) {
        case 'POSTED':
          return 'is-warning';
        case 'SENT':
          return 'is-success';
        case 'FAILED':
        default:
          return 'is-danger';
      }
    },
    isSelectedEmail() {
      const selectedMail = this.$store.getters['email/selectedEmail'];
      if (selectedMail === null) {
        return false;
      }

      return this.email.id === this.$store.getters['email/selectedEmail'].id
    }
  },
  methods: {
    selectMail() {
      this.$store.commit('email/setSelectedEmail', this.email);
    }
  }
});
</script>

<style lang="scss">
.mail-item {
  transition: background-color 0.2s ease;
  cursor: pointer;
  position: relative;

  &.selected {
    background-color: rgba(purple, 0.1);

    &:hover {
      background-color: rgba(purple, 0.2);
    }
  }

  &:hover {
    background-color: rgba(0, 0, 0, 0.1);
  }

  .mail-item-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: nowrap;

    .send-info {
      flex: 1;
      overflow: hidden;
      display: flex;
      align-items: center;
      margin-right: 1rem;

      .email {
        flex: 1;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        font-weight: bold;
        margin-left: 0.25rem;
      }
    }

    .datetime {
      font-size: 0.75rem;
      color: gray;
    }
  }

  .status {
    position: absolute;
    height: 7px;
    width: 7px;
    border-radius: 50%;
    padding: 0;
    bottom: 5px;
    right: 5px;
  }
}
</style>
