<template>
  <div class="">
    <div v-if="isLogin">
      <posts
        class="posts mt-5"
        v-for="post in posts"
        :key="post.id"
        :item="post"
      />
    </div>
    <div v-else>
      <h3>ログイン後投稿を見ることができます</h3>
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
  methods: {
    async fetchPosts () {
      const response = await axios.get('api/post')

      console.log(response);

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
