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
import { mapActions } from 'vuex';


export default {
  components: {
    'Header': Header,
    'Hero': Hero,
    'Main': Main,
    'Footer': Footer,
  },
  computed: {
    userId() {
      return this.$store.getters["getUserId"]
    }
  },
  mounted() {
    // console.log("Component mounted.");
    this.getUserInfo();
  },
  created(){
    
  },
  methods:{
    ...mapActions(["getUserInfo"]),
  }
};
</script>
