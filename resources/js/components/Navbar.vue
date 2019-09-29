<template>
  <div class="">
    <nav class="navbar bg-transparent">
      <RouterLink class="navbar__brand" to="/">
        <i class="fas fa-crow"> twitter clone</i>
      </RouterLink>
      <div class="navbar__menu">
        <div v-if="isLogin" class="navbar__item">
          <a href="javascript:void(0)" class="ml-3" @click="showForm = ! showForm">
            <i class="fas fa-comment-dots">新規投稿</i>
          </a>
          <router-link class="button button--link ml-3" :to="{ name: 'profile', params: { id: user.id}}">
            マイページ
          </router-link>
          <PostForm v-model="showForm" />
          <a href="javascript:void(0)" @click="logout" class="ml-3">
            <i class="fas fa-sign-out-alt">ログアウト</i>
          </a>
        </div>
        <div v-else class="navbar__item">
          <RouterLink class="button button--link" to="/login">
            <i class="fas fa-sign-in-alt">ログインページへ</i>
          </RouterLink>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>

import PostForm from './PostForm.vue'

export default {
  components: {
    PostForm
  },
  data() {
    return {
      showForm: false
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
    user () {
      return this.$store.getters['auth/user']
    }
  },
  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout')

      this.$router.push('/login')
    }
  }
}

</script>
