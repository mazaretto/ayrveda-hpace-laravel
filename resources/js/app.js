/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./font_cart');

window.Vue = require('vue');

document.addEventListener('DOMContentLoaded', function () {
  const passCheck = document.querySelector('#show_pass')
  const passwords = document.querySelectorAll('input[type="password"]')

  passCheck.addEventListener('change', () => {
    for (let i = 0; i < passwords.length; ++i) {
      if (passCheck.checked) {
        passwords[i].type = 'text'
      } else {
        passwords[i].type = 'password'
      }
    }
  })
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import ChatMessages from './components/ChatMessages';
import ChatList from './components/ChatList';
import ChatForm from './components/ChatForm';
import SupportChat from './components/SupportChat';
import SupportChatSupport from './components/SupportChatSupport';
import SupportLoad from './components/SupportLoad';

Vue.component('chat-messages', ChatMessages);
Vue.component('chat-form', ChatForm);
Vue.component('chat-list', ChatList);
Vue.component('support-chat', SupportChat);
Vue.component('support-chat-support', SupportChatSupport);
Vue.component('support-load', SupportLoad);


import moment from 'moment'
import VModal from 'vue-js-modal'
import Chat from 'vue-beautiful-chat'

Vue.use(Chat)
Vue.use(VModal)
Vue.prototype.moment = moment

const app = new Vue({
  el: '#app',

  data: {
    messages: [],
    chatInfo: null,
    userInfo: null,
  },

  created() {
    axios.get('/chat/get-cur-user').then(r => {
      this.userInfo = r.data
    })

    this.$on('chat-select', (chatId) => {
      this.fetchMessages(chatId)
      this.getChatInfo(chatId)
    })
  },

  methods: {
    getChatInfo(chatId) {
      axios.get('/chat/get-chat-info', {
        params: {
          id: chatId
        }
      }).then(r => {
        this.chatInfo = r.data

        Echo.private('Chat.ID.' + this.chatInfo.chat_id)
          .listen('MessageSent', (e) => {
            this.messages.push(e.message);
          });
      })
    },

    fetchMessages(chatId) {
      axios.get('/chat/get-messages', {
        params: {
          id: chatId
        }
      }).then(response => {
        this.messages = response.data;
      });
    },

    addMessage(message) {
      axios.post('/chat/send-message', message).then(response => {
        this.messages.push(response.data);
      });
    }
  }
});

$(document).ready(function () {
  const imageZoom = $('#image-instant-zoom')
  const imageZoomReset = $(imageZoom).find('button')
  const imageZoomRange = $(imageZoom).find('input')
  $(document).on('DOMNodeInserted', '.fancybox-container', function (event) {
    if (!$(event.target).hasClass('fancybox-container')) {
      return
    }

    if (imageZoom.css('display') === 'none') {
      imageZoom.css('display', 'flex')
    }
  })

  $(document).on('DOMNodeRemoved', '.fancybox-container', function (event) {
    if (!$(event.target).hasClass('fancybox-container')) {
      return
    }
    if (imageZoom.css('display') === 'flex') {
      imageZoom.css('display', 'none')
    }
  })

  imageZoomReset.click(function () {
    imageZoomRange.val(1)
    imageZoomRange.trigger('input')
  })

  imageZoomRange.on('input', function () {
    let zoom = $(this).val()

    $('.fancybox-container .fancybox-stage .fancybox-slide--current img').css('transform', `scale(${zoom})`)
  })
})

