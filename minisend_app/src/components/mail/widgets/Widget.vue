<template>
  <div class="card">
    <div class="card-content">
      <div class="widget-title">
        <slot name="title"></slot>
      </div>
      <div class="widget-body">
        <slot name="content"></slot>
      </div>
    </div>
    <b-loading v-model="loading" :can-cancel="false" :is-full-page="false">
    </b-loading>
  </div>
</template>

<script>
export default {
  name: "Widget",
  props: ['loading']
}
</script>

<style lang="scss" scoped>
.card {
  position: relative;

  .card-content {
    padding: 0.5rem;

    .widget-title {
      color: gray;
      text-transform: uppercase;
      font-size: 0.75rem;
      margin-bottom: 0.5rem;
    }
  }
}
</style>
