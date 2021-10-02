<template>
  <div class="container my-2">  
     <div class="row justify-content-center">
          <div class="col-md-4">
              <button class="btn btn-info" @click='create'>Create</button>
          </div>
      </div> 
       <div class="row">
        
           <div class="col-md-4">
             <div class="card">
               <AlertError :form="cate" :message="message" class="text-danger"/>
               <form @submit.prevent='isclickedit ? updatecate():addcate()' @keydown="cate.onKeydown($event)">
               <div class="card-header">
               <span><h3>Category Form</h3></span>
               </div>
               <div class="card-body">
                  <div class="form-group">
                    <label for="category">Category</label>
                     <input type="text" name="category" class="form-control" v-model="cate.category">
                     <div class="text-danger" v-if='cate.errors.has("category")' v-html="cate.errors.get('category')"></div>
                  </div>
               </div>
               <div class="card-footer">
                 <button class="btn btn-info" type="submit">{{isclickedit ? 'Update':'Create'}}</button>
               </div>
              </form>
              </div>
           </div>
           <div class="col-md-8">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  <tr v-for="cat in allcategory" :key='cat.id'> 
                    <th>{{cat.id}}</th>
                    <th>{{cat.category}}</th>
                    <th>
                      <button class="btn btn-info" @click='editcate(cat)'>Edit</button>
                      <button class="btn btn-danger" @click='deletecate(cat.id)'>Delete</button>
                      </th>
                  </tr>
                </thead>
              </table>
           </div>
       </div>
  </div>
</template>

<script>
import Form from 'vform'
export default {
data()
{
  return {
    cate:new Form({
    id:'',
    category:'',
    }),
    allcategory:[],
    isclickedit:false,
    message:''
    
  }
},
methods:
{
  async addcate()
  {
    await this.cate.post('/addcate')
    .then((resp)=>{
      this.getcate()
    })
    .catch((error)=>{
      this.message=error.response.data.message
    })
  },
  async deletecate(id)
  {
    await axios.delete(`/delete/${id}`)
    .then((resp)=>{
      this.getcate()
    })
  },
  async getcate()
  {
    await axios.get('/getcate')
    .then((resp)=>{
      console.log(resp)
      this.allcategory=resp.data
    })
  },
  async editcate(cat)
  {
    this.cate.id=cat.id
    this.cate.category=cat.category
    this.isclickedit=true;
  },
  async create()
  {
    this.isclickedit=false;
    this.cate.clear();
    this.cate.reset();
  },
  async updatecate(){
  {
       await axios.put(`/updatecate/${this.cate.id}`,{
         'id':this.cate.id,
         'category':this.cate.category
       })
       .then((resp)=>{
         this.getcate()
         this.cate.reset();
       })
  }
  },
},
async mounted()
{
   this.getcate();
}
}
</script>

<style>

</style>