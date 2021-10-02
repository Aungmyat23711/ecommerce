<template>
  <div class="container">
      <div class="row" v-if='this.showcart'>
        <div class="col-md-6 offset-3">
            <h1 align='center'>There is no item in your cart</h1>
            <button class="btn btn-info" style="margin-left:220px;"><router-link to="/vue/showproduct">Go Shop</router-link></button>
        </div>
      </div>
      <div class="row" v-for='(item ) in allcarts' :key='item.id' style="margin:50px;" v-else>
            <div class="col-md-4">
                 <img :src="`/image/${item.photo}`" style="max-height:150px;">
            </div>
            <div class="col-md-4">
                  <span class="badge badge-primary">{{item.category}}</span>
                  <h4>{{item.product}}</h4>
                  <h4>{{item.price}} Ks</h4>
             <span v-if="item.cartqty==1">{{item.cartqty}} Unit</span>
             <span v-else>{{item.cartqty}} Units</span>
                 </div>
            <div class="col-md-4">
                <button class="btn btn-danger" @click='remove(item.cartid)'>Remove</button>
            </div>
      </div>
      <div class="row">
          <div class="col-md-12" v-if="this.allcarts!=0">
                <router-link to="/vue/payment"><button class="btn btn-success">Submit Order</button></router-link>
                <router-link to="/vue/showproduct"><button class="btn btn-info">Go Shop</button></router-link>
                <button class="btn btn-danger" @click="removeall">Remove All</button>
          </div>
          <div v-else>

          </div>
      </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data()
  {
     return {
       allcarts:[],
       showcart:false,
     }
  },
  methods:
  {
    async getcart()
    {
      await axios.get('/vue/addcart')
      .then((resp)=>{
         this.allcarts=resp.data
      })
      if(this.allcarts==0)
      {
        this.showcart=true;
      }else{
        this.showcart=false;
      }
    },
    async remove(id)
    {
      await axios.delete('/vue/delete/'+id)
      .then((resp)=>{
        Swal.fire({
          'title':'Delete Successfully'
        })
       this.getcart();
      })
    },
    async removeall()
    {
      Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, remove all!'
})
.then((result)=>{
 
  if(result .isConfirmed)
  {
     axios.delete('/vue/removeall')
  .then((resp)=>{
    console.log(resp)
    this.getcart();
  })
    Swal.fire(
      'Removed!',
      'Your has been removed all files.',
      'success'
    )
  }
})
     
    }

  },
  mounted()
  {
   this.getcart();
  }
}
</script>

<style>

</style>