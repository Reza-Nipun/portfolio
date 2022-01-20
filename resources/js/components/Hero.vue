<template>
  <div>
      <div
      id="home"
      class="hero route bg-image"
      v-bind:style="{ backgroundImage: 'url(' + cover_photo + ')' }"
    >
      <div class="overlay-itro"></div>
      <div class="hero-content display-table">
        <div class="table-cell">
          <div class="container">
            <!--<p class="display-6 color-d">Hello, world!</p>-->
            <h1 class="hero-title mb-4" v-if="this.name">I am {{ this.name }}</h1>
            <div class="row">
              <div class="col-sm col-md col-lg">
                <p class="hero-subtitle">
                  <span class="element"></span>
                </p>
              </div>
            </div>
            <div class="row" v-if="user.resume">
              <div class="col-sm col-md col-lg">
                <p class="hero-subtitle">
                  <a v-bind:href="user.resume" target="_blank" class="btn btn-success">GET MY RESUME <i class="bi bi-download"></i></a>
                </p>
              </div>
            </div>
            
            <!-- <p class="pt-3"><a class="btn btn-primary btn js-scroll px-4" href="#about" role="button">Learn More</a></p> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Typed from 'typed.js';
 
export default {
    metaInfo() {
        return {
            title: this.user.name ? this.user.name+' - Portfolio' : 'Portfolio Not Found!',
        };
    },
    data(){
      return {
        user_name: this.$route.params.user_name ?? null,
        user: {},
        name: null,
        cover_photo: null,
        tags: [],
        typed: ''
      }
    },
    created(){
      if(this.user_name){
        axios.get('/api/user/'+this.user_name).then((response) => {
            this.user = response.data
            this.name = this.user.name
            this.cover_photo = this.user.cover_photo

            // Getting Tags
            this.getTags()
        })
      }

    },
    methods:{
      getTags(){
        
        axios.get('/api/tags/'+this.user.id).then((response) => {
          
            var data = response.data

            var array_tags = []
            array_tags = data.map(item => item.tag)

            var options = {
              strings: array_tags,
              typeSpeed: 40,
              loop: true
            };

            new Typed('.element', options);
        })

      },
    },
}
</script>

<style>

</style>