import Vue from 'vue'

// root
import router from './router'

// vuex
import store from './store'

// root component
import App from './App.vue'

// CSRF 対策
import './bootstrap'

const createApp = async () => {
  await store.dispatch('auth/currentUser');

  new Vue({
    el: '#app',
    router,
    store,
    components: { App },
    template: '<App />' // APP を描画しているらしい '/' の意味調べたけど見つけ切らんかった後で
  });

}

createApp()
