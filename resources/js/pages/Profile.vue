<template id="">
  <div class="container-fluid">
    <div class="user_info mt-3">
      <div class="media">
        <img :src="user.image" class="p-5 rounded-circle" alt="">
        <div class="media-body p-5">
          <h3 class="mt-0 mb-3">{{user.name}}</h3>
          {{user.profile}}
        </div>
      </div>
    </div>
    <posts
      class="posts mt-5"
      v-for="(post, index) in posts"
      :key="index"
      :item="post"
    />
  </div>
</template>

<script>
import { OK } from '../util'
import Post from '../components/Post.vue'

export default {
  components: {
    'posts': Post
  },
  computed: {
    user() {
      return this.$store.getters['auth/user']
    },
  },
  data() {
    return {
      posts: [],
    }
  },
  methods: {
    async fetchPosts () {
      const response = await axios.get('../api/post/'+ this.$route.params['id'])

      // debug
      console.log(response);
      if (response.status != OK) {
        console.log('error');
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
