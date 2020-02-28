<template>
    <div class="w-full h-full">
        <div v-if="categories!=null" class="bg-white w-1/2 shadow p-2">
            <h1>Categories</h1>
            <div v-if="categories.length<1">
                <p>No categories created yet.. Try creating one below.</p>
            </div>
            <div else>
                <table class="table-auto">
                    <thead>
                        <th class="border px-4 py-2">Category Name</th>
                        <th class="border px-4 py-2">Category Description</th>
                    </thead>
                    <tbody>
                        <tr  v-for="(category,key) in categories" :key="key">
                    <td  class="border px-4 py-2 text-center  bg-gray-100">
                        {{category.category_name}} 
        

                    </td>
                    <td class="border px-4 py-2 text-center bg-gray-100">
                           {{category.category_description}} 
                    </td>
                        </tr>
                         
                    </tbody>
                </table>
            </div>
            <div>
                <label for="categoryname">Category Name</label>
                <input type="text" name="categoryname" placeholder="Category Name" v-model="categoryName" class="rounded p-1 bg-gray-300 block m-2">

                <label for="categorydescription">Category Description</label>

                <textarea name="categorydescription" id="" cols="30" rows="10" placeholder="Category Description" v-model="categoryDescription"  class="rounded p-1 bg-gray-300 block m-2">

                </textarea>
                <button class="bg-blue-300 p-2 rounded" @click="addCategory()">Add category</button>

            </div>
        </div>
        <div v-else >
            <VclFacebook :width="300"></VclFacebook>
        </div>
    </div>
</template>

<script>
export default {
    mounted: function(){
        let that = this;
        if(this.$parent.categories==null){
         this.$parent.getCategories().then(done => {
            that.categories = that.$parent.categories;
         });
    
        }else {
           that.categories = that.$parent.categories;

        }
    },
    data : function(){
        return {
            categories : null,
            categoryDescription : "",
            categoryName : ""
        }
    },
    methods : {
     
        addCategory : function(){
            axios.post("/postcategory",{categoryName: this.categoryName, categoryDescription : this.categoryDescription}).then(res => {
               if(res.status==200){
                  this.$parent.getCategories().then(done => {
                    this.categories = this.$parent.categories;
                });
                
                  toastr.success("Successfully added category.");

               }else{
                  toastr.error("Unable to get categories.");

               }
            })
        }
    }
}
</script>