<template>
  <div class="detail" v-show="value">
    <div id="overlay" class="">
        <div class="modal-lg" id="modal">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ value.user.name}}</h5>
              <button @click="closeform" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>{{value.content}}</p>
            </div>
            <div class="modal-footer">
              <!-- ここにいいね,時間等を設置 -->
              <div v-if="liked_by_user">
                <i @click.stop="unlike()" class="fas fa-heart">{{value.likes_count}}</i>
              </div>
              <div v-else>
                <i @click.stop="like()" class="fas fa-heart">like</i>
              </div>
              <button @click="closeform" type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
import { OK } from '../util'

  export default {
    props: {
      value: {
        type: Object,
        required: true
      }
    },
    data () {
      return {
        content: null
      }
    },
    computed: {
      liked_by_user() {
        return this.value.liked_by_user
      }
    },
    methods: {
      async like() {
        const response = await axios.put('/api/post/'+this.value.id+'/like')

        // debug
        console.log(response);
        if (response.status != OK) {
          this.$store.commit('error/setCode', response.status)
          return false
        }

        if (this.value.id == response.data.id) {
          this.value.likes_count += 1
          this.value.liked_by_user = true
        }
        return;
      },
      async unlike () {
        const response = await axios.delete('/api/post/'+this.value.id+'/like')

        // debug
        console.log(response);

        if (response.status != OK) {
          this.$store.commit('erorr/setCode', response.status)
          return false
        }
        if (this.value.id == response.data.id) {
          this.value.likes_count -= 1
          this.value.liked_by_user = false
        }
        return;
      },
      reload() {
        this.$router.go({path: this.$router.currentRoute.path, force: true});
      },
      closeform() {
        this.$parent.detailCalled = false;
      }
    }
  }
</script>
