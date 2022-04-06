<template>
  <div>
    <!-- ======= Header ======= -->
    <AdminHeader></AdminHeader>
    <!-- End Header -->
    <div class="mt-5"> 
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
          <textarea class="form-control" placeholder="About You" v-model="user.about_me"></textarea>
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
          <input type="file" class="form-control" @change="onChange">
        </div>
        <div class="col">
          
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
    saveUserProfile() {
      let fd = new FormData();
      fd.append('name', this.user.name)
      fd.append('phone_number', this.user.phone_number)
      fd.append('address', this.user.address)
      fd.append('profile_title', this.user.profile_title)
      fd.append('about_me', this.user.about_me)
      fd.append('resume', this.resume)
      

      this.$store.dispatch('saveUserProfile', fd).then((response) => {
        this.user = response.data
        console.log(response.data)
      }).catch(err=>console.log(err))
    }
  }
};
</script>
