<template>
  <div class="auth">
    <div class="card">
      <div class="card-content">
        <h1 class="is-size-2 mb-4">Mini Send</h1>
        <Login/>
      </div>
    </div>
  </div>
</template>

<script>
import Login from "@/components/auth/Login";

export default {
  name: "Auth",
  components: {Login}
}
</script>

<style scoped lang="scss">
  .auth{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    background: linear-gradient(#2fe235, #65efef);

    .card {
      width: 500px;
      max-width: 90%
    }
  }
</style>
