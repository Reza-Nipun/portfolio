<template>
  <div>
    <!-- ======= Header ======= -->
    <AdminHeader></AdminHeader>
    <!-- End Header -->
    
  <h2>Social Links</h2>       
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center">URL</th>
        <th class="text-center">TYPE</th>
        <th class="text-center">ACTION</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(social_link, index) in social_links.data" v-bind:key="index">
        <td class="text-center">{{ social_link.url_link }}</td>
        <td class="text-center">
          <p v-if="social_link.link_type == 0">Stackoverflow</p>
          <p v-else-if="social_link.link_type == 1">Linkedin</p>
          <p v-else-if="social_link.link_type == 2">GitHub</p>
          <p v-else-if="social_link.link_type == 3">GitLab</p>
          <p v-else-if="social_link.link_type == 4">Other-Site</p>
        </td>
        <td class="text-center">
          <span class="btn btn-sm btn-primary" data-toggle="modal" v-on:click="getSocialLinkById(social_link.id)">Edit</span>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="d-flex">
    <div class="mx-auto">
      <pagination v-model="page" :records="total" :per-page="per_page" @paginate="getUserSocialLinks"/>
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
            <h5 class="modal-title" id="exampleModalLabel">Update Social Link</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="modalHide()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            URL: <input type="text" class="form-control" name="social_link" v-model="social_link_info.url_link"/>
            Type: <select class="form-control" v-model="social_link_info.link_type">
                    <option value="0">Stackoverflow</option>
                    <option value="1">Linkedin</option>
                    <option value="2">GitHub</option>
                    <option value="3">GitLab</option>
                    <option value="4">Other-Site</option>
                  </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="modalHide()">Close</button>
            <button type="button" class="btn btn-primary" v-on:click="updateSocialLink()">Save changes</button>
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
      social_links: {},
      social_link_info:{}
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
    document.title = 'Dashboard - Social Links'
    this.getUserSocialLinks(this.page);
  },
  created(){
    
  },
  methods:{
    getUserSocialLinks(page){
      this.$store.dispatch('getUserSocialLinks', page).then((response) => {
        this.social_links = response.data
        this.total = response.data.total
        this.per_page = response.data.per_page
      })
    },
    getSocialLinkById(link_id){
      this.$store.dispatch('getSocialLinkById', link_id).then((response) => {
        this.social_link_info = response.data
        $("#exampleModal").modal('show');
      })
    },
    updateSocialLink(){
      let id = this.social_link_info.id
      let social_link_info = this.social_link_info
      
      this.$store.dispatch('updateSocialLink', {id, social_link_info}).then((response) => {
        this.social_link_info = {}
        $("#exampleModal").modal('hide');
        this.getUserSocialLinks(this.page);
      })
    },
    modalHide(){
      $("#exampleModal").modal('hide');
    }
  }
};
</script>
