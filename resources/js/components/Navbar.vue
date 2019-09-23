<template>
  <nav class="navbar">
    <RouterLink class="navbar__brand" to="/">
      Twitter Clone
    </RouterLink>
    <div class="navbar__menu">
      <div v-if="isLogin" class="navbar__item">
        <button class="button" @click="showForm = ! showForm ">
          <i class="icon ion-md-add"></i>
          tweet
        </button>
        <PostForm v-model="showForm" />
        <div v-if="isLogin" class="navbar__item">
          <router-link class="button button--link" :to="{ name: 'profile', params: { id: user.id}}">
            {{ user.name }}のページへ
          </router-link>
        </div>
        <button class="button button--link" @click="logout">Logout</button>
      </div>
      <div v-else class="navbar__item">
        <RouterLink class="button button--link" to="/login">
          Login / Register
        </RouterLink>
      </div>
    </div>
  </nav>
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
