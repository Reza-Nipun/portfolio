<template>
  <div>
    <!-- ======= Header ======= -->
    <Header></Header>
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <Hero></Hero>
    <!-- End Hero Section -->

    <!-- End #main -->
    <Main></Main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <Footer></Footer>
    <!-- End  Footer -->
  </div>
</template>

<script>

import Header from './Header.vue';
import Hero from './Hero.vue';
import Main from './Main.vue';
import Footer from './Footer.vue';


export default {
  components: {
    'Header': Header,
    'Hero': Hero,
    'Main': Main,
    'Footer': Footer,
  },
  mounted() {
    // console.log("Component mounted.");
    
  },
  created(){
    this.$store.commit('getUserInfo');
  }
};
</script>
