<template>
  <div>
    <div class="card m-0">
      <div class="card-body d-flex flex-wrap justify-content-around">
        <div class="lng-container mt-2" v-for="(lng, lng_key) in lngs" @click="changeLng(lng_key)">
          <img class="img-lng" :src="lng" alt="Card image cap">
        </div>
        <div class="flex-break"></div>
        <div class="mt-5">
          <p class="reset" @click="reset">Reset token & session</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "SupportOptions",

    props: ['lngs'],

    methods: {
      changeLng(lng) {
        this.$root.$refs.supportChat.lngChange(lng)
      },
      reset() {
        this.$root.$refs.supportChat.resetToken()
      }
    },
  }
</script>

<style scoped>
  .img-lng {
    height: 4rem;
  }

  .lng-container {
    cursor: pointer;
    background: linear-gradient(#e66465, #9198e5);
    padding: 10px;
    border-radius: 10px;
  }
  .reset {
    text-decoration: underline;
    cursor: pointer;
    color: rgb(9, 229, 171);
  }
</style>
