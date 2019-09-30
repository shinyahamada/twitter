<template id="">
  <div class="container-fluid">
    <user
      class="users mt-5"
      :item="profile_user"
    />

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
import User from '../components/User.vue'

export default {
  components: {
    'posts': Post,
    'user': User
  },
  computed: {
    user() {
      return this.$store.getters['auth/user']
    },
  },
  data() {
    return {
      posts: [],
      profile_user: null
    }
  },
  methods: {
    async fetchPosts () {
      const response = await axios.get('/api/post/'+ this.$route.params['id'])

      // debug
      console.log(response);
      if (response.status != OK) {
        console.log('error');
      } else {
        console.log('well done');
      }

      this.posts = response.data.data
    },
    async fetchUser() {
      const response = await axios.get('/api/user/'+this.$route.params['id'])

      if (response.status != OK) {
        console.log('error');
      } else {
        console.log('well done');
      }

      console.log(response);

      this.profile_user = response.data
    }
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchUser()
        await this.fetchPosts()
      },
      immediate: true
    }
  }
}

</script>
