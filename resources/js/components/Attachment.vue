<template>
  <div class="m-2">
    <div v-if="files.length" class="mb-2 d-flex justify-content-end">
      <button class="btn btn-primary" @click="triggerUpload">Upload file</button>
    </div>

    <div class="card card-table mb-0" v-if="files.length">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-center mb-0">
            <thead>
            <tr>
              <th>{{this.name}}</th>
              <th>{{this.file}}</th>
              <th>{{this.uploadDate}}</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="file in files">
              <td class="w-25">
                <h2>{{file.name}}</h2>
              </td>
              <td>
                <a :href="file.file" :download="file.name" v-if="file.image">
                  <img class="w-50" :src="file.file" alt="Image">
                </a>
                <a :href="file.file" :download="file.name" v-if="!file.image" class="btn btn-sm bg-info-light">
                  <i class="far fa-eye"> View</i>
                </a>
              </td>
              <td>
                {{moment(file.created_at).format('MMMM Do YYYY, h:mm:ss a')}}
              </td>
              <td>
                <button class="btn btn-success" @click="sendAttachment(file)">
                  <i class="fas fa-arrow-right"></i>
                </button>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    props: ['files'],

    data() {
      return {
        name: null,
        file: null,
        uploadDate: null,
        view: null,
      }
    },

    created() {
      axios.post('/chat/trans', {keys: ['regular.file-name', 'regular.file', 'regular.upload-date']}).then(r => {
        [this.name, this.file, this.uploadDate] = r.data
      })
      if (!this.files.length) this.localFiles = true
    },

    methods: {
      triggerUpload() {
        this.$root.$refs.chatForm.uploadFile()
      },
      sendAttachment(file) {
        this.$root.$refs.chatForm.dataMessage(true, file)
      }
    }
  }
</script>

<style scoped>

</style>
