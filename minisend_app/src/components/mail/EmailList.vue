<template>
  <ul class="mail-list">
    <EmailListItem v-for="email in $store.getters['email/emails']" :key="email.id" :email="email"/>
    <li v-if="!$store.getters['email/emails'] || $store.getters['email/emails'].length === 0" class="no-mail">No email yet.</li>
  </ul>
</template>

<script>
import EmailListItem from "@/components/mail/EmailListItem";

export default {
  name: "MailList",
  components: {EmailListItem}
}
</script>

<style lang="scss" scoped>
.mail-list {
  flex: 1;
  overflow: auto;

  .no-mail {
    color: gray;
    font-style: italic;
  }
}
</style>
