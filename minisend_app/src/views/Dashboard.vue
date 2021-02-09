<template>
 <div class="dashboard-container">
   <aside class="dashboard-aside">Test</aside>
   <main class="dashboard-content">Test</main>
 </div>
</template>

<script>
export default {
  name: "Dashboard"
}
</script>

<style scoped lang="scss">
  .dashboard-container {
    width: 100%;
    height: 100%;
    display: flex;
    overflow: hidden;

    .dashboard-aside {
      width: 300px;
    }

    .dashboard-content {
      flex: 1;
    }
  }
</style>
