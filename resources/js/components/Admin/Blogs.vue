<template>
  <div>
    <!-- ======= Header ======= -->
    <AdminHeader></AdminHeader>
    <!-- End Header -->
    
  <h2>Blogs</h2>  
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
        <th class="text-center">BLOG TITLE</th>
        <th class="text-center">DESCRIPTION</th>
        <th class="text-center">URL</th>
        <th class="text-center">STATUS</th>
        <th class="text-center">ACTION</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(blog, index) in blogs.data" v-bind:key="index">
        <td class="text-center">{{ blog.title }}</td>
        <td class="text-center">
          <div v-html="blog.description.substring(0,50)+'...'"></div>
        </td>
        <td class="text-center">{{ blog.blog_url }}</td>
        <td class="text-center">
          <p v-if="blog.status == 1">Yes</p>
          <p v-if="blog.status == 0">No</p>
        </td>
        <td class="text-center">
          <span class="btn btn-sm btn-primary" data-toggle="modal" v-on:click="getUserWiseBlogById(blog.id)">Edit</span>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="d-flex">
    <div class="mx-auto">
      <pagination v-model="page" :records="total" :per-page="per_page" @paginate="getUserWiseBlogs"/>
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
            Title: <input type="text" class="form-control" v-model="blog_info.title"/>
            URL: <input type="text" class="form-control" v-model="blog_info.blog_url"/>
            Image: <input type="file" class="form-control"  @change="onChange" ref="blog_image"/>
            Description: <vue-editor v-model="blog_info.description"></vue-editor>
            Status: <select class="form-control" v-model="blog_info.status">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="modalHide()">Close</button>
            <button type="button" class="btn btn-primary" v-on:click="updateBlog()">Save changes</button>
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
      blogs: {},
      blog_info:{},
      blog_image: null,
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
    document.title = 'Dashboard - Blogs'
    this.getUserWiseBlogs(this.page);
  },
  created(){
    
  },
  methods:{
    getUserWiseBlogs(page){
      this.$store.dispatch('getUserWiseBlogs', page).then((response) => {
        this.blogs = response.data
        this.total = response.data.total
        this.per_page = response.data.per_page
      })
    },
    getUserWiseBlogById(blog_id){
      this.$store.dispatch('getUserWiseBlogById', blog_id).then((response) => {
        this.blog_info = response.data
        $("#exampleModal").modal('show');
      })
    },
    updateBlog(){
      let fd = new FormData();
      fd.append("_method", "PUT")
      fd.append('title', this.blog_info.title)
      fd.append('description', this.blog_info.description)
      fd.append('blog_url', this.blog_info.blog_url)
      fd.append('status', this.blog_info.status)

      const postData = {
        id: this.blog_info.id,
        form_data: fd
      };

      if(this.blog_image !== null){
        fd.append('blog_image', this.blog_image)
      }

      this.$store.dispatch('saveUserBlog', postData).then((response) => {
        this.is_saved = true;
        this.errors_exist = false;
        $("#exampleModal").modal('hide');
        this.getUserWiseBlogs(this.page);
        this.message = "Successfully Saved!";

        window.setTimeout( () => {
          this.is_saved = false
        }, 3000)

        this.$refs.blog_image.value=null;
      }).catch(error => {
        if (error.response.status == 422){
          $("#exampleModal").modal('hide');
          this.$refs.blog_image.value=null;

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
        this.blog_image = e.target.files[0]
    },
    modalHide(){
      $("#exampleModal").modal('hide');
    }
  }
};
</script>
