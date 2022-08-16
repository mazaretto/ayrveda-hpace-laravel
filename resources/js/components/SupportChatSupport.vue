<template>
  <div v-if="active">
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
    </beautiful-chat>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        participants: [
          {
            id: 'user',
            name: 'User',
            imageUrl: 'https://avatars3.githubusercontent.com/u/37018832?s=200&v=4'
          }
        ],
        titleImageUrl: 'https://a.slack-edge.com/66f9/img/avatars-teams/ava_0001-34.png',
        newMessagesCount: 0,
        messageList: [], // the list of the messages to show, can be paginated and adjusted dynamically
        isChatOpen: false, // to determine whether the chat window should be open or closed
        showTypingIndicator: '', // when set to a value matching the participant.id it shows the typing indicator for the specific user
        colors: {
          header: {
            bg: '#00d0f1',
            text: '#ffffff'
          },
          launcher: {
            bg: '#00d0f1'
          },
          messageList: {
            bg: '#ffffff'
          },
          sentMessage: {
            bg: '#00d0f1',
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
        active: false,
        token: null,
      }
    },

    props: ['urlGet', 'urlPost'],

    methods: {
      // called when the user sends a message
      onMessageWasSent(message) {
        this.supportSend(message)
        this.messageList = [...this.messageList, message]
      },
      async fetchSupport(token) {
        this.token = token

        this.participants[0].name = 'User, Token#' + this.token
        axios.get(this.urlGet, {
          params: {
            token: token,
          }
        }).then(r => {
          r.data.forEach(message => {
            let author
            if (message.send_to === 'support') {
              author = 'user'
            } else {
              author = 'me'
            }
            this.messageList = [...this.messageList, {
              author: author,
              type: 'text',
              data: {
                text: message.data
              }
            }]
          })

          Echo.private('Support.ID.' + this.token)
            .listen('SupportSent', (e) => {
              this.messageList = [...this.messageList, {
                author: 'user',
                type: 'text',
                data: {
                  text: e.message.data,
                },
              }]
              this.newMessagesCount = this.isChatOpen ? this.newMessagesCount : this.newMessagesCount + 1
            });
        })
      },
      async supportSend(message) {
        axios.post(this.urlPost, {
          token: this.token,
          data: message.data.text
        }).then(r => {
          console.log(r.data)
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
    },
  }
</script>

<style>
  .sc-chat-window, .sc-launcher {
    z-index: 10000;
  }
</style>
