<template>
  <div>
      <header id="header" class="fixed-top header-scrolled">
      <div class="container d-flex align-items-center justify-content-between">
      <div><a href="/"><h1 class="logo text-white">PortFolio</h1><sub class="text-white">TechExpertsBD</sub></a></div>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
          <ul>
            <li><a class="nav-link scrollto active" href="#home" v-on:click="removehash()">Home</a></li>
            <li><a class="nav-link scrollto" href="#about" v-on:click="removehash()">About</a></li>
            <!-- <li><a class="nav-link scrollto" href="#blog" v-on:click="removehash()">Blog</a></li> -->
            <!-- <li class="dropdown">
              <a href="#"
                ><span>Samples</span> <i class="bi bi-chevron-down"></i
              ></a>
              <ul>
                <li><router-link :to="'/nipun'" target="_blank">Sample 1</router-link></li>
                <li class="dropdown">
                  <a href="#"
                    ><span>Deep Drop Down</span>
                    <i class="bi bi-chevron-right"></i
                  ></a>
                  <ul>
                    <li><a href="#">Deep Drop Down 1</a></li>
                    <li><a href="#">Deep Drop Down 2</a></li>
                    <li><a href="#">Deep Drop Down 3</a></li>
                    <li><a href="#">Deep Drop Down 4</a></li>
                    <li><a href="#">Deep Drop Down 5</a></li>
                  </ul>
                </li>
                <li><a href="#">Drop Down 2</a></li>
                <li><a href="#">Drop Down 3</a></li>
                <li><a href="#">Drop Down 4</a></li>
              </ul>
            </li> -->
            <li><a class="nav-link scrollto" href="#contact" v-on:click="removehash()">Contact</a></li>
            <li><router-link :to="'/nipun'" target="_blank">Sample</router-link></li>
            <li><a class="nav-link scrollto" href="#contact" v-on:click="removehash()">Login<i class="bi bi-lock"></i></a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->
      </div>
    </header>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="/assets/img/portfolio-1.jpeg" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
          <img src="/assets/img/portfolio-2.png" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
          <img src="/assets/img/portfolio-3.jpg" class="d-block w-100" alt="">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  methods:{
    removehash(e){
      setTimeout(function(){
          history.replaceState("", document.title, window.location.pathname);
      }, 1);
    },
  }
}
</script>

<style>

</style>