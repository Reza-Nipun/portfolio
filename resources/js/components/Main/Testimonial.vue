<template>
  <div>
      <section id="certifications" class="services-mf pt-5 route">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="title-box text-center">
                <h3 class="title-a">Certifications</h3>
                <p class="subtitle-a">
                  <!-- Lorem ipsum, dolor sit amet consectetur adipisicing elit. -->
                </p>
                <div class="line-mf"></div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-4" v-for="certificate in $store.state.certificates" :key="certificate.index">
              <div class="work-box">
                <!-- <a
                  href="assets/img/work-5.jpg"
                  data-gallery="portfolioGallery"
                  class="portfolio-lightbox"
                > -->
                  <div class="work-img">
                    <img v-bind:src=certificate.certificate_logo alt="Image" class="img-fluid">
                    <!-- <img src="assets/img/certificates/basis_android_nipun.jpg" alt="Image" class="img-fluid"> -->
                  </div>
                <!-- </a> -->
                <div class="work-content">
                  <div class="row">
                    <div class="col-sm-12">
                      <h2 class="w-title">{{ certificate.certificate_name }}</h2>
                      <div class="w-more">
                        <!-- <span class="w-ctegory">Organisation Name</span> -->
                        <p v-if="certificate.score_achievement">{{ certificate.score_achievement }}</p>
                        <p v-if="certificate.is_continuing == 1">{{ certificate.from_date }} to Present</p>
                        <p v-else>{{ certificate.from_date }} to {{ certificate.to_date }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  </div>
</template>

<script>
export default {
    data(){
      return {
        
      }
    },
    created(){
      
    },
    methods:{
      
    },
}
</script>

<style>

</style>