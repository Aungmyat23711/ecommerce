<template>
  <div>
      <div v-if="!user" style="padding-top:70px;padding-bottom:110px;">
          <div class="container bg-white ">
               <div class="row">
                    <div class="col-md-8 offset-md-2">
                         <h2 align='center'>Please Login to continue</h2>
                         <p align='center'><router-link to="/ecommerce/login">Login</router-link></p>
                    </div>
               </div>
          </div>
      </div>
      <div v-if="user" style="padding-top:70px;">
             <div class="container con">
                 <div class="row">
                     <div class="col-md-4 bg-white" v-if="isclickedit==false">
                          <h2 align='center'>Add Category</h2>
                          <hr>
                          <form @submit.prevent="postcategory">
                            <div class="form-group">
                              <label for="category" style="font-size:24px;">Category</label>
                              <input type='text' class="form-control" v-model="category" v-on:keydown='error=""'>
                              <span class="text-danger">{{error}}</span>
                            </div>
                            <div class="form-group" >
                              <button type="submit" class="btn btn-info">Save</button>
                            </div>
                          </form>
                     </div>
                     <div class="col-md-4 bg-white" v-if="isclickedit==true">
                          <h2 align='center'>Update Category</h2>
                          <hr>
                          <form @submit.prevent="updatecategory">
                            <div class="form-group">
                              <label for="category" style="font-size:24px;">Category</label>
                              <input type='text' class="form-control" v-model="upcategory" v-on:keydown='error=""' >
                              <span class="text-danger">{{error}}</span>
                            </div>
                            <div class="form-group" >
                              <button type="submit" class="btn btn-info">Update</button>
                              <button type="submit" class="btn btn-danger" @click="isclickedit=false,error=''">Cancle</button>
                            </div>
                          </form>
                     </div>
                          <div class="col-md-1">
                              <span class="width:10px;"></span>
                          </div>
                     <div class="col-md-7">
                           <div class="container " >
                              <table class="table table-striped bg-white">
                                   <tbody>
                                     <tr>
                                       <td>Id</td>
                                       <td>Category Name</td>
                                       <td>Action</td>
                                     </tr>
                                     <tr v-for="cat in allcategories.data" :key="cat.id">
                                       <td>{{cat.id}}</td>
                                       <td>{{cat.category}}</td>
                                       <td><button class="btn-sm btn-info" @click="clickedit(cat)">Edit</button> ||
                                           <button class="btn-sm btn-danger" @click="deletecategory(cat.id)">Delete</button></td>
                                     </tr>
                                     <pagination :data='allcategories' @pagination-change-page='getcategory' class="paginate"></pagination>
                                   </tbody>
                                   
                              </table>
                           </div>
                           
                     </div>
                    
                 </div>
             </div>
      </div>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'
import axios from 'axios'
export default {
computed:{
  ...mapGetters(['user'])
},
data(){
  return {
    category:'',
    allcategories:{},
    error:'',
    upcategory:'',
    isclickedit:false,
    catid:'',
  }
},
methods:{
  async postcategory()
  {
    await axios.post('/ecommerce/postcategory',{
      category:this.category
    })
    .then((resp)=>{
      this.getcategory();
      this.category=''
    })
    .catch((error)=>{
      this.error=error.response.data.errors.category;
    })
  },
  async getcategory(page=1)
  {
    await axios.get('/ecommerce/getcategory?page='+page)
    .then((resp)=>{
     this.allcategories=resp.data;
    })
  },
  async deletecategory(id)
  {
    if(confirm('Are you sure want to delete?'))
    {
      var formdata=new FormData();
      formdata.append('_method','DELETE');
       await axios.post(`/ecommerce/deletecategory/${id}`,formdata)
    .then((resp)=>{
        alert('Delete Successfully');
        this.category='';
        this.getcategory();
    })
    }
    else
    {
      alert('You Click Cancle');
    }
    
  },
  clickedit(cat)
  {
    this.isclickedit=true;
    this.upcategory=cat.category;
    this.catid=cat.id
  },
  async updatecategory()
  {
    var formdata=new FormData();
    formdata.append('category',this.upcategory)
    formdata.append('_method','PUT')
    await axios.post(`/ecommerce/updatecategory/${this.catid}`,formdata)
    .then((resp)=>{
      this.getcategory();
      this.isclickedit=false;
      this.error='';
    })
    .catch((error)=>{
      this.error=error.response.data.errors.category;
    })
  }
       },
created()
{
  this.getcategory();
}
}
</script>

<style>
.table{
  position:absolute;
  left: 0;
  right: 50px;
  width: 90%;
  
}
.tab{
  max-height: fit-content;
}
.paginate{
  position: relative;
  width:100%;
  left: 100px;
}
.con{
  padding-bottom: 100px;
}


</style>