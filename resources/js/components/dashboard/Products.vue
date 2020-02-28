<template>
    <div class="w-full h-full">
        <div v-if="products!=null" class="bg-white w-1/2 shadow p-2">
            <h1>Products</h1>
            <div v-if="products.length<1">
                <p>No products created yet.. Try creating one below.</p>
            </div>
            <div else>
                <table class="table-auto">
                    <thead>
                        <th class="border px-4 py-2">Product Code</th>
                        <th class="border px-4 py-2">Product Name</th>
                        <th class="border px-4 py-2">Product Description</th>
                        <th class="border px-4 py-2">Product Price</th>
                        <th class="border px-4 py-2">Product Category</th>

                    </thead>
                    <tbody>
                        <tr  v-for="(product,key) in products" :key="key">
                    <td class="border px-4 py-2 text-center bg-gray-100">
                        {{product.product_code}} 
                    </td>
                       <td class="border px-4 py-2 text-center bg-gray-100">
                        {{product.product_name}} 
                    </td>
                         <td class="border px-4 py-2 text-center bg-gray-100">
                           {{product.product_description}} 
                    </td>
                    <td class="border px-4 py-2 text-center bg-gray-100 ">
                           {{product.product_price}} 
                    </td>
                     <td class="border px-4 py-2 text-center bg-gray-100">
                           {{product.category_id}} 
                    </td>
                        </tr>
                         
                    </tbody>
                </table>
            </div>
            
            <div>
                <label for="productcode"> Product Code</label>
                <input name="productcode" type="text" placeholder="Product Code" v-model="productCode" class="rounded p-1 bg-gray-300 block m-2">

                <label for="productname"> Product Name</label>
                <input name="productname" type="text" placeholder="Product Name" v-model="productName" class="rounded p-1 bg-gray-300 block m-2">

                <label for="productDescription"> Product Description</label>
                <textarea name="productDescription" id="" cols="30" rows="10" placeholder="Category Description" v-model="productDescription"  class="rounded p-1 bg-gray-300 block m-2">

                </textarea>

                <div v-if="productHasVariants">
                    <label for="producthasvariants"> Product has variants?</label>
                    <input name="productprice" type="checkbox" v-model="productHasVariants" class="rounded p-1 bg-gray-300 block m-2">
                </div>

                <div v-if="!productHasVariants">
                    <label for="productprice"> Product Price</label>
                    <input name="productprice" type="number" placeholder="Product Price" v-model="productPrice" class="rounded p-1 bg-gray-300 block m-2">
                </div>
                
                <label for="category"> Product Category</label>
                <select name="category" id="" class="rounded p-1 bg-gray-300 block m-2" v-model="productCategory">
                    <option v-for="category in this.$parent.categories" :value="category.id" :key="category.id">{{category.category_name}}</option>
                </select>

                <button class="bg-blue-300 p-2 rounded" @click="addProduct()">Add category</button>

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

         });
        }

        if(this.$parent.products==null){
         this.$parent.getProducts().then(done => {
            that.products = that.$parent.products;
         });
    
        }else {
           that.products = that.$parent.products;

        }
    },
    data : function(){
        return {
            products : null,
            productName : "",
            productDescription : "",
            productPrice : 0,
            productCategory : null,
            productCode : "",
            productHasVariants : true
        }
    },
    methods : {
     
        addProduct : function(){
            axios.post("/postproduct",{productName: this.productName, productDescription : this.productDescription, productPrice : this.productPrice, productCategory : this.productCategory, productCode : this.productCode, productHasVariants : this.productHasVariants}).then(res => {
               if(res.status==200){
                  this.$parent.getProducts().then(done => {
                    this.products = this.$parent.products;
                });
                  toastr.success("Product added successfully");
                //   this.$forceUpdate();
               }else{
                  toastr.error("Unable to save product.");

               }
            })
        }
    }
}
</script>