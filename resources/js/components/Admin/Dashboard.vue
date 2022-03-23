<template>
  <div>
    <!-- ======= Header ======= -->
    <AdminHeader></AdminHeader>
    <!-- End Header -->
    <h1>--------Dashboard-------</h1>
    <!-- ======= Footer ======= -->
    <AdminFooter></AdminFooter>
    <!-- End  Footer -->
  </div>
</template>

<script>

import AdminHeader from './AdminHeader.vue';
import AdminFooter from './AdminFooter.vue';

export default {
  components: {
    'AdminHeader': AdminHeader,
    'AdminFooter': AdminFooter,
  },
  computed: {
    
  },
  mounted() {
    console.log("Component mounted.");
  },
  created(){
    
  },
  methods:{
    // ...mapActions(["getUserInfo", "getUserSkills", "getUserCertificates", "getUserServices", "getUserPortfolios", "getUserLinks", "getUserBlogs"]),
  }
};
</script>
