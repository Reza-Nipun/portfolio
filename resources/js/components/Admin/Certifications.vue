<template>
  <div>
    <!-- ======= Header ======= -->
    <AdminHeader></AdminHeader>
    <!-- End Header -->
    
  <h2>Certifications</h2>  
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
        <th class="text-center">CERTIFICATE</th>
        <th class="text-center">SCORE/ACHIEVEMENT</th>
        <th class="text-center">FROM</th>
        <th class="text-center">TO</th>
        <th class="text-center">CONTINUING?</th>
        <th class="text-center">ACTION</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(certificate, index) in certifications.data" v-bind:key="index">
        <td class="text-center">{{ certificate.certificate_name }}</td>
        <td class="text-center">{{ certificate.score_achievement }}</td>
        <td class="text-center">{{ certificate.from_date }}</td>
        <td class="text-center">{{ certificate.to_date }}</td>
        <td class="text-center">
          <p v-if="certificate.is_continuing==1">Yes</p>
          <p v-else>No</p>
        </td>
        <td class="text-center">
          <span class="btn btn-sm btn-primary" data-toggle="modal" v-on:click="getCertificateById(certificate.id)">Edit</span>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="d-flex">
    <div class="mx-auto">
      <pagination v-model="page" :records="total" :per-page="per_page" @paginate="getUserCertifications"/>
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
            <h5 class="modal-title" id="exampleModalLabel">Update Certificate</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="modalHide()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Certificate: <input type="text" class="form-control" v-model="certification_info.certificate_name"/>
            Image: <input type="file" class="form-control"  @change="onChange" ref="certificate"/>
            Score/Achievement: <input type="text" class="form-control" v-model="certification_info.score_achievement"/>
            From: <input type="date" class="form-control" v-model="certification_info.from_date"/>
            To: <input type="date" class="form-control" v-model="certification_info.to_date"/>
            Continuing?: <select class="form-control" v-model="certification_info.is_continuing">
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
            Description: <vue-editor v-model="certification_info.description"></vue-editor>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="modalHide()">Close</button>
            <button type="button" class="btn btn-primary" v-on:click="updateCertificate()">Save changes</button>
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
      certifications: {},
      certification_info:{},
      certificate: null,
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
    document.title = 'Dashboard - Skills'
    this.getUserCertifications(this.page);
  },
  created(){
    
  },
  methods:{
    getUserCertifications(page){
      this.$store.dispatch('getUserCertifications', page).then((response) => {
        this.certifications = response.data
        this.total = response.data.total
        this.per_page = response.data.per_page
      })
    },
    getCertificateById(skill_id){
      this.$store.dispatch('getCertificateById', skill_id).then((response) => {
        this.certification_info = response.data
        $("#exampleModal").modal('show');
      })
    },
    updateCertificate() {
      let fd = new FormData();
      fd.append("_method", "PUT")
      fd.append('certificate_name', this.certification_info.certificate_name)
      fd.append('score_achievement', this.certification_info.score_achievement)
      fd.append('from_date', this.certification_info.from_date)
      fd.append('to_date', this.certification_info.to_date)
      fd.append('is_continuing', this.certification_info.is_continuing)
      fd.append('description', this.certification_info.description)

      const postData = {
        id: this.certification_info.id,
        form_data: fd
      };

      if(this.certificate !== null){
        fd.append('certificate_logo', this.certificate)
      }

      this.$store.dispatch('saveUserCertificate', postData).then((response) => {
        this.is_saved = true;
        this.errors_exist = false;
        $("#exampleModal").modal('hide');
        this.getUserCertifications(this.page);
        this.message = "Successfully Saved!";

        window.setTimeout( () => {
          this.is_saved = false
        }, 3000)

        this.$refs.certificate.value=null;
      }).catch(error => {
        if (error.response.status == 422){
          $("#exampleModal").modal('hide');
          this.$refs.certificate.value=null;

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
        this.certificate = e.target.files[0]
    },
    modalHide(){
      $("#exampleModal").modal('hide');
    }
  }
};
</script>
