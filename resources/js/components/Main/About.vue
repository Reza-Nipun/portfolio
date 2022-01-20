<template>
  <div>
      <section id="about" class="about-mf sect-pt4 route">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="box-shadow-full">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-sm-6 col-md-5">
                        <div class="about-img">
                          <img
                            v-bind:src=profile_picture
                            class="img-fluid rounded b-shadow-a"
                            alt=""
                          />
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-7">
                        <div class="about-info">
                          <p v-if="this.name">
                            <span class="title-s">Name: </span>
                            <span>{{ this.name }}</span>
                          </p>
                          <p v-if="this.profile_title">
                            <span class="title-s">Profile: </span>
                            <span>{{ this.profile_title }}</span>
                          </p>
                          <p v-if="this.email">
                            <span class="title-s">Email: </span>
                            <span>{{ this.email }}</span>
                          </p>
                          <p v-if="this.phone_number">
                            <span class="title-s">Phone: </span>
                            <span>{{ this.phone_number }}</span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="about-me pt-4 pt-md-0" v-if="about_me">
                      <div class="title-box-2">
                        <h5 class="title-left">About me</h5>
                      </div>
                      <p class="lead" v-html="about_me"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="skill-mf">
                      <p class="title-s">Skill</p>
                      <div v-for="skill in skills" :key="skill.index">
                        <span>{{ skill.skill }}</span> - <span class="pull-right">{{ skill.score }}%</span>
                        <div class="progress">
                          <div
                            class="progress-bar"
                            role="progressbar"
                            v-bind:style="{ width: skill.score + '%' }"
                            aria-valuemin="0"
                            aria-valuemax="100"
                          ></div>
                        </div>
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
        name: null,
        profile_picture: null,
        profile_title: null,
        email: null,
        phone_number: null,
        about_me: null,
        skills: {},
      }
    },
    created(){
      if(this.user_name){
        axios.get('/api/user/'+this.user_name).then((response) => {
          
            this.user = response.data
            this.name = this.user.name
            this.profile_title = this.user.profile_title
            this.profile_picture = this.user.profile_picture
            this.email = this.user.email
            this.phone_number = this.user.phone_number
            this.about_me = this.user.about_me
          
            // Getting Tags
            this.getSkills()
        })
      }

    },
    methods:{
      getSkills(){

        axios.get('/api/skills/'+this.user.id).then((response) => {
          
            this.skills = response.data

        })

      }
    },
}
</script>

<style>

</style>