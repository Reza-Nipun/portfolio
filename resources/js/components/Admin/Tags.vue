<template>
  <div>
    <!-- ======= Header ======= -->
    <AdminHeader></AdminHeader>
    <!-- End Header -->
    
  <h2>Tags</h2>       
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center">TAG</th>
        <th class="text-center">ACTION</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(tag, index) in tags.data" v-bind:key="index">
        <td class="text-center">{{ tag.tag }}</td>
        <td class="text-center">
          <span class="btn btn-sm btn-primary" data-toggle="modal" v-on:click="getTagById(tag.id)">Edit</span>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="d-flex">
    <div class="mx-auto">
      <pagination v-model="page" :records="total" :per-page="per_page" @paginate="getUserTags"/>
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
            <h5 class="modal-title" id="exampleModalLabel">Update Tag</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="modalHide()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control" name="tag" v-model="tag_info.tag"/>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="modalHide()">Close</button>
            <button type="button" class="btn btn-primary" v-on:click="updateTag()">Save changes</button>
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
      tags: {},
      tag_info:{}
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
    document.title = 'Dashboard - Tags'
    this.getUserTags(this.page);
  },
  created(){
    
  },
  methods:{
    getUserTags(page){
      this.$store.dispatch('getUserWiseTags', page).then((response) => {
        this.tags = response.data
        this.total = response.data.total
        this.per_page = response.data.per_page
      })
    },
    getTagById(tag_id){
      this.$store.dispatch('getTagById', tag_id).then((response) => {
        this.tag_info = response.data
        $("#exampleModal").modal('show');
      })
    },
    updateTag(){
      let id = this.tag_info.id
      let tag_info = this.tag_info
      
      this.$store.dispatch('updateTag', {id, tag_info}).then((response) => {
        this.tag_info = {}
        $("#exampleModal").modal('hide');
        this.getUserTags(this.page);
      })
    },
    modalHide(){
      $("#exampleModal").modal('hide');
    }
  }
};
</script>
