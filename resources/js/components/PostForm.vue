<template>
  <div class="post-form" v-show="value">
    <h2>投稿</h2>
    <form class="form" @submit.prevent="submit">
        <textarea v-model="content" name="content" rows="8" cols="80" placeholder="投稿する"></textarea>
        <div class="form__button">
          <button type="submit">投稿</button>
        </div>
    </form>
  </div>
</template>

<script>
  export default {
    props: {
      value: {
        type: Boolean,
        required: true
      }
    },
    data () {
      return {
        content: null
      }
    },
    methods: {
      reload() {
        this.$router.go({path: this.$router.currentRoute.path, force: true});
      },
      async submit() {
        const formData = new FormData();
        formData.append('content', this.content)
        const response = await axios.post('/api/post', formData)
        this.$emit('input', false)

        // debug
        console.log(response);

        if (response.status == 200) {
          this.reload();
        }
      }
    }
  }
</script>
