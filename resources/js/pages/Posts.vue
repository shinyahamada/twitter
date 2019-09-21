<template>
  <div class="">
    <h1>Post page</h1>
    <div v-if="isLogin">
      <h1>以下が投稿です</h1>
      <posts
        class="posts"
        v-for="post in posts"
        :key="post.id"
        :item="post"
      />
    </div>
    <div v-else>
      <h1>ログイン後投稿を見ることができます</h1>
    </div>
  </div>
</template>

<script>
import { OK } from '../util'
import Post from '../components/Post.vue'

export default {
  components: {
    'posts': Post
  },
  data() {
    return {
      posts: []
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    }
  },
  // ここでapi叩いてposts取ってくる
  methods: {
    async fetchPosts () {
      const response = await axios.get('api/post')

      if (response.status != OK) {
        this.$store.commit('error/setCode', response.status)
        // debug
        console.log(response);
        return false
      } else {
        console.log('well done');
      }
      this.posts = response.data.data
    }
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchPosts()
      },
      immediate: true
    }
  }
}

</script>
