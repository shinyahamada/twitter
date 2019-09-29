<template>
  <div class="post-form" v-show="value">
    <div id="overlay" class="text-center">
      <form class="form-group" @submit.prevent="submit">
        <textarea class="form-control mx-auto" id="modal" v-model="content" name="content" rows="8" cols="80" placeholder="投稿する"></textarea>
        <div class="form__button mt-3">
          <button type="submit" class="btn btn-primary">投稿</button>
          <button type="button" class="btn btn-secondary" @click="closeform">キャンセル</button>
        </div>
      </form>
    </div>
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
      },
      closeform() {
        this.$emit('input',false)
      }
    }
  }
</script>
