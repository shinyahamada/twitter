import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import Test from './pages/Test.vue'
import Login from './pages/Login.vue'
import Profile from './pages/Profile.vue'
import Posts from './pages/Posts.vue'
import UserIndex from './pages/UserIndex.vue'
import UserEdit from './pages/UserEdit.vue'

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
    path: '/user/show/:id',
    component: Profile,
    name: 'profile',
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/')
      }
    }
  },
  {
    path: '/user/index',
    component: UserIndex,
    name: 'user_index',
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/')
      }
    }
  },
  {
    path:'/user/:id/edit',
    component: UserEdit,
    name: 'user_edit',
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/')
      }
    }
  },
  {
    path: '/',
    component: Posts,
    name: 'posts'
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
