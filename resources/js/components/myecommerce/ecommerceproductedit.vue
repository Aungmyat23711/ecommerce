<template>
   <div>
      <div v-if='!user'>
           <div class="container">
               <div class="row">
                   <div class="col-md-6 offset-md-3 bg-white">
                        <h2>Please login to continue</h2>
                   </div>
               </div>
           </div>
      </div>
      <div v-if="user">
         <div class="container">
               <h2 align='center' class="bg-white">Adding Products</h2>
             <form @submit.prevent='updatepost'>
             <div class="row">
  
                 <div class="col-md-6">
                     
                         <div class="form-group">
                             <label for="productname">Product Name</label>
                             <input type="text" class="form-control" v-model="productname" >
                             <!-- <span class="text-danger">{{perror}}</span> -->
                         </div>
                         <div class="form-group">
                             <label for="category">Category</label>
                             <select name="category" v-model="category" class="form-control" >
                                 <option v-for="cat in allcategory" :key='cat.id' :value="cat.category">{{cat.category}}</option>
                             </select>
                             <!-- <span class="text-danger">{{cerror}}</span> -->
                         </div>
                         <div class="form-group">
                              <label for="photo">Photo</label>
                              <input type="file" class="form-control" v-on:change='changeimg'>
                              <!-- <span class="text-danger">{{pherror}}</span> -->
                              <img src="#" alt="image" id="img" style="max-height:200px;">
                              <img :src="`/images/${oldphoto}`" style="max-height:200px;">
                         </div>     
                 </div>
                 <div class="col-md-6">
                      <div class="form-group">
                           <label for="price">Price</label>
                           <input type="text" class="form-control" v-model="price">
                           <!-- <span class="text-danger">{{prerror}}</span> -->
                      </div>
                      <div class="form-group">
                           <label for="qty">Quantity</label>
                           <input type="text" class="form-control" v-model="qty">
                           <!-- <span class="text-danger">{{qerror}}</span> -->
                      </div>
                      <div class="form-group">
                          <button class="btn btn-info" type="submit">Save</button>
                      </div>
                 </div>
                 
             </div>
             </form>
         </div>
      </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
data()
{
  return {
    getid:this.$route.params.alldata.id,
    allcategory:[],
    productname:'',
    category:'',
    photo:'',
    oldphoto:'',
    price:'',
    qty:''
  }
},
methods:{
   async getcategory()
      {
          await axios.get('/ecommerce/getcategory')
          .then((resp)=>{
             this.allcategory=resp.data.data
          })
      },
    
    changeimg(e)
    {
      var input=e.target.files[0];
      this.photo=input;
      var reader=new FileReader();
      reader.onload=()=>{
        var result=reader.result;
        var img=document.getElementById('img');
        img.src=result;
      }
      reader.readAsDataURL(input)
    },
    async updatepost()
    { 
      var formdata=new FormData();
      formdata.append('product',this.productname);
      formdata.append('category',this.category)
      formdata.append('photo',this.photo)
      formdata.append('price',this.price)
      formdata.append('qty',this.qty)
      formdata.append('_method','PUT');
      await axios.post(`/ecommerce/updatepost/${this.getid}`,formdata)
      .then((resp)=>{
        alert('update successfully');
        this.$router.push('/ecommerce/home');
      })    
      
    }
},
computed:{
  ...mapGetters(['user'])
},
mounted()
{
  this.getcategory();
  console.warn('alldata',this.alldata)
  this.productname=this.alldata.product;
  this.category=this.alldata.category;
  this.oldphoto=this.alldata.photo;
  this.price=this.alldata.price;
  this.qty=this.alldata.qty;
},
props:['alldata']
}
</script>

<style>

</style>