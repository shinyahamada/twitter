<template>
  <div class="">
    <div class="user_info mt-3" @click.self="toUserPage">
      <div class="media">
        <img :src="item.image" class="p-5 rounded-circle" alt="">
        <div class="media-body p-5">
          <h3 class="mt-0 mb-3">{{item.name}}</h3>
          {{item.profile}}
          <RouterLink v-if="user.id == this.$route.params['id']" class="navbar__brand" :to="{ name: 'user_edit', params: {id: user.id}}">
            <i class="fas fa-edit">編集</i>
          </RouterLink>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { OK } from '../util'

export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  computed: {
    user() {
      return this.$store.getters['auth/user']
    },
  },
  methods: {
    toUserPage() {
      console.log(this.item.id);
      this.$router.push({name: 'profile', params: { id: this.item.id }})
    }
  }
}

</script>
