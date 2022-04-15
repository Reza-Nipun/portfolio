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
                            v-bind:src=$store.state.user_info.profile_picture
                            class="img-fluid rounded b-shadow-a"
                            alt=""
                          />
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-7">
                        <div class="about-info">
                          <p v-if="$store.state.user_info.name">
                            <span class="title-s">Name: </span>
                            <span>{{ $store.state.user_info.name }}</span>
                          </p>
                          <p v-if="$store.state.user_info.profile_title">
                            <span class="title-s">Profile: </span>
                            <span>{{ $store.state.user_info.profile_title }}</span>
                          </p>
                          <p v-if="$store.state.user_info.email">
                            <span class="title-s">Email: </span>
                            <span>{{ $store.state.user_info.email }}</span>
                          </p>
                          <p v-if="$store.state.user_info.phone_number">
                            <span class="title-s">Phone: </span>
                            <span>{{ $store.state.user_info.phone_number }}</span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="about-me pt-4 pt-md-0" v-if="$store.state.user_info.about_me">
                      <div class="title-box-2">
                        <h5 class="title-left">About me</h5>
                      </div>
                      <p class="lead" v-html="$store.state.user_info.about_me"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="skill-mf">
                      <p class="title-s">Skill</p>
                      <div v-for="skill in $store.state.skills" :key="skill.index">
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
import { mapActions } from 'vuex'

export default {
    created(){
       
    },
    methods:{
      
    },
}
</script>

<style>

</style>