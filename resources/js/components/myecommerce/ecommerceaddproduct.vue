<template>
  <div>
      <div v-if='!user'>
           <div class="container" style="padding-top:70px;">
               <div class="row">
                   <div class="col-md-6 offset-md-3 bg-white">
                        <h2>Please login to continue</h2>
                   </div>
               </div>
           </div>
      </div>
      <div v-if="user">
         <div class="container" style="padding-top:70px;">
               <h2 align='center' class="bg-white">Adding Products</h2>
             <form @submit.prevent='postproduct'>
             <div class="row">
                 
                   
                 <div class="col-md-6">
                     
                         <div class="form-group">
                             <label for="productname">Product Name</label>
                             <input type="text" class="form-control" v-model="productname">
                             <span class="text-danger">{{perror}}</span>
                         </div>
                         <div class="form-group">
                             <label for="category">Category</label>
                             <select name="category" v-model="category" class="form-control">
                                 <option v-for="cat in allcategory.data" :key='cat.id' :value="cat.category">{{cat.category}}</option>
                             </select>
                             <span class="text-danger">{{cerror}}</span>
                         </div>
                         <div class="form-group">
                              <label for="photo">Photo</label>
                              <input type="file" class="form-control" v-on:change='changeimg'>
                              <span class="text-danger">{{pherror}}</span>
                              <img src="#" alt="image" id="img" style="max-height:200px;">
                         </div>     
                 </div>
                 <div class="col-md-6">
                      <div class="form-group">
                           <label for="price">Price</label>
                           <input type="text" class="form-control" v-model="price">
                           <span class="text-danger">{{prerror}}</span>
                      </div>
                      <div class="form-group">
                           <label for="qty">Quantity</label>
                           <input type="text" class="form-control" v-model="qty">
                           <span class="text-danger">{{qerror}}</span>
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
import {mapGetters} from 'vuex'
export default {
    data(){
        return{
            allcategory:[],
            category:'',
            cerror:'',
            productname:'',
            perror:'',
            photo:'',
            pherror:'',
            price:'',
            prerror:'',
            qty:'',
            qerror:''
        }
    },
  computed:{
      ...mapGetters(['user'])
  },
  methods:{
      async getcategory()
      {
          await axios.get('/ecommerce/getcategory')
          .then((resp)=>{
             this.allcategory=resp.data
          })
      },
      changeimg(e)
      {
          var input=e.target.files[0]
          this.photo=input
          var reader=new FileReader();
          reader.onload=()=>{
              var result=reader.result;
              var img=document.getElementById('img');
              img.src=result
          }
          reader.readAsDataURL(input);
      },
      async postproduct()
      {
          var filedata=new FormData();
          filedata.append('product',this.productname)
          filedata.append('category',this.category)
          filedata.append('photo',this.photo)
          filedata.append('price',this.price)
          filedata.append('qty',this.qty)  
          axios.post('/ecommerce/addproduct',filedata)
          .then((resp)=>{
              alert('Add Successfully')
              this.$router.push('/ecommerce/home')
          })
          .catch((error)=>{
              console.warn('error',error.response)
              this.perror=error.response.data.errors.productname;
              this.cerror=error.response.data.errors.category;
              this.pherror=error.response.data.errors.photo;
              this.prerror=error.response.data.errors.price;
              this.qerror=error.response.data.errors.qty;
          })    
      }
  },
  mounted()
  {
      this.getcategory();
  }
  
}
</script>

<style>

</style>