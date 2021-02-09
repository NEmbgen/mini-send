<template>
  <div class="dashboard-container">
    <Sidebar />
    <main class="dashboard-content">
      <ShowMail />
    </main>
  </div>
</template>

<script>
import Vue from 'vue';
import ShowMail from "@/components/mail/ShowMail";
import Sidebar from "@/components/mail/Sidebar";

export default Vue.extend({
  name: "Dashboard",
  components: {ShowMail, Sidebar}
});
</script>

<style lang="scss" scoped>
.dashboard-container {
  width: 100%;
  height: 100%;
  display: flex;
  overflow: hidden;

  .dashboard-content {
    flex: 1;
  }
}
</style>
