<template>
  <div>
     <div v-if='!user'>
           <div class="container" style="padding-top:70px;padding-bottom:150px;">
               <div class="row">
                   <div class="col-md-6 offset-md-3 bg-white">
                        <h2>Please login to continue</h2>
                   </div>
               </div>
           </div>
      </div>
        <div class="container" v-if="user">
          <div class="row justify-content-start">
            <form class="d-flex" @submit.prevent="getproduct">
      <input class="form-control me-2 mx-2" type="search" placeholder="Search for photo" aria-label="Search" v-model="search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
          </div>
            <div class="row" v-for="pro in getproducts" :key='pro.id' style='padding:20px;'>
                 <div class="col-md-4">
                  <img :src="`/images/${pro.photo}`" alt="" class="img-thumbnail" style="max-height:100px;">
                 </div>
                 <div class="col-md-4">
                  <h4 style="padding-top:30px;">{{pro.product}}</h4>
                 </div>
                 <div class="col-md-4">
                    <router-link :to="`/ecommerce/addphoto/${pro.id}`"><button class="btn btn-info">Add Photo</button></router-link>
                 </div>
            </div>
        </div>
  </div>
</template>

<script>
import axios from 'axios'
import {mapGetters} from 'vuex'
export default {
data()
{
  return {
    getproducts:[],
    search:''
  }
},
methods:{
  async getproduct(page=1)
  {
    await axios.get(`/ecommerce/getprophoto?page=${page} & search=${this.search}`)
        .then((resp)=>{
          this.getproducts=resp.data;
        })
  }
},
created()
{
  this.getproduct();
},
computed:{
  ...mapGetters(['user'])
}
}
</script>

<style>

</style>