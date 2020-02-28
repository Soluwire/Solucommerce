<template>
       <div class="w-full h-full flex">
        <div class="w-1/6 bg-gray-300">
            <ul class="unstyled">
                <router-link to="/" class="admin-menu-item" tag="li">Dashboard</router-link>
                <router-link to="/products" class="admin-menu-item" tag="li">Products</router-link>
                <router-link to="/variants" class="admin-menu-item" tag="li">Variants</router-link>
                <router-link to="/pages" class="admin-menu-item" tag="li">Pages</router-link>
                <router-link to="/menu" class="admin-menu-item" tag="li">Menu</router-link>
                <router-link to="/categories" class="admin-menu-item" tag="li">Categories</router-link>

            </ul>
        </div>
        <div class="w-5/6 bg-gray-200 p-2">
         <div class="w-full h-full">
          <router-view :key="$route.name" v-if="$route.path!=='/'"></router-view>
          
          <div v-else>
              <h1>Dashboard</h1>
          </div>
 
         </div>
        </div>
        
       </div>
       
</template>

<script>
export default {
    mounted : function() {
      this.route = this.$route.name
    },
    data : function(){
        return {
            route : null,
            categories : null,
            products : null,
            variants : null,
            pages : null
        }
    },
    methods : {
           getCategories : function(){
               let that = this;
            return new Promise(function(resolve,reject){
              axios.post("/getcategories").then(res => {
               if(res.status==200){
                   that.categories = res.data;
                   resolve("Done");
               }else{
                toastr.error("Unable to get categories.");

               }
            })
            })
          
        },
         getProducts : function(){
               let that = this;
            return new Promise(function(resolve,reject){
              axios.post("/getproducts").then(res => {
               if(res.status==200){
                   that.products = res.data;
                   resolve("Done");
               }else{
                toastr.error("Unable to get categories.");

               }
            })
            })
          
        },
        getVariants : function(){
               let that = this;;
            return new Promise(function(resolve,reject){
              axios.post("/getvariants").then(res => {
               if(res.status==200){
                   that.variants = res.data;
                   resolve("Done");
               }else{
                toastr.error("Unable to get categories.");

               }
            })
            })

    },
    getPages : function(){
               let that = this;;
            return new Promise(function(resolve,reject){
              axios.post("/getpages").then(res => {
               if(res.status==200){
                   that.pages = res.data;
                   resolve("Done");
               }else{
                toastr.error("Unable to get categories.");

               }
            })
            })

    }
    }
}

</script>