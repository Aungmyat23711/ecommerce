<template>
  <div class="background">
     <div v-if="!user">
       <h2 align='center'>Please Login to continue!</h2>
     </div>
     <div v-if="user" class="container con" >
         <div class="row ">
              <div class="col-md-6 offset-md-3 bg-light ">
                <h2 align='center'>Product list</h2>
              </div>
         </div><br>
         <div class="row">
            <div class="col-md-12">
               <table class="table bg-white">
                 <tr>
                   <td>Product</td>
                   <td>Category</td>
                   <td>Photo</td>
                   <td>Price</td>
                   <td>Quantity</td>
                   <td>Action</td>
                 </tr>
                 <tr v-for="pro in allproducts.data" :key='pro.id'>
                   <td>{{pro.product}}</td>
                   <td>{{pro.category}}</td>
                   <td>{{pro.path}}</td>
                   <td>{{pro.price}}</td>
                   <td>{{pro.qty}}</td>
                   <td>
                     <button class="btn btn-info" @click="prefill(pro)">Edit</button> ||
                     <button class="btn btn-danger" @click="deleteproduct(pro.id)">Delete</button>
                   
                   </td>
                 </tr>
                 <pagination :data='allproducts' @pagination-change-page='getproducts'></pagination>
               </table>
            </div>
         </div>
     </div>
  </div>
</template>

<script>
import axios from 'axios'
import {mapGetters} from 'vuex'
import {eventBus} from './../../app'
export default {
  computed:{
    ...mapGetters(['user','search']),
  },
  data()
  {
    return {
      allproducts:{},
      
    }
  },
  methods:{
      async getproducts(page=1)
      { 
        await axios.get(`/ecommerce/getproducts?page=${page}`)
        .then((resp)=>{
          this.allproducts=resp.data
        })
      },
      async deleteproduct(id)
      {
       if(confirm('Are you sure about it'))
       {
              var formdata=new FormData();
              formdata.append('_method','DELETE');
          await axios.post(`/ecommerce/deleteproduct/${id}`,formdata)
        .then((resp)=>{
          this.getproducts()
          alert('delete successfully')
        })
       }
       else{
         alert('You Click Cancle');
       }
      },
       prefill(pro)
      {
        this.$router.push({path:'/ecommerce/edit',name:'ecommerceproductedit',params:{alldata:pro}});
      },
      async getsearch()
      {
        var formdata=new FormData()
        formdata.append('searchname',this.search)
       await axios.post('/ecommerce/getsearch',formdata)
       .then((resp)=>{
         console.warn('searchdata',resp.data)
         this.allproducts=resp.data  
       })
      }

  },
  created()
  {
    if(eventBus.$watch('searchmethodtwo'))
    {
     this.getsearch();
    }else{
     this.getproducts();
    }
    eventBus.$on('searchmethod',()=>{
      this.getsearch();
    })
    if(this.search==null)
    {
      this.getproducts();
    }
   
  }
}
</script>

<style lang="scss" scoped>
.background{
  padding: 30px;
  padding-bottom: 300px;
  background: white;
  flex: 1;
}
</style>