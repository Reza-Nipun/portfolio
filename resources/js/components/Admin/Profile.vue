<template>
  <div>
    <!-- ======= Header ======= -->
    <AdminHeader></AdminHeader>
    <!-- End Header -->
    <div class="mt-2"> 
      <div class="row">
        <div class="col">
          <div v-if="errors_exist" class="alert alert-danger" role="alert">
            <ul>
              <div v-for="error in errors" v-bind:key="error">
                <li>{{ error[0] }}</li>
              </div>
            </ul>
          </div>
          <div v-if="is_saved" class="alert alert-success" role="alert">
            Successfully Saved!
          </div>
        </div>
        <div class="col"></div>
      </div>
      <div class="row">
        <div class="col">
          <label>Email</label>
          <input class="form-control" readonly="readonly" placeholder="Enter email" v-model="user.email">
        </div>
        <div class="col">
          <label>Username</label>
          <input class="form-control" readonly="readonly" placeholder="Enter User Name" v-model="user.user_name">
        </div>
      </div>
      <div class="row mt-3">
        <div class="col">
          <label>About</label>
          <vue-editor v-model="user.about_me"></vue-editor>
        </div>
        <div class="col">
          <label>Name</label>
          <input type="text" class="form-control" placeholder="Full Name" v-model="user.name">
        </div>
      </div>
      <div class="row mt-3">
        <div class="col">
          <label>Phone Number</label>
          <input type="text" class="form-control" placeholder="Phone Number" v-model="user.phone_number">
        </div>
        <div class="col">
          <label>Address</label>
          <input type="text" class="form-control" placeholder="Address" v-model="user.address">
        </div>
      </div>
      <div class="row mt-3">
        <div class="col">
          <label>Resume</label>
          <input type="file" class="form-control" @change="onChange" ref="resume">
        </div>
        <div class="col">
          <label>Profile Picture</label>
          <input type="file" class="form-control" @change="onChangeProfilePic" ref="profilePic">
        </div>
      </div>
      <div class="row mt-3">
        <div class="col">
          <button class="btn btn-primary" v-on:click="saveUserProfile()">SAVE</button>
        </div>
      </div>
    </div>

    <!-- ======= Footer ======= -->
    <AdminFooter></AdminFooter>
    <!-- End  Footer -->
  </div>
</template>

<script>

import AdminHeader from './AdminHeader.vue';
import AdminFooter from './AdminFooter.vue';

export default {
  data() {
    return {
      user: {},
      resume: null,
      profile_pic: null,
      message: "",
      errors: "",
      is_saved: false,
      errors_exist: false,
    }
  },
  components: {
    'AdminHeader': AdminHeader,
    'AdminFooter': AdminFooter,
  },
  computed: {
    
  },
  mounted() {
    this.$store.dispatch('getUserProfile', this.data).then((response) => {
        this.user = response.data
    })
  },
  created(){
    
  },
  methods:{
    onChange(e){
        this.resume = e.target.files[0]
    },
    onChangeProfilePic(e){
        this.profile_pic = e.target.files[0]
    },
    saveUserProfile() {
      let fd = new FormData();
      fd.append('name', this.user.name)
      fd.append('phone_number', this.user.phone_number)
      fd.append('address', this.user.address)
      fd.append('profile_title', this.user.profile_title)
      fd.append('about_me', this.user.about_me)

      if(this.resume !== null){
        fd.append('resume', this.resume)
      }

      if(this.profile_pic !== null){
        fd.append('profile_pic', this.profile_pic)
      }

      this.$store.dispatch('saveUserProfile', fd).then((response) => {
        this.is_saved = true;
        this.errors_exist = false;

        this.user = response.data;
        this.message = "Successfully Saved!";

        window.setTimeout( () => {
          this.is_saved = false
        }, 3000)

        this.$refs.resume.value=null;
        this.$refs.profilePic.value=null;
      }).catch(error => {
        if (error.response.status == 422){
          this.errors_exist = true;
          this.is_saved = false;
          this.errors = error.response.data.errors;

          window.setTimeout( () => {
            this.errors_exist = false
          }, 5000)
        }
      })
    }
  }
};
</script>
