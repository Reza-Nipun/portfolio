<template>
  <div>
    <!-- ======= Header ======= -->
    <Header></Header>
    <!-- End Header -->
  </div>
</template>

<script>

import Header from './Header.vue';

export default {
  components: {
    'Header': Header,
  },
  mounted() {
    console.log("Default Component mounted.");
  },
};
</script>

<style>

</style>
