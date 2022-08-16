<template>
  <div class="chat-scroll">
    <a href="javascript:void(0);" @click="chatSelect(chat)" class="media read-chat" v-for="chat in chatList">
      <div class="media-img-wrap">
        <div class="avatar">
          <img v-bind:src="chat.photo" alt="Avatar"
               class="avatar-img rounded-circle">
        </div>
      </div>
      <div class="media-body">
        <div>
          <div class="user-name">{{chat.name}}</div>
          <div v-if="chat.last_message.isFile" class="user-last-chat"><b v-if="chat.last_message.isSent">{{youTrans}}:</b> File</div>
          <div v-else class="user-last-chat"><b v-if="chat.last_message.isSent">{{youTrans}}:</b> {{chat.last_message.data}}</div>
        </div>
        <div>
          <div v-if="chat.last_message.time" class="last-chat-time block">{{moment(chat.last_message.time).format('Do MMM, h:mm a')}}</div>
          <div v-if="chat.unread" class="badge badge-success badge-pill">{{chat.unread}}</div>
        </div>
      </div>
    </a>
  </div>
</template>

<script>
  export default {
    props: ['chatLists'],

    data() {
      return {
        youTrans: 'You',
        chatList: this.chatLists,
      }
    },

    created(){
      axios.post('/chat/trans', {keys: ['chat.you']}).then(r => {
        this.youTrans =  r.data[0]
      })
    },

    methods: {
      chatSelect(chat) {
        let chatId = chat.id
        this.$root.$emit('chat-select', chatId)

        axios.post('/chat/read',{
          chatID: chatId
        }).then(r=>{
          chat.unread = 0
        });
      }
    },
  }
</script>

<style scoped>

</style>
