<template>
  <div class="container-fluid">
    <div class="btn-group btn-group-toggle btn-group-lg mt-5 row" data-toggle="buttons">
      <label @click="tab = 1" class="btn btn-secondary active">
        <input type="radio" name="options" id="option1" autocomplete="off" checked> ログイン
      </label>
      <label @click="tab = 2" class="btn btn-secondary">
        <input type="radio" name="options" id="option3" autocomplete="off"> 新規登録
      </label>
    </div>
    <!-- bootstrap -->
    <div class="panel mt-5 mx-left" v-show="tab === 1">
      <form class="form" @submit.prevent="login">
        <div class="form-group">
          <label for="login-email">メールアドレス</label>
          <input v-model="loginForm.email" type="email" class="form-control col-md-6" id="login-email" aria-describedby="emailHelp" placeholder="Enter email">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="login-password">パスワード</label>
          <input v-model="loginForm.password" type="password" class="form-control col-md-6" id="login-password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">ログイン</button>
      </form>
    </div>
    <div class="panel mt-5 mx-left" v-show="tab === 2">
      <form class="form" @submit.prevent="register">
        <div class="form-group">
          <label for="username">名前</label>
          <input v-model="registerForm.name" type="text" class="form-control col-md-6" id="username" aria-describedby="emailHelp" placeholder="名前">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="email">メールアドレス</label>
          <input v-model="registerForm.email" type="email" class="form-control col-md-6" id="email" aria-describedby="emailHelp" placeholder="Enter email">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="password">パスワード</label>
          <input v-model="registerForm.password" type="password" class="form-control col-md-6" id="password" placeholder="Password">
        </div>
        <div class="form-group">
          <label for="password-confirmation">パスワード確認</label>
          <input v-model="registerForm.password_confirmation" type="password" class="form-control col-md-6" id="password-confirmation" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  data () {
    return {
      tab: 1,
      loginForm: {
        email: '',
        password: ''
      },
      registerForm: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
    }
  },
  computed: mapState({
    apiStatus: state => state.auth.apiStatus,
    loginErrors: state => state.auth.loginErrorsMessages,
    registerErrors: state => state.auth.registerErrorMessages
  }),
  methods: {
    async login () {
      // authストアのloginアクションを呼び出す
      await this.$store.dispatch('auth/login', this.loginForm)

      if (this.apiStatus) {
        // トップページに移動する
        this.$router.push('/')
      }
    },
    async register () {
      // authストアのresigterアクションを呼び出す
      await this.$store.dispatch('auth/register', this.registerForm)

      // トップページに移動する
      this.$router.push('/')
    },
    clearError () {
      this.$store.commit('auth/setLoginErrorMessages', null)
      this.$store.commit('auth/setRegisterErrorMessages', null)
    }
  }
}
</script>
