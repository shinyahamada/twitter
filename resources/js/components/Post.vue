<template>
  <div class="">
    <h2>投稿者情報</h2>
    <p>{{item.content}}</p>
    <div class="delete__button">
      <button type="button" name="button" @click="deletePost">削除</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  methods: {
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
