<template>
  <div>
    <beautiful-chat
        :participants="participants"
        :titleImageUrl="titleImageUrl"
        :onMessageWasSent="onMessageWasSent"
        :messageList="messageList"
        :newMessagesCount="newMessagesCount"
        :isOpen="isChatOpen"
        :close="closeChat"
        :open="openChat"
        :showTypingIndicator="showTypingIndicator"
        :showLauncher="true"
        :showCloseButton="true"
        :alwaysScrollToBottom="true"
        :showFile="false"
        :showEmoji="false"
        :showEdition="false"
        :showDeletion="false"
        :messageStyling="false"
        :colors="colors">
      <template v-slot:header>
        <img :src="titleImageUrl" class="sc-header--img" style="width: 50px;">
        <div class="sc-header--title enabled">
          <div class="support-lng" v-for="lng in lngs">
            <img :src="lng" alt="">
          </div>

          <div class="reset_token__label btn view-btn" @click="resetToken">Reset token</div>
        </div>
      </template>
    </beautiful-chat>
  </div>
</template>

<script>
  // import SupportOptions from "./SupportOptions";
  export default {
    data() {
      return {
        participants: [
          {
            id: 'support',
            name: 'Support',
            imageUrl: 'https://avatars3.githubusercontent.com/u/37018832?s=200&v=4'
          }
        ],
        titleImageUrl: 'https://cdn.countryflags.com/thumbs/india/flag-round-250.png',
        newMessagesCount: 0,
        messageList: [
          {type: 'text', author: `support`, data: {text: `Hello, can I help you?`}},
        ], // the list of the messages to show, can be paginated and adjusted dynamically
        isChatOpen: false, // to determine whether the chat window should be open or closed
        showTypingIndicator: '', // when set to a value matching the participant.id it shows the typing indicator for the specific user
        colors: {
          header: {
            bg: '#0ed930',
            text: '#ffffff'
          },
          launcher: {
            bg: '#0ed930'
          },
          messageList: {
            bg: '#ffffff'
          },
          sentMessage: {
            bg: '#0ed930',
            text: '#ffffff'
          },
          receivedMessage: {
            bg: '#eaeaea',
            text: '#222222'
          },
          userInput: {
            bg: '#f4f7f9',
            text: '#565867'
          }
        }, // specifies the color scheme for the component
        userID: null,
        lngs: {
          'en': '/icons/locale/gb.png', 'ru': '/icons/locale/ru.png', 'fr': '/icons/locale/fr.png',
          'it': '/icons/locale/it.png', 'ro': '/icons/locale/ro.png'
        },
        token: null,
      }
    },

    created() {
      axios.get('/fetch-cur').then(r => {
        if (r.data.length) {
          this.messageList = []
          r.data.forEach(element => {
            let author
            if (element.send_to === 'support') {
              author = 'me'
            } else {
              author = 'support'
            }
            this.messageList = [...this.messageList, {
              author: author,
              data: {
                text: element.data
              },
              type: 'text',
            }]
          })

          this.identify()
        }
      })
    },

    methods: {
      resetToken() {
        axios.get('/reset-token').then(r => {
          if (r.data.status) {
            window.location.reload()
          }
        })
      },
      /*optionsModal() {
        this.$modal.show(
          SupportOptions,
          {lngs: this.lngs},
          {scrollable: true, adaptive: true, height: 'auto'})
      },*/
      // called when the user sends a message
      onMessageWasSent(message) {
        this.supportSend(message)
        this.messageList = [...this.messageList, message]
      },

      async supportSend(message) {
        if (this.userID == null) {
          await this.identify()
        }
        axios.post('/supportSend', {
          message: message.data.text,
        })
      },
      openChat() {
        // called when the user clicks on the fab button to open the chat
        this.isChatOpen = true
        this.newMessagesCount = 0
      },
      closeChat() {
        // called when the user clicks on the botton to close the chat
        this.isChatOpen = false
      },
      handleScrollToTop() {
        // called when the user scrolls message list to top
        // leverage pagination for loading another page of messages
      },
      async identify() {
        await axios.post('/identify').then(r => {
          this.userID = r.data[0]
          this.token = r.data[1]
          this.messageList.unshift({
            author: 'support',
            type: 'text',
            data: {
              text: 'Support token: #' + this.token
            },
          })

          Echo.private('Support.ID.' + this.token)
            .listen('SupportSent', (e) => {
              this.messageList = [...this.messageList, {
                author: 'support',
                type: 'text',
                data: {
                  text: e.message.data,
                },
              }]
              this.newMessagesCount = this.isChatOpen ? this.newMessagesCount : this.newMessagesCount + 1
            });
        })
        return;
      },
    },
  }
</script>

<style>
  .sc-chat-window, .sc-launcher {
    z-index: 999;
  }

  .sc-header--title {
    display: flex;
    justify-content: space-between;
    position: relative;
  }

  .sc-header--title:hover .reset_token__label {
    display: block;
  }

  .reset_token__label {
    display: none;
    position: absolute;
    bottom: -40px;
    left: 50%;
    transform: translateX(-50%);
    color: #000;
    background-color: rgb(255, 255, 255, 0.8);
    border-radius: 10px;
    padding: 8px 12px;
    font-family: Poppins, sans-serif;
    font-weight: 700;
    font-size: 20px;
    width: fit-content;
  }

  .support-lng > img {
    height: 23px;
  }
</style>
