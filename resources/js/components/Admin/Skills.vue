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
          <span class="btn btn-sm btn-primary" data-toggle="modal" v-on:click="getSkillById(skill.id)">Edit</span>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Skill</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="modalHide()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Skill: <input type="text" class="form-control" name="tag" v-model="skill_info.skill"/>
            Score: <input type="text" class="form-control" name="score" v-model="skill_info.score"/>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="modalHide()">Close</button>
            <button type="button" class="btn btn-primary" v-on:click="updateSkill()">Save changes</button>
          </div>
        </div>
      </div>
    </div>

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
      skill_info:{},
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
      })
    },
    getSkillById(skill_id){
      this.$store.dispatch('getSkillById', skill_id).then((response) => {
        this.skill_info = response.data
        $("#exampleModal").modal('show');
      })
    },
    updateSkill(){
      let id = this.skill_info.id
      let skill_info = this.skill_info
      
      this.$store.dispatch('updateSkill', {id, skill_info}).then((response) => {
        this.skill_info = {}
        $("#exampleModal").modal('hide');
        this.getUserSkills(this.page);
      })
    },
    modalHide(){
      $("#exampleModal").modal('hide');
    }
  }
};
</script>
