<template>
  <div>
    <!-- ======= Header ======= -->
    <AdminHeader></AdminHeader>
    <!-- End Header -->
    
  <h2>Portfolios</h2>  
  <div class="row mt-2">
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
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center">PROJECT TITLE</th>
        <th class="text-center">DEVELOPED FOR</th>
        <th class="text-center">URL</th>
        <th class="text-center">STATUS</th>
        <th class="text-center">ACTION</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(portfolio, index) in portfolios.data" v-bind:key="index">
        <td class="text-center">{{ portfolio.project_title }}</td>
        <td class="text-center">{{ portfolio.developed_for }}</td>
        <td class="text-center">{{ portfolio.project_url }}</td>
        <td class="text-center">
          <p v-if="portfolio.status == 1">Yes</p>
          <p v-if="portfolio.status == 0">No</p>
        </td>
        <td class="text-center">
          <span class="btn btn-sm btn-primary" data-toggle="modal" v-on:click="getUserWisePortfolioById(portfolio.id)">Edit</span>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="d-flex">
    <div class="mx-auto">
      <pagination v-model="page" :records="total" :per-page="per_page" @paginate="getUserWisePortfolios"/>
    </div>
  </div>
    <!-- ======= Footer ======= -->
    <AdminFooter></AdminFooter>
    <!-- End  Footer -->

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Portfolio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="modalHide()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Title: <input type="text" class="form-control" v-model="portfolio_info.project_title"/>
            URL: <input type="text" class="form-control" name="social_link" v-model="portfolio_info.project_url"/>
            Developed For: <input type="text" class="form-control" v-model="portfolio_info.developed_for"/>
            Image: <input type="file" class="form-control"  @change="onChange" ref="project_image"/>
            Description: <vue-editor v-model="portfolio_info.description"></vue-editor>
            Status: <select class="form-control" v-model="portfolio_info.status">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="modalHide()">Close</button>
            <button type="button" class="btn btn-primary" v-on:click="updatePortfolio()">Save changes</button>
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
      portfolios: {},
      portfolio_info:{},
      project_image: null,
      message: "",
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
    // console.log("Component mounted.");
    document.title = 'Dashboard - Portfolios'
    this.getUserWisePortfolios(this.page);
  },
  created(){
    
  },
  methods:{
    getUserWisePortfolios(page){
      this.$store.dispatch('getUserWisePortfolios', page).then((response) => {
        this.portfolios = response.data
        this.total = response.data.total
        this.per_page = response.data.per_page
      })
    },
    getUserWisePortfolioById(portfolio_id){
      this.$store.dispatch('getUserWisePortfolioById', portfolio_id).then((response) => {
        this.portfolio_info = response.data
        $("#exampleModal").modal('show');
      })
    },
    updatePortfolio(){
      let fd = new FormData();
      fd.append("_method", "PUT")
      fd.append('project_title', this.portfolio_info.project_title)
      fd.append('description', this.portfolio_info.description)
      fd.append('developed_for', this.portfolio_info.developed_for)
      fd.append('project_url', this.portfolio_info.project_url)
      fd.append('status', this.portfolio_info.status)

      const postData = {
        id: this.portfolio_info.id,
        form_data: fd
      };

      if(this.project_image !== null){
        fd.append('project_image', this.project_image)
      }

      this.$store.dispatch('saveUserPortfolio', postData).then((response) => {
        this.is_saved = true;
        this.errors_exist = false;
        $("#exampleModal").modal('hide');
        this.getUserWisePortfolios(this.page);
        this.message = "Successfully Saved!";

        window.setTimeout( () => {
          this.is_saved = false
        }, 3000)

        this.$refs.project_image.value=null;
      }).catch(error => {
        if (error.response.status == 422){
          $("#exampleModal").modal('hide');
          this.$refs.project_image.value=null;

          this.errors_exist = true;
          this.is_saved = false;
          this.errors = error.response.data.errors;

          window.setTimeout( () => {
            this.errors_exist = false
          }, 5000)
        }
      })
    },
    onChange(e){
        this.project_image = e.target.files[0]
    },
    modalHide(){
      $("#exampleModal").modal('hide');
    }
  }
};
</script>
