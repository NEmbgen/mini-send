<template>
  <form action="">
    <b-field label="Email">
      <b-input v-model="email"
               icon="email"
               type="email">
      </b-input>
    </b-field>

    <b-field label="Password">
      <b-input v-model="password"
               minlength="6"
               icon="lock"
               type="password">
      </b-input>
    </b-field>

    <b-field>
      <b-button icon-left="login" type="is-primary" :loading="loading" @click="login()">Login</b-button>
    </b-field>
  </form>
</template>

<script>
export default {
  name: "Login",
  data: () => {
    return {
      email: 'mini@send.com',
      password: 'password',
      loading: false
    }
  },
  methods: {
    login() {
      this.loading = true;
      this.$store.dispatch('auth/login', {email: this.email, password: this.password}).then(() => {
        this.$router.push('/');
      }).finally(() => this.loading = false);
    }
  }
}
</script>

<style scoped>

</style>
