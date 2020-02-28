<template>
    <div class="w-full h-full">
        <div v-if="variants!=null" class="bg-white w-1/2 shadow p-2">
            <h1>Variants</h1>
            <div v-if="variants.length<1">
                <p>No variants created yet.. Try creating one below.</p>
            </div>
            <div else>
                <table class="table-auto">
                  <th class="border px-4 py-2">Variant Code</th>
                  <th class="border px-4 py-2">Variant Name</th>
                  <th class="border px-4 py-2">Variant Description</th>
                  <th class="border px-4 py-2">Variant Price</th>
                  <th class="border px-4 py-2">Belong to</th>
                  <tbody>
                      <tr v-for="(variant,key) in variants" :key="key">
                          <td class="border px-4 py-2 bg-gray-100">{{variant.variant_product_code}}</td>
                          <td class="border px-4 py-2 bg-gray-100">{{variant.variant_name}}</td>
                          <td class="border px-4 py-2 bg-gray-100">{{variant.variant_description}}</td>
                          <td class="border px-4 py-2 bg-gray-100">{{variant.variant_price}}</td>
                          <td class="border px-4 py-2 bg-gray-100">{{variant.product}}</td>

                      </tr>
                  </tbody>
                </table>
            </div>
            <div>
                 <label for="variantname">Variant Product Code</label>
                <input type="text" name="variantcode" placeholder="Variant Code" v-model="variantCode" class="rounded p-1 bg-gray-300 block m-2">

                <label for="variantname">Variant Name</label>
                <input type="text" name="variantname" placeholder="Variant Name" v-model="variantName" class="rounded p-1 bg-gray-300 block m-2">

                <label for="variantDescription">Variant Description</label>

                <textarea name="variantDescription" id="" cols="30" rows="10" placeholder="Variant Description" v-model="variantDescription"  class="rounded p-1 bg-gray-300 block m-2">
                </textarea>

                <label for="variantprice">Variant Price</label>
                <input type="text" name="variantprice" placeholder="Variant Price" v-model="variantPrice" class="rounded p-1 bg-gray-300 block m-2">
                
                <label for="VariantProduct">Variant Belongs to</label>
                <select name="VariantProduct" id="variantProduct" v-model="variantProduct">
                    <option  v-for="(product,key) in this.$parent.products" :key="key" :value="product.id">{{product.product_code}} - {{product.product_name}}</option>
                </select>
                
                 <label for="variantprice" class="block">Variant Images</label>
                <input type="file" class="block p-2" @change="processFile($event)" multiple>
                <div>
                    <img v-for="(img,key) in fileimages"  :src="img" alt="" :key="key">
                </div>
                <button class="bg-blue-300 p-2 rounded" @click="addVariant()">Add Variant to product</button>

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
        if(this.$parent.variants==null){
         this.$parent.getVariants().then(done => {
            that.variants = that.$parent.variants;
         });
    
        }else {
           that.variants = that.$parent.variants;

        }

         if(this.$parent.products==null){
         this.$parent.getProducts().then(done => {
         });
    
        }else {

        }
    },
    data : function(){
        return {
            variants : null,
            variantCode: "",
            variantDescription : "",
            variantName : "",
            variantPrice : 0.0,
            variantProduct: "",
            files : "",
            fileimages : []
        }
    },
    methods : {
     
        addVariant : function(){
            axios.post("/postvariants",{variantCode: this.variantCode, variantDescription : this.variantDescription, variantName: this.variantName, variantPrice: this.variantPrice, variantProduct: this.variantProduct,images : this.fileimages }).then(res => {
               if(res.status==200){
                  this.$parent.getVariants().then(done => {
                    this.variants = this.$parent.variants;
                });
                 toastr.success("Posted to variants.");

               }else{
                  toastr.error("Unable to get post to variants.");

               }
            })
        },
    processFile(event) {
     this.files = null;
     this.fileimages = [];
     this.files = event.target.files;
     for(let file in this.files){
         try{
             this.readFile(this.files[file]);
         }catch{

         }
     }
    
  },
  readFile(file){
        var reader = new FileReader();
        let that = this;
        reader.onload = function(e) {

        let url =  e.target.result;
        that.fileimages.push(url);
    }
    
    reader.readAsDataURL(file);
   
  }
    }
}
</script>