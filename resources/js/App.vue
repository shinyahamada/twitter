<template>
  <div>
    <header class="sticky-top">
      <navbar />
    </header>
    <main>
      <div class="container">
        <RouterView />
      </div>
    </main>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue'
import { INTERNAL_SERVER_ERROR } from './util'

export default {
  components: {
    Navbar
  },
  computed: {
    errorCode () {
      return this.$store.state.error.code
    }
  },
  watch: {
    errorCode: {
      handler (val) {
        if (val === INTERNAL_SERVER_ERROR) {
          this.$router.push('/500')
        }
      },
      immediate: true
    },
    $route () {
      this.$store.commit('error/setCode', null)
    }
  }
}

</script>
