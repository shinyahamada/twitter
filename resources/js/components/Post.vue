<template>
  <div class="">
    <div class="card mb-3 mx-auto" style="max-width: 540px;">
      <div @click="callDetail" class="row no-gutters">
        <div class="col-md-2">
          <img :src="item.user.image" class="card-img rounded-circle pt-3" alt="">
        </div>
        <div class="col-md-10">
          <div class="card-body">
            <h5 class="card-title">{{ item.user.name}}</h5>
            <p class="card-text">{{ item.content }}</p>
            <p class="card-text"><small class="text-muted"></small></p>
            <div class="buttons">
                <i v-if="liked_by_user" @click.stop="unlike()" class="fas fa-heart">{{item.likes_count}}</i>
                <i v-else @click.stop="like()" class="fas fa-heart">like</i>
                <i @click.stop="deletePost" class="fas fa-trash-alt ml-2"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="post-detail" v-if="detailCalled">
      <detail
        :value=item
      />
    </div>
  </div>
</template>

<script>
import { OK } from '../util'
import Detail from './PostDetail.vue'


export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  components: {
    'detail': Detail
  },
  data() {
    return {
      detailCalled: false
    }
  },
  computed: {
    user() {
      return this.$store.getters['auth/user']
    },
    liked_by_user() {
      return this.item.liked_by_user
    },
  },
  methods: {
    async like() {
      const response = await axios.put('/api/post/'+this.item.id+'/like')

      // debug
      console.log(response);
      if (response.status != OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      if (this.item.id == response.data.id) {
        this.item.likes_count += 1
        this.item.liked_by_user = true
      }
      return;
    },
    async unlike () {
      const response = await axios.delete('/api/post/'+this.item.id+'/like')

      // debug
      console.log(response);

      if (response.status != OK) {
        this.$store.commit('erorr/setCode', response.status)
        return false
      }
      if (this.item.id == response.data.id) {
        this.item.likes_count -= 1
        this.item.liked_by_user = false
      }
      return;
    },
    callDetail() {
      this.detailCalled = true
      console.log(this.item);
    },
    reload() {
      this.$router.go({path: this.$router.currentRoute.path, force: true});
    },
    async deletePost() {
      const response = await axios.delete('/api/post/'+ this.item.id)
      if (response.status == 200) {
        this.reload();
      }
    }
  }
}

</script>
