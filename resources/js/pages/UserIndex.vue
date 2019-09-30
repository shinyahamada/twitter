<template>
  <div class="">
    <user
      class="users mt-5"
      v-for="user in users"
      :key="user.id"
      :item="user"
     />

  </div>
</template>

<script>
import { OK } from '../util'
import User from '../components/User.vue'

export default {
  components: {
    'user': User
  },
  data() {
    return {
      users: []
    }
  },
  methods: {
    async fetchUsers () {
      const response = await axios.get('/api/user/index')
      console.log(response);

      if (response.status != OK) {
        this.$store.commit('error/setCode', response.status)
        // debug
        console.log(response);
        return false
      } else {
        console.log('well done');
      }

      this.users = response.data
    }
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchUsers()
      },
      immediate: true
    }
  }



}

</script>
