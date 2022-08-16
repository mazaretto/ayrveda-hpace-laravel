<template>
  <div class="chat-footer">
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="btn-file btn" @click="attachment($event)">
          <i class="fa fa-paperclip"></i>
        </div>
      </div>
      <input id="btn-input" type="text" name="message" class="input-msg-send form-control" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">
      <div class="input-group-append">
        <button class="btn msg-send-btn" id="btn-chat" @click="sendMessage">
          <i class="fab fa-telegram-plane"></i>
        </button>
      </div>
    </div>

    <form :action="formUpload" ref="uploadForm" method="Post" enctype="multipart/form-data" style="display: none;">
      <input type="hidden" name="_token" :value="csrf">
      <input type="file" name="file" ref="uploadInput" @change="handleFile($event)">
    </form>
  </div>
</template>
<script>
  import Attachment from "./Attachment";

  export default {
    props: ['user', 'chatInfo', 'userInfo', 'formUpload', 'csrf'],

    data: function () {
      return {
        newMessage: ''
      }
    },

    methods: {
      sendMessage() {
        this.dataMessage()
      },
      uploadFile() {
        this.$refs.uploadInput.click()
        // let file = {file: file.file, image: file.image, name: file.name}
        // this.dataMessage(true, )
      },
      handleFile() {
        let formAction = $(this.$refs.uploadForm).attr('action')
        let form = new FormData(this.$refs.uploadForm)

        axios.post(formAction, form).then(r => {
          r.data.name = 'Uploaded File'
          this.dataMessage(true, r.data)
        })
      },
      attachment(event) {
        event.preventDefault()
        axios.get('/chat/attachment').then(r => {
          if (!r.data || !r.data.length) {
            this.uploadFile()
          } else {
            this.$modal.show(
              Attachment,
              {'files': r.data},
              {adaptive: true, scrollable: true, height: 'auto'},
            )
          }
        })
      },
      dataMessage(isFile = false, file = null) {
        let data = null;
        if (isFile) {
          data = {file: file.file, image: file.image, name: file.name}
        } else {
          data = this.newMessage
          this.newMessage = ''
        }

        this.$emit('message-sent', {
          data: data,
          attachment: isFile,
          chat_id: this.chatInfo.id
        });
      },
    },
  }
</script>

<style scoped>

</style>
