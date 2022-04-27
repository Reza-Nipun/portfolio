<template>
  <div>
    <!-- ======= Header ======= -->
    <AdminHeader></AdminHeader>
    <!-- End Header -->
    
  <h2>Skills</h2>       
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center">SKILL</th>
        <th class="text-center">SCORE</th>
        <th class="text-center">ACTION</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(skill, index) in skills.data" v-bind:key="index">
        <td class="text-center">{{ skill.skill }}</td>
        <td class="text-center">{{ skill.score }}</td>
        <td class="text-center">
          <a href="#" class="btn btn-sm btn-primary">Edit</a>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="d-flex">
    <div class="mx-auto">
      <pagination v-model="page" :records="total" :per-page="per_page" @paginate="getUserSkills"/>
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
  data(){
    return {
      page: 1,
      total: 0,
      per_page: 0,
      skills: {},
    }
  },
  components: {
    'AdminHeader': AdminHeader,
    'AdminFooter': AdminFooter,
  },
  computed: {
    
  },
  mounted() {
    // console.log("Component mounted.");
    document.title = 'Dashboard - Skills'
    this.getUserSkills(this.page);
  },
  created(){
    
  },
  methods:{
    getUserSkills(page){
      this.$store.dispatch('getUserWiseSkills', page).then((response) => {
        this.skills = response.data
        this.total = response.data.total
        this.per_page = response.data.per_page
        console.log(response.data)
      })
    }
  }
};
</script>
