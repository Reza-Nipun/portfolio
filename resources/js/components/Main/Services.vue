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
            <div class="col-md-4" v-for="service in services" :key="service.index">
              <div class="service-box">
                <div class="service-ico">
                  <span class="ico-circle">
                    <!-- <i class="bi bi-briefcase"></i> -->
                    <img v-bind:src=service.company_logo alt="Image" class="rounded-circle b-shadow-a" width="100" height="100">
                  </span>
                </div>
                <div class="service-content">
                  <h2 class="s-title">{{ service.company_name }}</h2>
                  <p class="s-description text-center">{{ service.designation }} <span v-if="getServiceType(service.type)">( {{ getServiceType(service.type) }} )</span></p>
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
        user_name: this.$route.params.user_name ?? null,
        user: {},
        services: {},
      }
    },
    created(){
      if(this.user_name){
        axios.get('/api/user/'+this.user_name).then((response) => {
            this.user = response.data

            // Getting Services
            this.getServices()
        })
      }

    },
    methods:{
      getServices(){

        axios.get('/api/services/'+this.user.id).then((response) => {
          
            this.services = response.data

        })

      },
      getServiceType(service_type){
        switch(service_type) {
          case 0:
            return 'Full-Time'
            break;
          case 1:
            return 'Part-Time'
            break;
          case 2:
            return 'Contructual'
            break;
        }
      }
    },
}
</script>

<style>

</style>