<template>
  <div class="panel mt-5 mx-left">
    <form class="form" @submit.prevent="submit">
      <div class="form-group">
        <label for="username">名前</label>
        <input v-model="profile.name" type="text" class="form-control col-md-6" id="username" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="email">メールアドレス</label>
        <input v-model="profile.email" type="email" class="form-control col-md-6" id="email" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="password">パスワード</label>
        <input v-model="profile.password" type="password" class="form-control col-md-6" id="password">
      </div>
      <div class="form-group">
        <label for="profile">プロフィール文</label>
        <textarea v-model="profile.profile" class="form-control" id="profile" rows="3">{{ user.profile }}</textarea>
      </div>
      <!-- <div class="form-group">
        <label for="File">プロフィール画像</label>
        <input type="file" class="form-control-file" id="File" @change="onImageChange">
      </div> -->
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>


<script>
  export default {
    data() {
      return {
        profile: {
          name: '',
          email: '',
          password: '',
          profile: '',
        },
        // user_image: null
      }
    },
    computed: {
      user() {
        const user = this.$store.getters['auth/user']
        this.profile.name = user.name
        this.profile.email = user.email
        this.profile.password = user.password
        this.profile.profile = user.profile

        return user
      },
    },
    methods: {
      // onImageChange (e) {
      //   this.user_image = e.target.files[0];
      //   console.log(this.user_image);
      // },
      async submit() {

        // let formData = new FormData();
        // formData.append("profile", this.profile);
        // formData.append("image",this.user_image);
        // formData.append("_method","put");
        // let headers = {'Content-Type': 'multipart/form-data'};
        // console.log(...formData.entries());


        const response = await axios.post('/api/user/'+this.user.id+'/update', this.profile);
        // debug
        console.log(response);

        if (response.status == 200) {
          this.$router.push({ name: 'profile', params: {id : this.user.id} })
        }
      },
    }
  }
</script>
