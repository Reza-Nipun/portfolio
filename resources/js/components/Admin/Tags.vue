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
          <a href="#" class="btn btn-sm btn-primary">Edit</a>
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
    }
  }
};
</script>
