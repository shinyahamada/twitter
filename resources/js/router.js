import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import Test from './pages/Test.vue'
import Login from './pages/Login.vue'
import Profile from './pages/Profile.vue'

import store from './store'

import SystemError from './pages/errors/System.vue'


// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  {
    path: '/test',
    component: Test,
    name: 'test'
  },
  {
    path: '/login',
    component: Login,
    name: 'login',
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next('/')
      } else {
        next()
      }
    }
  },
  {
    path: '/profile/:id',
    component: Profile,
    name: 'profile',
    props: true,
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/')
      }
    }
  },
  {
    path: '/500',
    component: SystemError
  }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
  mode: 'history',
  routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router
