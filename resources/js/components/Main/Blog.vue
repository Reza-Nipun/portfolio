<template>
  <div>
      <section id="blog" class="blog-mf sect-pt4 route" v-if="$store.state.blogs.length">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="title-box text-center">
                <h3 class="title-a">Blog {{ $store.state.blogs.length }}</h3>
                <p class="subtitle-a">
                  <!-- Lorem ipsum, dolor sit amet consectetur adipisicing elit. -->
                </p>
                <div class="line-mf"></div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-4" v-for="(blog, index) in $store.state.blogs" :key="index">
              <div class="card card-blog">
                <div class="card-img">
                  <a v-bind:href=blog.blog_url target="_blank"
                    ><img v-bind:src=blog.blog_image alt="" class="img-fluid" id="blog_img"
                  /></a>
                </div>
                <div class="card-body">
                  <div class="card-category-box">
                    <div class="card-category">
                      <!-- <h6 class="category">Web Design</h6> -->
                    </div>
                  </div>
                  <h3 class="card-title">
                    <a v-bind:href=blog.blog_url target="_blank" v-if="blog.title">{{ blog.title }}</a>
                    <span class="bi bi-link-45deg"></span>
                  </h3>
                  <p class="card-description" v-if="blog.description">
                    {{ blog.description }}
                  </p>
                </div>
                <!-- <div class="card-footer">
                  <div class="post-author">
                    <a href="#">
                      <img
                        src="assets/img/testimonial-2.jpg"
                        alt=""
                        class="avatar rounded-circle"
                      />
                      <span class="author">Morgan Freeman</span>
                    </a>
                  </div>
                  <div class="post-date">
                    <span class="bi bi-clock"></span> 10 min
                  </div>
                </div> -->
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
      blogs: {},
    }
  },
  created(){
    if(this.user_name){
      axios.get('/user/'+this.user_name).then((response) => {
          this.user = response.data

          // Getting Blogs
          this.getBlogs()
      })
    }

  },
  methods:{
    getBlogs(){

      axios.get('/blogs/'+this.user.id).then((response) => {
        
          this.blogs = response.data

      })

    },
  },
}
</script>

<style>
  #blog_img{
    width: 360px; 
    height: 250px;
  }
</style>