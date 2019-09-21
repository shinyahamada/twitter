<template>
  <div class="">
    <h1>Post component</h1>
    <p>{{item.content}}</p>
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  }

}

</script>
