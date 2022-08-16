<template>
  <button class="btn btn-success mr-1" @click="supportView">Chat</button>
</template>

<script>
  export default {
    name: "SupportLoad",
    props: ['token'],

    methods: {
      supportView() {
        this.$root.$refs.supportChat.active= true
        this.$root.$refs.supportChat.fetchSupport(this.token)
        this.$root.$refs.supportChat.openChat()
      }
    },
  }
</script>

<style scoped>

</style>
