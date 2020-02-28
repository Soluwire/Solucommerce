<template>
   <div class="w-full h-full">
        <h1>Menu</h1>
        <p>Click and drag the items below in to the correct order- this will displayed live.</p>
    <draggable v-model="menuitems" group="people" @start="drag=true" @end="drag=false,updateMenuItems()">
   <div  class="bg-white p-2 border-2 shadow-sm m-1 w-1/2" v-for="(menuitem,key) in menuitems" :key="key">{{menuitem.menu_item_name}}</div>
    </draggable>
    <label for="" class="block">Add menu item</label>
    <input type="text"  class="rounded p-1 bg-gray-300" placeholder="About" v-model="menuitem">
    <select name="pages" v-model="selectedPage">
        <option value="">N/A</option>
        <option v-for="(page,key) in pages" :key="key" :value="page.id">
            {{page.page_name}}
        </option>
    </select>
    <button class="bg-blue-300 text-black border-2 rounded p-2" @click="postMenuItem()">ADD MENU ITEM</button>
   </div>
</template>

<script>
  import draggable from 'vuedraggable'
export default {
    mounted : function(){
     this.getMenuItems();
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
            selectedPage : null,
            menuitems : null,
            menuitem : "",
            pages : null
        }
    },
    components : {
        draggable
    },
    methods : {
        postMenuItem(){
        if(this.menuitem.length>0){
            axios.post("/postmenuitem",{'menuitem' : this.menuitem, 'selectedpage' : this.selectedPage}).then(res => {
               if(res.status==200){
                   this.getMenuItems()
                   toastr.success("Successdully added menu item");

               }else{   
                toastr.error("Unable to get menu items.");

               }
            })
        }else{
            alert("Please enter a menu item");
        }
    },
    getMenuItems(){
        let that = this;
          return new Promise(function(resolve,reject){
               axios.post("/getmenuitems").then(res => {
                that.menuitems = res.data
                resolve('done');
            })
          })
    },
    updateMenuItems(){
       axios.post("/updatemenuitems", {'menuitems' : this.menuitems}).then(res => {
           if(res.status==200){
                this.getMenuItems().then(done => {
                    this.menuitems =res.data;
                })
                toastr.success("Success");

           }else{
             toastr.error("Unable to save change.");


           }
       })
    }
    }
}
</script>