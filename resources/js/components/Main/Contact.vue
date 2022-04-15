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
                                  v-model="data.name"
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
                                  v-model="data.email"
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
                                  v-model="data.subject"
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
                                  v-model="data.message"
                                  placeholder="Message"
                                  required
                                ></textarea>
                              </div>
                            </div>
                            <div class="col-md-12 text-center my-3">
                              <div class="loading" v-if="loading == true">Loading</div>
                              <div class="error-message" v-if="error != ''">{{ error }}</div>
                              <div class="sent-message" v-if="success_msg != ''">{{ success_msg }}</div>
                            </div>
                            <div class="col-md-12 text-center">
                              <span
                                class="button button-a button-big button-rouded"
                                v-on:click="sendMessage()"
                              >
                                Send Message
                              </span>
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
                          <li v-if="$store.state.user_info.address">
                            <span class="bi bi-geo-alt"></span> 
                            {{ $store.state.user_info.address }}
                          </li>
                          <li v-if="$store.state.user_info.phone_number">
                            <span class="bi bi-phone"></span> {{ $store.state.user_info.phone_number }}
                          </li>
                          <li v-if="$store.state.user_info.email">
                            <span class="bi bi-envelope"></span>
                            {{ $store.state.user_info.email }}
                          </li>
                        </ul>
                      </div>
                      <div class="socials">
                        <ul>
                          <li v-for="link in $store.state.links" :key="link.index">
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
        data: {
          user_id: '',
          name: '',
          email: '',
          subject: '',
          message: '',
        },
        success_msg: '',
        error: '',
        loading: false,
      }
    },
    mounted(){
      
    },
    created(){
    
    },
    methods:{
      sendMessage() {
        this.data.user_id = this.$store.getters["getUserId"];

        if(this.data.email === '' || this.data.name === ''){
          this.success_msg = ''
          this.error = 'Please enter your Name & Email Address!';
        }else if(this.data.user_id === '' || this.data.user_id === null){
          this.success_msg = ''
          this.error = 'Please User ID not found!';
        }else{
          this.loading = true;
          
          this.$store.dispatch('sendMessage', this.data).then((response) => {
              if(response.data.error_message){
                this.error = response.data.error_message
                this.success_msg = ''
                this.loading = false
              }else{
                this.error = ''
                this.success_msg = response.data.message
                this.loading = false

                this.data.name = ''
                this.data.email = ''
                this.data.subject = ''
                this.data.message = ''
              }
          })
        }

      }
    }
}
</script>

<style>

</style>