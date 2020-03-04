<template>
        <div class="w-full h-full">
        <div v-if="pages!=null" class="bg-white shadow p-2">
        <h1>Pages</h1>

            <div v-if="pages.length<1">
                <p>No products created yet.. Try creating one below.</p>
            </div>
            <div else class="clearfix">
            <p>Please select a page to edit</p>
                  <table class="table-auto mb-2">
                  <th class="border px-4 py-2">Page Name</th>
                  <tbody>
                      <tr v-for="(page,key) in pages" :key="key">
                          <td class="border px-4 py-2 bg-gray-100"><input type="text" :value="page.page_name"></td>
                          <td class="border px-4 py-2 bg-gray-100"><button class="bg-blue-300 p-2 rounded" @click="selectPage(key)">Select page</button></td>
                          <td class="border px-4 py-2 text-center bg-gray-100"><button class="bg-red-500 p-2 text-white" @click="deletePage(page.id)"> <i class="fas fa-trash"></i></button></td>

                      </tr>
                      <tr>
                          <td class="border px-4 py-2 bg-gray-100"><input type="text" placeholder="Page name" v-model="pagename"></td>
                         <td class="border px-4 py-2 bg-gray-100"><button class="bg-blue-300 p-2 rounded" @click="addPage()">Add page</button></td>

                      </tr>
                  </tbody>
                </table>
                <p>Bare in mind this will only allow for very basic formatting, for full styling please use raw HTML code.</p>
                <vue-editor v-model="content"></vue-editor>

                <button class="bg-blue-300 p-2 rounded float-right mt-2" @click="updateHtml()">Update HTML</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
mounted: function(){
        let that = this;
        if(this.$parent.pages==null){
         this.$parent.getPages().then(pages => {
             that.pages = this.$parent.pages;
         });
        }else{
         that.pages = this.$parent.pages;

        }

    },
    data : function(){
        return {
            pages : null,
            pagename : "",
            content : "",
            selectedpagekey : null
        }
    },
     methods : {
         selectPage(key){
             this.selectedpagekey = key;
             this.content = this.pages[key].page_html;
         },
         updateHtml(key){
             let that = this;
             let id = this.pages[this.selectedpagekey].id;
             axios.post("/postpage",{'pageid' : id, 'html' : this.content}).then(res => {
                 if(res.status==200){
                    toastr.success("Page HTML updated successfully");
                    this.$parent.getPages().then(pages => {
                    that.pages = this.$parent.pages;
                });
                 }else {
                   toastr.error("Update was not successful ");

                 }
             })
         },
         addPage(){
                let that = this;
                axios.post("/addpage",{'pagename' : this.pagename}).then(res => {
                 if(res.status==200){
                    toastr.success("Page HTML updated successfully");
                    this.$parent.getPages().then(pages => {
                    that.pages = this.$parent.pages;
                    that.pagename = "";
                });
                 }else {
                   toastr.error("Update was not successful ");

                 }
             })
         },
            deletePage : function(id){
                axios.delete("/postpage/"+id).then(res => {
                if(res.status==200){
                    this.$parent.getPages().then(done => {
                        this.pages = this.$parent.pages;
                    });
                    
                    toastr.success("Successfully deleted.");

                }else{
                    toastr.error("Unable to deleted category.");

                }
                })
        },
     }
}
</script>