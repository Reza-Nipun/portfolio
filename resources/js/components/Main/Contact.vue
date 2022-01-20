<template>
  <div>
      <section
        id="contact"
        class="paralax-mf footer-paralax bg-image sect-mt4 route"
        style="background-image: url(assets/img/overlay-bg.jpg)"
      >
        <div class="overlay-mf"></div>
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="contact-mf">
                <div id="contact" class="box-shadow-full">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="title-box-2">
                        <h5 class="title-left">Send Message</h5>
                      </div>
                      <div>
                        <form
                          action="forms/contact.php"
                          method="post"
                          role="form"
                          class="php-email-form"
                        >
                          <div class="row">
                            <div class="col-md-12 mb-3">
                              <div class="form-group">
                                <input
                                  type="text"
                                  name="name"
                                  class="form-control"
                                  id="name"
                                  placeholder="Your Name"
                                  required
                                />
                              </div>
                            </div>
                            <div class="col-md-12 mb-3">
                              <div class="form-group">
                                <input
                                  type="email"
                                  class="form-control"
                                  name="email"
                                  id="email"
                                  placeholder="Your Email"
                                  required
                                />
                              </div>
                            </div>
                            <div class="col-md-12 mb-3">
                              <div class="form-group">
                                <input
                                  type="text"
                                  class="form-control"
                                  name="subject"
                                  id="subject"
                                  placeholder="Subject"
                                  required
                                />
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <textarea
                                  class="form-control"
                                  name="message"
                                  rows="5"
                                  placeholder="Message"
                                  required
                                ></textarea>
                              </div>
                            </div>
                            <div class="col-md-12 text-center my-3">
                              <div class="loading">Loading</div>
                              <div class="error-message"></div>
                              <div class="sent-message">
                                Your message has been sent. Thank you!
                              </div>
                            </div>
                            <div class="col-md-12 text-center">
                              <button
                                type="submit"
                                class="button button-a button-big button-rouded"
                              >
                                Send Message
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="title-box-2 pt-4 pt-md-0">
                        <h5 class="title-left">Get in Touch</h5>
                      </div>
                      <div class="more-info">
                        <p class="lead">
                          Require to contact me? <br />
                          Please consider the Send-Message form. <br />
                          Besides, you can reach me in below contact details.
                        </p>
                        <ul class="list-ico">
                          <li v-if="user.address">
                            <span class="bi bi-geo-alt"></span> 
                            {{ this.user.address }}
                          </li>
                          <li v-if="user.phone_number">
                            <span class="bi bi-phone"></span> {{ this.user.phone_number }}
                          </li>
                          <li v-if="user.email">
                            <span class="bi bi-envelope"></span>
                            {{ this.user.email }}
                          </li>
                        </ul>
                      </div>
                      <div class="socials">
                        <ul>
                          <li v-for="link in links" :key="link.index">
                            <a v-bind:href="link.url_link" target="_blank">
                              <span class="ico-circle">
                                <i v-if="link.link_type == 0" class="bi bi-stack-overflow"></i>
                                <i v-if="link.link_type == 1" class="bi bi-linkedin"></i>
                                <i v-if="link.link_type == 2" class="bi bi-github"></i>
                                <i v-if="link.link_type == 3" class="bi bi-git"></i>
                                <i v-if="link.link_type == 4" class="bi bi-google"></i>
                              </span>
                            </a>
                          </li>
                        </ul>
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
        links: {}
      }
    },
    created(){
      if(this.user_name){
        axios.get('/api/user/'+this.user_name).then((response) => {
          
            this.user = response.data
          
            this.getLinks()
        })
      }

    },
    methods:{
      getLinks(){
        axios.get('/api/links/'+this.user.id).then((response) => {
            
            this.links = response.data

        })
      }
    }
}
</script>

<style>

</style>