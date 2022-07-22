<template>
  <div>
    <!-- ======= Header ======= -->
    <AdminHeader></AdminHeader>
    <!-- End Header -->
    
  <div class="row mt-2">
    <div class="col">
      <h2>Services</h2> 
    </div>
    <div class="col d-flex justify-content-end">
      <button type="button" class="btn btn-success" data-toggle="modal" v-on:click="createNewService()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg>
      </button>
    </div>
  </div> 
  <div class="row mt-2">
    <div class="col">
      <div v-if="errors_exist" class="alert alert-danger" role="alert">
        <ul>
          <div v-for="error in errors" v-bind:key="error">
            <li>{{ error[0] }}</li>
          </div>
        </ul>
      </div>
      <div v-if="is_saved" class="alert alert-success" role="alert" v-text="message">
        
      </div>
    </div>
    <div class="col"></div>
  </div>     
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center">COMPANY</th>
        <th class="text-center">DESIGNATION</th>
        <th class="text-center">FROM</th>
        <th class="text-center">TO</th>
        <th class="text-center">CONTINUING?</th>
        <th class="text-center">TYPE</th>
        <th class="text-center">ACTION</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(service, index) in services.data" v-bind:key="index">
        <td class="text-center">{{ service.company_name }}</td>
        <td class="text-center">{{ service.designation }}</td>
        <td class="text-center">{{ service.from_date }}</td>
        <td class="text-center">{{ service.to_date }}</td>
        <td class="text-center">
          <p v-if="service.is_continuing==1">Yes</p>
          <p v-else>No</p>
        </td>
        <td class="text-center">
          <p v-if="service.type==0">Full-Time</p>
          <p v-if="service.type==1">Part-Time</p>
          <p v-if="service.type==2">Freelancing</p>
          <p v-if="service.type==3">Contructual</p>
        </td>
        <td class="text-center">
          <span class="btn btn-sm btn-primary" data-toggle="modal" v-on:click="getServiceById(service.id)">Edit</span>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="d-flex">
    <div class="mx-auto">
      <pagination v-model="page" :records="total" :per-page="per_page" @paginate="getUserWiseServices"/>
    </div>
  </div>
    <!-- ======= Footer ======= -->
    <AdminFooter></AdminFooter>
    <!-- End  Footer -->

    <!-- Update Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Service</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="modalHide()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            COMPANY: <input type="text" class="form-control" v-model="service_info.company_name"/>
            Image: <input type="file" class="form-control"  @change="onChange" ref="service"/>
            Website: <input type="text" class="form-control" v-model="service_info.company_website"/>
            Address: <input type="text" class="form-control" v-model="service_info.company_address"/>
            Contact: <input type="text" class="form-control" v-model="service_info.company_contact_info"/>
            Designation: <input type="text" class="form-control" v-model="service_info.designation"/>
            From: <input type="date" class="form-control" v-model="service_info.from_date"/>
            To: <input type="date" class="form-control" v-model="service_info.to_date"/>
            Continuing?: <select class="form-control" v-model="service_info.is_continuing">
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
            Type: <select class="form-control" v-model="service_info.type">
                          <option value="0">Full-Time</option>
                          <option value="1">Part-Time</option>
                          <option value="2">Freelancing</option>
                          <option value="3">Contructual</option>
                        </select>
            Description: <vue-editor v-model="service_info.job_description"></vue-editor>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="modalHide()">Close</button>
            <button type="button" class="btn btn-primary" v-on:click="updateService()">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade bd-example-modal-lg" id="createServiceModal" tabindex="-1" role="dialog" aria-labelledby="createServiceModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createServiceModalLabel">Create Service</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="modalHide()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            COMPANY: <input type="text" class="form-control" v-model="new_service_info.company_name"/>
            Image: <input type="file" class="form-control"  @change="onChange" ref="service"/>
            Website: <input type="text" class="form-control" v-model="new_service_info.company_website"/>
            Address: <input type="text" class="form-control" v-model="new_service_info.company_address"/>
            Contact: <input type="text" class="form-control" v-model="new_service_info.company_contact_info"/>
            Designation: <input type="text" class="form-control" v-model="new_service_info.designation"/>
            From: <input type="date" class="form-control" v-model="new_service_info.from_date"/>
            To: <input type="date" class="form-control" v-model="new_service_info.to_date"/>
            Continuing?: <select class="form-control" v-model="new_service_info.is_continuing">
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
            Type: <select class="form-control" v-model="new_service_info.type">
                          <option value="0">Full-Time</option>
                          <option value="1">Part-Time</option>
                          <option value="2">Freelancing</option>
                          <option value="3">Contructual</option>
                        </select>
            Description: <vue-editor v-model="new_service_info.job_description"></vue-editor>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="modalHide()">Close</button>
            <button type="button" class="btn btn-primary" v-on:click="saveNewService()">Create</button>
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
      services: {},
      service_info:{},
      new_service_info:{
        company_name: '',
        company_website: '',
        company_address: '',
        company_contact_info: '',
        designation: '',
        from_date: '',
        to_date: '',
        is_continuing: '',
        type: '',
        job_description: '',
      },
      service: null,
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
    document.title = 'Dashboard - Services'
    this.getUserWiseServices(this.page);
  },
  created(){
    
  },
  methods:{
    getUserWiseServices(page){
      this.$store.dispatch('getUserWiseServices', page).then((response) => {
        this.services = response.data
        this.total = response.data.total
        this.per_page = response.data.per_page
      })
    },
    getServiceById(service_id){
      this.$store.dispatch('getServiceById', service_id).then((response) => {
        this.service_info = response.data
        $("#exampleModal").modal('show');
      })
    },
    createNewService(){
      $("#createServiceModal").modal('show');
    },
    saveNewService() {
      console.log(this.new_service_info.company_name)
      let fd = new FormData();
      fd.append("_method", "POST")
      fd.append('company_name', this.new_service_info.company_name)
      fd.append('company_website', this.new_service_info.company_website)
      fd.append('company_address', this.new_service_info.company_address)
      fd.append('company_contact_info', this.new_service_info.company_contact_info)
      fd.append('designation', this.new_service_info.designation)
      fd.append('from_date', this.new_service_info.from_date)
      fd.append('to_date', this.new_service_info.to_date)
      fd.append('is_continuing', this.new_service_info.is_continuing)
      fd.append('type', this.new_service_info.type)
      fd.append('job_description', this.new_service_info.job_description)

      const postData = {
        id: this.new_service_info.id,
        form_data: fd
      };

      if(this.service !== null){
        fd.append('company_logo', this.service)
      }

      this.$store.dispatch('saveUserService', postData).then((response) => {
        this.is_saved = true;
        this.errors_exist = false;
        $("#createServiceModal").modal('hide');
        this.getUserWiseServices(this.page);
        this.message = response.data;

        window.setTimeout( () => {
          this.is_saved = false
        }, 3000)

        this.$refs.service.value=null;
      }).catch(error => {
        if (error.response.status == 422){
          $("#createServiceModal").modal('hide');
          this.$refs.service.value=null;

          this.errors_exist = true;
          this.is_saved = false;
          this.errors = error.response.data.errors;

          window.setTimeout( () => {
            this.errors_exist = false
          }, 5000)
        }
      })
    },
    updateService() {
      let fd = new FormData();
      fd.append("_method", "PUT")
      fd.append('company_name', this.service_info.company_name)
      fd.append('company_website', this.service_info.company_website)
      fd.append('company_address', this.service_info.company_address)
      fd.append('company_contact_info', this.service_info.company_contact_info)
      fd.append('designation', this.service_info.designation)
      fd.append('from_date', this.service_info.from_date)
      fd.append('to_date', this.service_info.to_date)
      fd.append('is_continuing', this.service_info.is_continuing)
      fd.append('type', this.service_info.type)
      fd.append('job_description', this.service_info.job_description)

      const postData = {
        id: this.service_info.id,
        form_data: fd
      };

      if(this.service !== null){
        fd.append('company_logo', this.service)
      }

      this.$store.dispatch('saveUserService', postData).then((response) => {
        this.is_saved = true;
        this.errors_exist = false;
        $("#exampleModal").modal('hide');
        this.getUserWiseServices(this.page);
        this.message = "Successfully Saved!";

        window.setTimeout( () => {
          this.is_saved = false
        }, 3000)

        this.$refs.service.value=null;
      }).catch(error => {
        if (error.response.status == 422){
          $("#exampleModal").modal('hide');
          this.$refs.service.value=null;

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
        this.service = e.target.files[0]
    },
    modalHide(){
      $("#exampleModal").modal('hide');
      $("#createServiceModal").modal('hide');
    }
  }
};
</script>
