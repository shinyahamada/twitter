import Vue from 'vue'

// root
import router from './router'

// root component
import App from './App.vue'

new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App />' // APP を描画しているらしい '/' の意味調べたけど見つけ切らんかった後で
});
