<template>

      <line></line>
</template>

<script>
  import Vue from 'vue';
  import Line from './line'

  export default new Vue({
    name: 'line-report',
    data () {
      return {
        msg: 'Welcome to Your Vue.js App'
      }
    },
    components: {
    'line': Line,
    }

  });
</script>
