<template>
  <div>
      <div class="container-fluid">
          <div class="row justify-content-end" style="margin-top:50px;margin-bottom:10px;" >
          <div class="col-6">
            <button class="btn btn-info" @click='create'><span><i class="fas fa-plus"></i>Create</span></button>
          </div>
          <div class="col-2">
   <form class="form-inline" @submit.prevent='getcat'>
    <div class="input-group">
      <div class="input-group-prepend">
        <button class="btn btn-info" type="submit"><i class="fas fa-search"></i></button>
      </div>
      <input type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1" v-model='search'>
    </div>
  </form>
          </div>
      </div>
          <div class="row">
              <div class="col-3">
                  <div class="card">
                      <div class="card-header"><h3>{{isclickedit ? 'Edit':'Category'}}</h3></div>
                      <div class="card-body">
                          <form @submit.prevent='isclickedit ? updatecat():addcat()' action="#">
                             
                              <div class="form-group">
                                  <label for="category">Category</label>
                                  <input type="text" name="category" placeholder="Enter Category" class="form-control" v-model="categorylist.category"> 
                                  <div class="text-danger" v-if="categorylist.errors.has('category')" v-html="categorylist.errors.get('category')"></div>

                              </div>
                              <button class="btn btn-info" type='submit'><i class="fas fa-save"></i> Save</button>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="col-9">
                  <table class="table table-striped">
                       <tr>
                           <td>ID</td>
                           <td>Name</td>
                           <td>Action</td>
                       </tr>
                       <tr v-for='cat in categories.data' :key='cat.id'>
                           <th>{{cat.id}}</th>
                           <th>{{cat.category}}</th>
                           <th>
                               <button class="btn btn-success" v-on:click='editcat(cat)'>Edit</button>
                               <button class="btn btn-danger" v-on:click='deletecat(cat.id)'>Delete</button>
                           </th>
                       </tr>
                  </table>
                  <pagination :data='categories' @pagination-change-page='getcat' style="padding-left:100px;"></pagination>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import axios from 'axios'
import Form from 'vform'
export default {
    data()
    {
         return {
             search:'',
             isclickedit:false,
             categories:{},
             categorylist:new Form({
                 id:'',
                 category:''
             }),
             message:[]
         }
    },

 methods:
 {
     async getcat(page=1)
   {
      const result=await axios.get(`getcategory?page=${page}&search=${this.search}`)
      this.categories=result.data;
   },
  async addcat()
   {
           await this.categorylist.post('addcategory')
       .then((resp)=>{
          if(this.categories=this.categorylist.data)
          {
              Swal.fire({
                  title:'Duplicated Data'
              })
          }
          
           this.getcat()
       })

       .catch((error)=>{
           console.warn(error)
       })
   },
   async editcat(cat)
   {
      this.categorylist.fill(cat);
      this.isclickedit=true;
   },
   async create()
   {
       this.categorylist.reset()
       this.isclickedit=false;
       this.categorylist.clear()
   },
   async deletecat(id)
   {
       await axios.delete('deletecat/'+id)
       .then((resp)=>
       {
           Swal.fire({
               title:'Delete Successfully'
           })
           this.getcat()
       })
   },
   async updatecat()
   {
     await axios.put(`updatecat/${this.categorylist.id}`,{
         'category':this.categorylist.category
     })
     .then((resp)=>{
         if(this.categories=this.categorylist)
         {
             Swal.fire({
                 title:'Duplicated Data'  
             });
         }else
         {
           Swal.fire({
             title:'Update Successfully'
         });  
         
         }
         this.getcat()
     })
    
   }
 },
async mounted() {
     this.getcat();
}
}
</script>

<style>

</style>