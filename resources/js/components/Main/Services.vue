<template>
  <div>
      <section id="services" class="services-mf pt-5 route">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="title-box text-center">
                <h3 class="title-a">Services</h3>
                <p class="subtitle-a">
                  <!-- Lorem ipsum, dolor sit amet consectetur adipisicing elit. -->
                </p>
                <div class="line-mf"></div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-4" v-for="service in $store.state.services" :key="service.index">
              <div class="service-box">
                <div class="service-ico">
                  <span class="ico-circle">
                    <!-- <i class="bi bi-briefcase"></i> -->
                    <img v-bind:src=service.company_logo alt="Image" class="rounded-circle b-shadow-a" width="100" height="100">
                  </span>
                </div>
                <div class="service-content">
                  <h2 class="s-title">{{ service.company_name }}</h2>
                  <p class="s-description text-center">{{ service.designation }} <span v-if="service.type == 0">( Full-Time )</span><span v-if="service.type == 1">( Part-Time )</span><span v-if="service.type == 2">( Freelancing )</span><span v-if="service.type == 3">( Contructual )</span></p>
                  <div class="s-description text-center">
                    <p v-if="service.is_continuing == 1">{{ service.from_date }} to Present</p>
                    <p v-else>{{ service.from_date }} to {{ service.to_date }}</p>
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