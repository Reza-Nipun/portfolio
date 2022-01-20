<template>
  <div>
      <section id="work" class="portfolio-mf sect-pt4 route">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="title-box text-center">
                <h3 class="title-a">Portfolio</h3>
                <p class="subtitle-a">
                  <!-- Lorem ipsum, dolor sit amet consectetur adipisicing elit. -->
                </p>
                <div class="line-mf"></div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-4" v-for="portfolio in portfolios" :key="portfolio.index">
              <div class="work-box">
                <a
                  href="assets/img/work-1.jpg"
                  data-gallery="portfolioGallery"
                  class="portfolio-lightbox"
                >
                  <div class="work-img">
                    <img v-bind:src=portfolio.project_image alt="" class="img-fluid" id="portfolio_img" />
                  </div>
                </a>
                <div class="work-content">
                  <div class="row">
                    <div class="col-sm-11">
                      <h2 class="w-title" v-if="portfolio.project_title">{{ portfolio.project_title }}</h2>
                      <div class="w-more">
                        <span class="w-ctegory" v-if="portfolio.developed_for">{{ portfolio.developed_for }}</span>
                      </div>
                    </div>
                    <div class="col-sm-1" v-if="portfolio.project_url">
                      <div class="w-like">
                        <a v-bind:href=portfolio.project_url target="_blank">
                          <span class="bi bi-link-45deg"></span
                        ></a>
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
      user_name: this.$route.params.user_name ?? null,
      user: {},
      portfolios: {},
    }
  },
  created(){
    if(this.user_name){
      axios.get('/api/user/'+this.user_name).then((response) => {
          this.user = response.data

          // Getting Portfolios
          this.getPortfolios()
      })
    }

  },
  methods:{
    getPortfolios(){

      axios.get('/api/portfolios/'+this.user.id).then((response) => {
        
          this.portfolios = response.data

      })

    },
  },
}
</script>

<style>
  #portfolio_img {
    width: 360px; 
    height: 250px;
  }
</style>