<template>
  <div>
    <header id="header" class="fixed-top header-scrolled">
      <div class="container d-flex align-items-center justify-content-between">
        <div>
          <a href="/"
            ><h1 class="logo text-white">PortFolio</h1>
            <sub class="text-white">TechExpertsBD</sub></a
          >
        </div>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
          <ul>
            <li>
              <a
                class="nav-link scrollto"
                href="#home"
                v-on:click="removehash()"
                >Register</a
              >
            </li>
            <li>
              <router-link class="nav-link scrollto" to="/login"
                >Login<i class="bi bi-lock"></i
              ></router-link>
            </li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->
      </div>
    </header>
    <section
      id="contact"
      class="paralax-mf footer-paralax bg-image sect-mt2 route"
      style="background-image: url(assets/img/overlay-bg.jpg); height: 100vh;"
    >
      <div class="overlay-mf"></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="contact-mf">
              <div id="contact" class="box-shadow-full">
                <div class="row d-flex justify-content-center">
                  <div class="col-md-6">
                    <div class="title-box-2">
                      <h5 class="title-left">Login</h5>
                    </div>
                    <div>
                      <form
                        action="forms/contact.php"
                        method="post"
                        role="form"
                        class="php-email-form"
                      >
                        <div class="col-md-12 text-center my-3">
                          <div class="loading" v-if="loading == true">Loading</div>
                          <div class="error-message" v-if="error != ''"> {{ error }}</div>
                          <div class="sent-message" v-if="success_msg != ''">{{ success_msg }}</div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input
                                type="email"
                                class="form-control"
                                name="email"
                                id="email"
                                v-model="data.email"
                                placeholder="Email Address"
                                required
                              />
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input
                                type="password"
                                name="name"
                                class="form-control"
                                id="name"
                                v-model="data.password"
                                placeholder="Password"
                                required
                              />
                            </div>
                          </div>

                          <div class="col-md-12">
                            <a href="" class="text-danger">
                              Forgot Password?
                            </a>
                          </div>
                          <div class="col-md-12 text-center">
                            <span class="btn btn-lg btn-primary" v-on:click="login()"> Login </span>
                            <a type="submit" class="btn btn-lg btn-secondary">
                              Register
                            </a>
                          </div>
                        </div>
                      </form>
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
  data() {
    return {
      data: {
        email: '',
        password: '',
      },
      success_msg: '',
      error: '',
      loading: false,
    }
  },
  methods: {
    async login() {
      if(this.data.email == '' || this.data.password == ''){
        this.error = 'Please enter Email Address & Password!';
      }else{
        this.loading = true;

        this.$store.dispatch('login', this.data).then((response) => {
            if(response.data.error_message){
              this.error = response.data.error_message
              this.loading = false;
            }else{
              console.log(response.data)
              this.error = ''
              this.loading = false;

              if(response.data.token){
                // save the token
                localStorage.setItem(
                  'portfolio_token',
                  response.data.token
                )

                this.$store.dispatch('setToken', response.data.token)

                window.location.replace('/dashboard/home')
              }
            }
        })
      }
    },
  }
}
</script>
