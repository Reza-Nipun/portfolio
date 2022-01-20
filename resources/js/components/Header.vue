<template>
  <div>
      <header id="header" class="fixed-top header-scrolled">
      <div class="container d-flex align-items-center justify-content-between">
      <div><a href="/" target="_blank"><h1 class="logo text-white">PortFolio</h1><sub class="text-white">TechExpertsBD</sub></a></div>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
          <ul>
            <li><a class="nav-link scrollto active" href="#home" v-on:click="removehash()">Home</a></li>
            <li><a class="nav-link scrollto" href="#about" v-on:click="removehash()">About</a></li>
            <li><a class="nav-link scrollto" href="#certifications" v-on:click="removehash()">Certifications</a></li>
            <li><a class="nav-link scrollto" href="#services" v-on:click="removehash()">Services</a></li>
            <li><a class="nav-link scrollto" href="#work" v-on:click="removehash()">Portfolio</a></li>
            <li><a class="nav-link scrollto" href="#blog" v-on:click="removehash()">Blog</a></li>
            <!-- <li class="dropdown">
              <a href="#"
                ><span>Drop Down</span> <i class="bi bi-chevron-down"></i
              ></a>
              <ul>
                <li><a href="#">Drop Down 1</a></li>
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
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->
      </div>
    </header>
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