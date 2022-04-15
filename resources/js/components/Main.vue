<template>
  <div>
      <main id="main">
      <!-- ======= About Section ======= -->
      <About></About>
      <!-- End About Section -->

      <!-- ======= Testimonials Section ======= -->
      <Testimonial></Testimonial>
      <!-- End Testimonials Section -->

      <!-- ======= Services Section ======= -->
      <Services></Services>
      <!-- End Services Section -->

      <!-- ======= Counter Section ======= -->
      <!-- <Counter></Counter> -->
      <!-- End Counter Section -->

      <!-- ======= Portfolio Section ======= -->
      <Portfolio></Portfolio>
      <!-- End Portfolio Section -->

      <!-- ======= Blog Section ======= -->
      <Blog></Blog>
      <!-- End Blog Section -->

      <!-- ======= Contact Section ======= -->
      <Contact></Contact>
      <!-- End Contact Section -->
    </main>
  </div>
</template>

<script>
import About from './Main/About.vue';
import Services from './Main/Services.vue';
import Counter from './Main/Counter.vue';
import Portfolio from './Main/Portfolio.vue';
import Testimonial from './Main/Testimonial.vue';
import Blog from './Main/Blog.vue';
import Contact from './Main/Contact.vue';

export default {

  components: {
    'About': About,
    'Services': Services,
    'Counter': Counter,
    'Portfolio': Portfolio,
    'Testimonial': Testimonial,
    'Blog': Blog,
    'Contact': Contact,
  },
  mounted() {
    // console.log("Main Component mounted.");
  },

}
</script>

<style>

</style>