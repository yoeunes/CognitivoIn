<template>
  <div>
  <input type="date" v-model="start_date"/>
  <input type="date" v-model="end_date"/>
  <a class="block block-rounded block-link-shadow"  v-bind:href="'/reports/opportunities/we-paraguay/'+ start_date +'/' + end_date ">
    regenerate
  </a>

</div>
</template>
<script>


export default {
  data() {
    return {

      start_date:'',
      end_date:''



    };
  },



  methods: {


  },
  mounted: function mounted()
  {

  }

}
</script>
