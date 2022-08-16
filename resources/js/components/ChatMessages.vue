<template>
  <div>
    <div class="chat-header">
      <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
        <i class="material-icons">chevron_left</i>
      </a>
      <div class="media">
        <div class="media-img-wrap">
          <a :href="chatInfo.link">
            <div class="avatar">
              <img :src="chatInfo.photo" alt="User Image"
                   class="avatar-img rounded-circle">
            </div>
          </a>
        </div>
        <div class="media-body">
          <div class="user-name">
            <a :href="chatInfo.link">{{chatInfo.name}}</a>
          </div>
          <div v-if="false" class="user-status"></div>
        </div>
      </div>
      <div class="chat-options">
        <a :href="'tel:'+chatInfo.phone">
          <i class="material-icons">local_phone</i>
        </a>
        <a href="javascript:void(0)">
          <i class="material-icons">more_vert</i>
        </a>
      </div>
    </div>

    <div class="chat-body">
      <div class="chat-scroll" ref="chatScrollCont">
        <ul class="list-unstyled">
          <li v-for="message in messagesData(messages)" class="media" :class="{'received': !message.sent, 'sent': message.sent}">
            <div class="avatar">
              <img v-if="!message.sent" :src="chatInfo.photo" alt="User Image"
                   class="avatar-img rounded-circle">
            </div>
            <div class="media-body">
              <div class="msg-box" v-if="!message.attachment">
                <div>
                  <p>{{ message.data }}</p>
                  <ul class="chat-msg-info">
                    <li>
                      <div class="chat-time">
                        <span>{{moment(message.created_at).format('MMMM Do YYYY, h:mm:ss a')}}</span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="msg-box" v-if="message.attachment">
                <div>
                  <div class="chat-msg-attachments">
                    <div class="chat-attachment">
                      <img v-if="message.image" :src="message.file" alt="Attachment">
                      <img v-else src="/assets/img/img-04.jpg" alt="Attachment">
                      <div class="chat-attach-caption">{{message.name}}</div>
                      <a :href="message.file" :download="message.name" class="chat-attach-download">
                        <i class="fas fa-download"></i>
                      </a>
                    </div>
                  </div>
                  <ul class="chat-msg-info">
                    <li>
                      <div class="chat-time">
                        <span>{{moment(message.created_at).format('MMMM Do YYYY, h:mm:ss a')}}</span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['messages', 'chatInfo', 'userInfo'],

    updated() {
      this.scrollDown()
    },

    mounted() {
      this.scrollDown()
    },

    methods: {
      messagesData(items) {
        return items.map(item => {
          if (item.user_id === this.userInfo.id) {
            item['sent'] = true
          } else {
            item['sent'] = false
          }

          return item
        })
      },

      scrollDown() {
        this.$refs.chatScrollCont.scrollTop = this.$refs.chatScrollCont.scrollHeight
      },
    }
  }
</script>

<style scoped>

</style>
